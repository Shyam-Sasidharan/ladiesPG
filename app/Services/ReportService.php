<?php

namespace App\Services;

use App\Models\Allocation;
use App\Models\FinancialTransaction;
use App\Models\Floor;
use App\Models\Payment;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\Room;
use Carbon\Carbon;

class ReportService
{
    public const TYPES = ['occupancy' => 'Current Occupancy', 'available' => 'Available Beds', 'floors' => 'Floor-wise Occupancy', 'rooms' => 'Room-wise Occupancy', 'active' => 'Active Residents', 'checked_out' => 'Checked-out Residents', 'collection' => 'Monthly Rent Collection', 'pending' => 'Pending Payments', 'deposits' => 'Security Deposit Report', 'history' => 'Check-in / Checkout History', 'partner_contributions' => 'Partner Contribution Report', 'expenses' => 'Expense Report', 'income' => 'Income Report', 'partner_withdrawals' => 'Partner Withdrawal Report', 'transactions' => 'Transaction History'];

    public function data(string $type, ?string $month = null): array
    {
        $headers = [];
        $rows = [];
        if ($type === 'partner_contributions') {
            $headers = ['Partner', 'Direct Contribution', 'Personally Paid Expenses', 'Total Contribution', 'Amount Received', 'Net Position'];
            foreach (app(AccountingService::class)->summary()['partners'] as $p) {
                $rows[] = [$p['partner']->name, $p['direct'], $p['expenses'], $p['total'], $p['received'], $p['net']];
            }
        } elseif ($type === 'expenses') {
            $headers = ['Date', 'Category', 'Description', 'Amount', 'Paid From', 'Partner', 'Number', 'Status'];
            foreach (FinancialTransaction::with(['partner', 'expenseCategory'])->whereIn('transaction_type', ['PARTNER_PAID_EXPENSE', 'BUSINESS_EXPENSE'])->orderBy('transaction_date')->get() as $t) {
                $rows[] = [$t->transaction_date->toDateString(), $t->expenseCategory?->name, $t->description, $t->amount, $t->paid_from, $t->partner?->name, $t->transaction_number, $t->status];
            }
        } elseif ($type === 'income') {
            $headers = ['Date', 'Resident', 'Type', 'Description', 'Amount', 'Number', 'Status'];
            foreach (FinancialTransaction::with('resident')->whereIn('transaction_type', ['RENT_INCOME', 'OTHER_INCOME', 'SECURITY_DEPOSIT_ADJUSTMENT'])->orderBy('transaction_date')->get() as $t) {
                $rows[] = [$t->transaction_date->toDateString(), $t->resident?->full_name, AccountingService::TYPES[$t->transaction_type], $t->description, $t->amount, $t->transaction_number, $t->status];
            }
        } elseif ($type === 'partner_withdrawals') {
            $headers = ['Date', 'Partner', 'Amount', 'Type', 'Reference', 'Number', 'Status'];
            foreach (FinancialTransaction::with('partner')->whereIn('transaction_type', ['PARTNER_PROFIT_WITHDRAWAL', 'PARTNER_REIMBURSEMENT'])->orderBy('transaction_date')->get() as $t) {
                $rows[] = [$t->transaction_date->toDateString(), $t->partner?->name, $t->amount, AccountingService::TYPES[$t->transaction_type], $t->reference_number, $t->transaction_number, $t->status];
            }
        } elseif ($type === 'transactions') {
            $headers = ['Date', 'Number', 'Type', 'Description', 'Partner', 'Resident', 'Money In', 'Money Out', 'Method', 'Reference', 'Status'];
            foreach (FinancialTransaction::with(['partner', 'resident'])->orderBy('transaction_date')->orderBy('id')->get() as $t) {
                $rows[] = [$t->transaction_date->toDateString(), $t->transaction_number, AccountingService::TYPES[$t->transaction_type] ?? $t->transaction_type, $t->description, $t->partner?->name, $t->resident?->full_name, $t->direction === 'IN' ? $t->amount : '', $t->direction === 'OUT' ? $t->amount : '', $t->payment_method, $t->reference_number, $t->status];
            }
        } elseif ($type === 'available') {
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
            foreach (Payment::with('resident')->where('type', 'rent')->where('status', 'active')->when($month, fn ($q) => $q->whereBetween('payment_date', [$month.'-01', Carbon::parse($month)->endOfMonth()->toDateString()]))->get() as $p) {
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
            $headers = ['Resident', 'Deposit Received', 'Refunded', 'Adjusted to Rent', 'Currently Held', 'Pending Refund'];
            foreach (Resident::withTrashed()->get() as $r) {
                $tx = FinancialTransaction::where('resident_id', $r->id)->where('status', 'active')->get();
                $received = $tx->where('transaction_type', 'SECURITY_DEPOSIT_RECEIVED')->sum('amount');
                $refunded = $tx->where('transaction_type', 'SECURITY_DEPOSIT_REFUND')->sum('amount');
                $adjusted = $tx->where('transaction_type', 'SECURITY_DEPOSIT_ADJUSTMENT')->sum('amount');
                if ($received || $refunded || $adjusted) {
                    $held = $received - $refunded - $adjusted;
                    $pendingRefund = $r->status === 'checked_out' ? $held : 0;
                    $rows[] = [$r->full_name, $received, $refunded, $adjusted, $held, $pendingRefund];
                }
            }
        } else {
            $headers = ['Resident', 'Room', 'Bed', 'Check-in', 'Check-out', 'Stay Days', 'Rent (INR)', 'Pending Dues', 'Pending Refund', 'Reason'];
            foreach (Allocation::with(['resident', 'bed' => fn ($q) => $q->with(['room' => fn ($q) => $q->withTrashed()])])->get() as $a) {
                $checkout = $a->resident->checkouts()->where('allocation_id', $a->id)->first();
                $days = $a->check_out ? Carbon::parse($a->check_in)->diffInDays(Carbon::parse($a->check_out)) + 1 : '';
                $rows[] = [$a->resident->full_name, $a->bed->room->number, $a->bed->name, $a->check_in, $a->check_out ?? 'Active', $days, $a->rent, $checkout?->pending_rent ?? '', $checkout?->pending_refund ?? '', $checkout?->reason ?? ''];
            }
        }

        return ['title' => self::TYPES[$type] ?? self::TYPES['history'], 'headers' => $headers, 'rows' => $rows];
    }
}
