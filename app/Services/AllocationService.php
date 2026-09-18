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
                $allocation = Allocation::create(['resident_id' => $residentId, 'bed_id' => $bedId, 'check_in' => $data['date'], 'rent' => $bed->room->monthly_rent, 'deposit' => $bed->room->security_deposit, 'notes' => $data['notes'] ?? null, 'created_by' => auth()->id()]);
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
            $pending = $resident->rentRecords()->with('payments')->get()->sum('pending');
            $deposits = max(0, $resident->payments()->where('type', 'deposit')->sum('amount') - $resident->checkouts()->sum(DB::raw('refund + deductions + deposit_applied')));
            if ($data['deductions'] > $deposits) {
                $this->fail('Deductions cannot exceed the remaining collected deposit.');
            }
            $applied = min($pending, max(0, $deposits - $data['deductions']));
            $remaining = $applied;
            foreach ($resident->rentRecords()->with('payments')->orderBy('month')->lockForUpdate()->get() as $record) {
                $amount = min($remaining, $record->pending);
                if ($amount > 0) {
                    Payment::create(['resident_id' => $residentId, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => $amount, 'payment_date' => $data['date'], 'method' => 'deposit_adjustment', 'notes' => 'Security deposit applied to outstanding rent at checkout', 'created_by' => auth()->id()]);
                }
                $remaining = round($remaining - $amount, 2);
            }
            $refund = max(0, round($deposits - $data['deductions'] - $applied, 2));
            $checkout = Checkout::create(['resident_id' => $residentId, 'allocation_id' => $active->allocation_id, 'date' => $data['date'], 'reason' => $data['reason'], 'pending_rent' => $pending, 'deductions' => $data['deductions'], 'deposit_applied' => $applied, 'refund' => $refund, 'notes' => $data['notes'] ?? null, 'created_by' => auth()->id()]);
            $active->allocation->update(['check_out' => $data['date']]);
            $active->delete();
            $resident->update(['status' => 'checked_out', 'expected_checkout' => $data['date'], 'updated_by' => auth()->id()]);

            return $checkout;
        }, 5);
    }
}
