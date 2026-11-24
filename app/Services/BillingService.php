<?php

namespace App\Services;

use App\Models\ActiveAllocation;
use App\Models\Payment;
use App\Models\RentRecord;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BillingService
{
    public function generate(string $month): int
    {
        $date = Carbon::parse($month)->startOfMonth();
        $monthStart = $date->toDateString();
        $monthEnd = $date->copy()->endOfMonth()->toDateString();
        $count = 0;

        ActiveAllocation::with(['allocation', 'resident'])
            ->whereHas('resident', function ($q) {
                $q->whereIn('status', ['active', 'notice_period']);
            })
            ->chunkById(100, function ($rows) use ($date, $monthStart, $monthEnd, &$count) {
                foreach ($rows as $active) {
                    $created = DB::transaction(function () use ($active, $date, $monthStart, $monthEnd) {
                        $resident = Resident::whereKey($active->resident_id)->lockForUpdate()->firstOrFail();

                        // Never generate rent for checked out residents
                        if ($resident->status === 'checked_out') {
                            return false;
                        }

                        // If resident has an expected checkout before this month began, skip
                        if ($resident->expected_checkout && $resident->expected_checkout->toDateString() < $monthStart) {
                            return false;
                        }

                        // If resident already checked out before this month began, skip
                        if ($resident->checkouts()->whereDate('date', '<', $monthStart)->exists()) {
                            return false;
                        }

                        $current = ActiveAllocation::with('allocation')->where('resident_id', $active->resident_id)->first();
                        if (! $current || ! $current->allocation) {
                            return false;
                        }

                        // If check-in is in a future month, skip
                        if ($current->allocation->check_in > $monthEnd) {
                            return false;
                        }

                        // If allocation itself checked out before this month began, skip
                        if ($current->allocation->check_out && $current->allocation->check_out < $monthStart) {
                            return false;
                        }

                        return RentRecord::firstOrCreate(
                            ['resident_id' => $active->resident_id, 'month' => $monthStart],
                            [
                                'allocation_id' => $current->allocation_id,
                                'due_date' => $date->copy()->day(5)->toDateString(),
                                'amount' => $current->allocation->rent,
                            ]
                        )->wasRecentlyCreated;
                    }, 5);

                    if ($created) {
                        $count++;
                    }
                }
            });

        return $count;
    }

    public function pay(array $data): Payment
    {
        try {
            return DB::transaction(function () use ($data) {
                Resident::lockForUpdate()->findOrFail($data['resident_id']);
                if ($data['type'] === 'rent') {
                    $record = RentRecord::with('payments')->lockForUpdate()->findOrFail($data['rent_record_id']);
                    if ($record->resident_id != $data['resident_id'] || round($data['amount'] * 100) > round($record->pending * 100)) {
                        throw ValidationException::withMessages(['amount' => 'Payment must belong to this resident and cannot exceed the outstanding rent.']);
                    }
                } else {
                    $data['rent_record_id'] = null;
                    $resident = Resident::findOrFail($data['resident_id']);
                    $received = (float) $resident->payments()->where('type', 'deposit')->where('status', 'active')->sum('amount');
                    if ((float) $resident->security_deposit > 0 && $received + (float) $data['amount'] > (float) $resident->security_deposit) {
                        throw ValidationException::withMessages(['amount' => 'Deposit would exceed this resident’s expected security deposit.']);
                    }
                }

                return Payment::create($data + ['created_by' => auth()->id()]);
            }, 5);
        } catch (UniqueConstraintViolationException $e) {
            $existing = isset($data['request_token']) ? Payment::where('request_token', $data['request_token'])->first() : null;
            if ($existing) {
                return $existing;
            }
            throw $e;
        }
    }
}
