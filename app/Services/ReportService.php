<?php

namespace App\Services;

use App\Models\Allocation;
use App\Models\Floor;
use App\Models\Payment;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\Room;
use Carbon\Carbon;

class ReportService
{
    public const TYPES = ['occupancy' => 'Current Occupancy', 'available' => 'Available Beds', 'floors' => 'Floor-wise Occupancy', 'rooms' => 'Room-wise Occupancy', 'active' => 'Active Residents', 'checked_out' => 'Checked-out Residents', 'collection' => 'Monthly Rent Collection', 'pending' => 'Pending Payments', 'deposits' => 'Deposit Summary', 'history' => 'Check-in / Checkout History'];

    public function data(string $type, ?string $month = null): array
    {
        $headers = [];
        $rows = [];
        if ($type === 'available') {
            $headers = ['Floor', 'Room', 'Bed', 'Monthly rent (INR)', 'Deposit (INR)'];
            foreach (Room::with(['floor', 'beds.activeAllocation', 'beds.room'])->get() as $room) {
                foreach ($room->beds as $bed) {
                    if ($bed->effective_status === 'available') {
                        $rows[] = [$room->floor->name, $room->number, $bed->name, $room->monthly_rent, $room->security_deposit];
                    }
                }
            }
        } elseif (in_array($type, ['occupancy', 'rooms'])) {
            $headers = ['Floor', 'Room', 'Capacity', 'Occupied', 'Available', 'Reserved', 'Maintenance'];
            foreach (Room::with(['floor', 'beds.activeAllocation', 'beds.room'])->get() as $room) {
                $rows[] = [$room->floor->name, $room->number, $room->capacity, $room->occupied, $room->available, $room->beds->filter(fn ($b) => $b->effective_status === 'reserved')->count(), $room->beds->filter(fn ($b) => $b->effective_status === 'maintenance')->count()];
            }
        } elseif ($type === 'floors') {
            $headers = ['Floor', 'Rooms', 'Beds', 'Occupied', 'Available'];
            foreach (Floor::with(['rooms.beds.activeAllocation', 'rooms.beds.room'])->get() as $floor) {
                $rows[] = [$floor->name, $floor->rooms->count(), $floor->rooms->sum('capacity'), $floor->rooms->sum('occupied'), $floor->rooms->sum('available')];
            }
        } elseif (in_array($type, ['active', 'checked_out'])) {
            $headers = ['Resident', 'Mobile', 'Status', 'Joined', 'Checkout'];
            foreach (Resident::whereIn('status', $type === 'active' ? ['active', 'notice_period'] : ['checked_out'])->get() as $r) {
                $rows[] = [$r->full_name, $r->mobile, $r->status, $r->joining_date->toDateString(), $r->expected_checkout?->toDateString() ?? ''];
            }
        } elseif ($type === 'collection') {
            $headers = ['Resident', 'Date', 'Type', 'Amount (INR)', 'Method', 'Reference'];
            foreach (Payment::with('resident')->when($month, fn ($q) => $q->whereBetween('payment_date', [$month.'-01', Carbon::parse($month)->endOfMonth()->toDateString()]))->get() as $p) {
                $rows[] = [$p->resident->full_name, $p->payment_date, $p->type, $p->amount, $p->method, $p->reference ?? ''];
            }
        } elseif ($type === 'pending') {
            $headers = ['Resident', 'Month', 'Rent (INR)', 'Late Fee', 'Pending (INR)', 'Status'];
            foreach (RentRecord::with('resident', 'payments')->when($month, fn ($q) => $q->where('month', $month.'-01'))->get() as $r) {
                if ($r->pending > 0) {
                    $rows[] = [$r->resident->full_name, $r->month->format('M Y'), $r->amount, $r->late_fee, $r->pending, $r->status];
                }
            }
        } elseif ($type === 'deposits') {
            $headers = ['Resident', 'Expected (INR)', 'Collected (INR)', 'Refunds (INR)', 'Deductions (INR)'];
            foreach (Resident::withTrashed()->with(['payments', 'checkouts'])->get() as $r) {
                $rows[] = [$r->full_name, $r->security_deposit, $r->payments->where('type', 'deposit')->sum('amount'), $r->checkouts->sum('refund'), $r->checkouts->sum('deductions')];
            }
        } else {
            $headers = ['Resident', 'Room', 'Bed', 'Check-in', 'Check-out', 'Rent (INR)'];
            foreach (Allocation::with(['resident', 'bed' => fn ($q) => $q->with(['room' => fn ($q) => $q->withTrashed()])])->get() as $a) {
                $rows[] = [$a->resident->full_name, $a->bed->room->number, $a->bed->name, $a->check_in, $a->check_out ?? 'Active', $a->rent];
            }
        }

        return ['title' => self::TYPES[$type] ?? self::TYPES['history'], 'headers' => $headers, 'rows' => $rows];
    }
}
