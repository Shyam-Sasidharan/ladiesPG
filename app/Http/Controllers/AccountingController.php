<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountingTransactionRequest;
use App\Models\ExpenseCategory;
use App\Models\FinancialTransaction;
use App\Models\Partner;
use App\Models\Resident;
use App\Services\AccountingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountingController extends Controller
{
    public function summary(AccountingService $service)
    {
        return view('accounting.summary', $service->summary());
    }

    public function create(Request $request, AccountingService $service)
    {
        $kind = $request->input('kind', 'expense');
        abort_unless(in_array($kind, ['contribution', 'expense', 'other_income', 'withdrawal', 'reimbursement', 'deposit_refund']), 404);

        return view('accounting.create', ['kind' => $kind, 'partners' => Partner::where('status', 'active')->orderBy('name')->get(),
            'categories' => ExpenseCategory::where('status', 'active')->orderBy('name')->get(), 'residents' => Resident::orderBy('full_name')->get(),
            'methods' => AccountingService::METHODS, 'summary' => $service->summary()]);
    }

    public function store(AccountingTransactionRequest $request, AccountingService $service)
    {
        $data = $request->safe()->except(['kind', 'attachment']);
        $data['transaction_type'] = match ($request->kind) {
            'contribution' => 'PARTNER_CONTRIBUTION', 'expense' => $request->paid_from === 'PARTNER' ? 'PARTNER_PAID_EXPENSE' : 'BUSINESS_EXPENSE',
            'other_income' => 'OTHER_INCOME', 'withdrawal' => 'PARTNER_PROFIT_WITHDRAWAL',
            'reimbursement' => 'PARTNER_REIMBURSEMENT', 'deposit_refund' => 'SECURITY_DEPOSIT_REFUND',
        };
        if ($data['transaction_type'] !== 'PARTNER_PAID_EXPENSE' && ! in_array($data['transaction_type'], ['PARTNER_CONTRIBUTION', 'PARTNER_PROFIT_WITHDRAWAL', 'PARTNER_REIMBURSEMENT'])) {
            $data['partner_id'] = null;
        }
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $data['attachment_path'] = $file->store('accounting-attachments', 'local');
            $data['attachment_name'] = $file->getClientOriginalName();
        }
        $transaction = $service->create($data);

        return redirect()->route('accounting.transactions.show', $transaction)->with('success', 'Transaction posted successfully.');
    }

    public function history(Request $request)
    {
        $query = FinancialTransaction::with(['partner', 'resident', 'expenseCategory', 'creator']);
        if ($request->filled('from')) {
            $query->whereDate('transaction_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('transaction_date', '<=', $request->to);
        }
        if ($request->filled('type')) {
            $query->where('transaction_type', $request->type);
        }
        if ($request->filled('partner_id')) {
            $query->where('partner_id', $request->partner_id);
        }
        if ($request->filled('resident_id')) {
            $query->where('resident_id', $request->resident_id);
        }
        if ($request->filled('expense_category_id')) {
            $query->where('expense_category_id', $request->expense_category_id);
        }
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
        if ($request->filled('q')) {
            $term = '%'.$request->q.'%';
            $query->where(fn ($q) => $q->where('transaction_number', 'like', $term)->orWhere('description', 'like', $term)->orWhere('reference_number', 'like', $term)
                ->orWhereHas('partner', fn ($p) => $p->where('name', 'like', $term))->orWhereHas('resident', fn ($r) => $r->where('full_name', 'like', $term)));
        }

        return view('accounting.history', ['transactions' => $query->latest('transaction_date')->latest('id')->paginate(20)->withQueryString(),
            'types' => AccountingService::TYPES, 'partners' => Partner::withTrashed()->orderBy('name')->get(),
            'residents' => Resident::withTrashed()->orderBy('full_name')->get(), 'categories' => ExpenseCategory::orderBy('name')->get(), 'methods' => AccountingService::METHODS]);
    }

    public function show(FinancialTransaction $transaction)
    {
        $transaction->load(['partner', 'resident', 'expenseCategory', 'creator', 'updater', 'source', 'reversal', 'reversalOf']);

        return view('accounting.show', compact('transaction'));
    }

    public function reverse(Request $request, FinancialTransaction $transaction, AccountingService $service)
    {
        $data = $request->validate(['reason' => 'required|string|min:5|max:1000']);
        $service->reverse($transaction, $data['reason']);

        return back()->with('success', 'Transaction reversed. The original record remains in history.');
    }

    public function attachment(FinancialTransaction $transaction)
    {
        abort_unless($transaction->attachment_path && Storage::disk('local')->exists($transaction->attachment_path), 404);

        return Storage::disk('local')->download($transaction->attachment_path, $transaction->attachment_name, ['X-Content-Type-Options' => 'nosniff']);
    }
}
