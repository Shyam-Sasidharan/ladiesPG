<?php

namespace App\Services;

use App\Models\ActiveAllocation;
use App\Models\Allocation;
use App\Models\Bed;
use App\Models\Checkout;
use App\Models\Payment;
use App\Models\Resident;
use App\Models\Room;
use App\Models\RoomTransfer;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AllocationService
{
    private function fail(string $message): never
    {
        throw ValidationException::withMessages(['allocation' => $message]);
    }

    public function allocate(int $residentId, int $bedId, array $data): Allocation
    {
        try {
            return DB::transaction(function () use ($residentId, $bedId, $data) {
                $resident = Resident::lockForUpdate()->findOrFail($residentId);
                $roomId = Bed::findOrFail($bedId)->room_id;
                $room = Room::whereKey($roomId)->lockForUpdate()->firstOrFail();
                $bed = Bed::lockForUpdate()->findOrFail($bedId);
                $bed->setRelation('room', $room);
                $bed->setRelation('activeAllocation', ActiveAllocation::where('bed_id', $bedId)->lockForUpdate()->first());
                if (ActiveAllocation::where('resident_id', $residentId)->lockForUpdate()->first()) {
                    $this->fail('This resident already has an active bed. Use room transfer.');
                }
                if ($bed->effective_status !== 'available') {
                    $this->fail('This bed is no longer available. Please select another bed.');
                }
                if (($data['initial_payment'] ?? 0) > $bed->room->security_deposit) {
                    $this->fail('Initial deposit cannot exceed the room security deposit.');
                }
                $lastCheckout = Allocation::where('resident_id', $residentId)->max('check_out');
                if ($lastCheckout && $data['date'] < $lastCheckout) {
                    $this->fail('Check-in cannot precede the end of a previous stay.');
                }
                $rent = (! $resident->food_required && $bed->room->rent_without_food)
                    ? $bed->room->rent_without_food
                    : ($resident->monthly_rent > 0 ? $resident->monthly_rent : $bed->room->monthly_rent);

                $allocation = Allocation::create(['resident_id' => $residentId, 'bed_id' => $bedId, 'check_in' => $data['date'], 'rent' => $rent, 'deposit' => $bed->room->security_deposit, 'notes' => $data['notes'] ?? null, 'created_by' => auth()->id()]);
                ActiveAllocation::create(['resident_id' => $residentId, 'bed_id' => $bedId, 'allocation_id' => $allocation->id]);
                $resident->update(['status' => 'active', 'monthly_rent' => $allocation->rent, 'security_deposit' => $allocation->deposit, 'joining_date' => $data['date'], 'expected_checkout' => $resident->status === 'checked_out' ? null : $resident->expected_checkout, 'updated_by' => auth()->id()]);
                if (($data['initial_payment'] ?? 0) > 0) {
                    Payment::create(['resident_id' => $residentId, 'type' => 'deposit', 'amount' => $data['initial_payment'], 'payment_date' => $data['date'], 'method' => $data['method'] ?? 'cash', 'notes' => 'Initial deposit at check-in', 'created_by' => auth()->id()]);
                }

                return $allocation;
            }, 5);
        } catch (UniqueConstraintViolationException $e) {
            $this->fail('This resident or bed was just allocated by another administrator. Refresh and try again.');
        }
    }

    public function transfer(int $residentId, int $bedId, array $data): Allocation
    {
        return DB::transaction(function () use ($residentId, $bedId, $data) {
            Resident::lockForUpdate()->findOrFail($residentId);
            $active = ActiveAllocation::where('resident_id', $residentId)->lockForUpdate()->first();
            if (! $active) {
                $this->fail('Resident has no active allocation.');
            }
            if ($active->bed_id == $bedId) {
                $this->fail('Select a different bed.');
            }
            $roomIds = Bed::whereIn('id', [$active->bed_id, $bedId])->pluck('room_id');
            Room::whereIn('id', $roomIds)->orderBy('id')->lockForUpdate()->get();
            Bed::whereIn('id', [$active->bed_id, $bedId])->orderBy('id')->lockForUpdate()->get();
            if ($data['date'] < $active->allocation->check_in) {
                $this->fail('Transfer date cannot precede check-in.');
            }
            $previous = $active->allocation;
            $previous->update(['check_out' => $data['date']]);
            $active->delete();
            $joiningDate = Resident::findOrFail($residentId)->joining_date;
            $next = $this->allocate($residentId, $bedId, $data);
            Resident::whereKey($residentId)->update(['joining_date' => $joiningDate]);
            RoomTransfer::create(['resident_id' => $residentId, 'from_allocation_id' => $previous->id, 'to_allocation_id' => $next->id, 'date' => $data['date'], 'notes' => $data['notes'] ?? null]);

            return $next;
        }, 5);
    }

    public function checkout(int $residentId, array $data): Checkout
    {
        return DB::transaction(function () use ($residentId, $data) {
            $resident = Resident::lockForUpdate()->findOrFail($residentId);
            $active = ActiveAllocation::where('resident_id', $residentId)->lockForUpdate()->first();
            if (! $active) {
                $this->fail('Resident has no active allocation.');
            }
            Bed::whereKey($active->bed_id)->lockForUpdate()->firstOrFail();
            if ($data['date'] < $active->allocation->check_in) {
                $this->fail('Checkout date cannot precede check-in.');
            }
            $rentRecords = $resident->rentRecords()->with('payments')->orderBy('month')->lockForUpdate()->get();
            $pending = (float) $rentRecords->sum('pending');
            $deposits = $this->depositHeldForResident($resident);
            $refundRequested = filter_var($data['refund_security_deposit'] ?? false, FILTER_VALIDATE_BOOLEAN);
            $refunded = $refundRequested ? (float) $data['refund_amount'] : 0;
            if ($refundRequested && $refunded > $deposits) {
                $this->fail('Refund exceeds the security deposit currently held.');
            }
            $action = $refundRequested ? 'refund_now' : ($deposits > 0 ? 'refund_later' : 'no_deposit');
            $pendingRefund = max(0, round($deposits - $refunded, 2));
            $checkout = Checkout::create([
                'resident_id' => $residentId, 'allocation_id' => $active->allocation_id, 'date' => $data['date'],
                'reason' => $data['reason'], 'deposit_action' => $action,
                'deposit_held' => $deposits, 'pending_rent' => $pending, 'deductions' => 0, 'deposit_applied' => 0,
                'refund' => $refunded, 'deposit_refunded' => $refunded, 'pending_refund' => $pendingRefund,
                'notes' => $data['reason'],
                'created_by' => auth()->id(),
            ]);
            if ($refunded > 0) {
                $resident->payments()->where('type', 'deposit')->where('status', 'active')
                    ->whereDoesntHave('financialTransaction')->get()
                    ->each(fn (Payment $payment) => app(AccountingService::class)->recordPayment($payment));
                app(AccountingService::class)->create([
                    'request_token' => (string) Str::uuid(), 'transaction_date' => $data['date'],
                    'transaction_type' => 'SECURITY_DEPOSIT_REFUND', 'resident_id' => $residentId,
                    'source_type' => Checkout::class, 'source_id' => $checkout->id, 'amount' => $refunded,
                    'description' => 'Security deposit refunded at checkout for '.$resident->full_name,
                    'notes' => $data['reason'],
                ]);
            }
            $active->allocation->update(['check_out' => $data['date']]);
            $active->delete();
            $resident->update(['status' => 'checked_out', 'expected_checkout' => $data['date'], 'updated_by' => auth()->id()]);

            return $checkout;
        }, 5);
    }

    public function depositHeldForResident(Resident $resident): float
    {
        $received = (float) $resident->payments()->where('type', 'deposit')->where('status', 'active')->sum('amount');
        $settled = (float) $resident->financialTransactions()->where('status', 'active')
            ->whereIn('transaction_type', ['SECURITY_DEPOSIT_REFUND', 'SECURITY_DEPOSIT_ADJUSTMENT'])->sum('amount');

        return max(0, round($received - $settled, 2));
    }
}
