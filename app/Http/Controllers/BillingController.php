<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Services\BillingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BillingController extends Controller
{
    public function index(Request $r)
    {
        $q = RentRecord::with(['resident', 'payments', 'allocation.bed.room'])->when($r->month, fn ($q) => $q->where('month', $r->month.'-01'))->when($r->q, fn ($q) => $q->whereHas('resident', fn ($q) => $q->where('full_name', 'like', '%'.$r->q.'%')->orWhere('mobile', 'like', '%'.$r->q.'%')));
        if ($r->filled('status')) {
            $q->withSum('payments', 'amount');
            $paid = "(select coalesce(sum(payments.amount),0) from payments where payments.rent_record_id=rent_records.id and payments.status='active')";
            match ($r->status) {
                'paid' => $q->whereRaw("$paid >= amount + late_fee"),
                'partially_paid' => $q->whereRaw("$paid > 0 AND $paid < amount + late_fee"),
                'overdue' => $q->whereRaw("$paid < amount + late_fee")->whereDate('due_date', '<', today()),
                'due_tomorrow' => $q->whereRaw("$paid < amount + late_fee")->whereDate('due_date', today()->addDay()),
                'due_today' => $q->whereRaw("$paid < amount + late_fee")->whereDate('due_date', today()),
                default => $q->whereRaw("$paid < amount + late_fee")
            };
        }

        return view('billing.index', ['records' => $q->latest('month')->paginate(15)->withQueryString(), 'residents' => Resident::orderBy('full_name')->get(), 'payments' => Payment::with('resident')->where('status', 'active')->latest()->limit(10)->get()]);
    }

    public function generate(Request $r, BillingService $service)
    {
        $data = $r->validate(['month' => 'required|date_format:Y-m']);
        $count = $service->generate($data['month']);

        return back()->with('success', "Generated $count monthly rent records. Existing records were preserved.");
    }

    public function pay(PaymentRequest $r, BillingService $service)
    {
        $service->pay($r->validated());

        return back()->with('success', 'Payment recorded.');
    }

    public function lateFee(Request $r, RentRecord $record)
    {
        $data = $r->validate(['late_fee' => 'required|numeric|min:0|max:999999']);
        DB::transaction(function () use ($record, $data) {
            Resident::withTrashed()->whereKey($record->resident_id)->lockForUpdate()->firstOrFail();
            $record = RentRecord::with('payments')->lockForUpdate()->findOrFail($record->id);
            if ($record->amount + $data['late_fee'] < $record->payments->sum('amount')) {
                throw ValidationException::withMessages(['late_fee' => 'The total invoice cannot be lower than payments already received.']);
            }
            $record->update($data);
        }, 5);

        return back()->with('success', 'Late fee updated.');
    }

    public function updateRecord(Request $r, RentRecord $record)
    {
        $data = $r->validate([
            'amount' => 'required|numeric|min:0|max:9999999',
            'due_date' => 'nullable|date',
        ]);
        DB::transaction(function () use ($record, $data) {
            Resident::withTrashed()->whereKey($record->resident_id)->lockForUpdate()->firstOrFail();
            $record = RentRecord::with('payments')->lockForUpdate()->findOrFail($record->id);
            $paid = $record->payments->sum('amount');
            if ($paid > $data['amount'] + $record->late_fee) {
                throw ValidationException::withMessages(['amount' => 'The invoice amount cannot be lower than payments already received (₹'.number_format($paid, 2).').']);
            }
            $record->update(array_filter($data));
        }, 5);

        return back()->with('success', 'Rent invoice updated.');
    }
}
