<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Services\AccountingService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PartnerController extends Controller
{
    public function index(AccountingService $service)
    {
        return view('partners.index', ['partners' => Partner::withTrashed()->orderBy('name')->get(), 'positions' => $service->summary()['partners']]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $this->validateShares($data['status'] === 'active' ? ($data['profit_share'] ?? null) : null);
        Partner::create($data + ['uid' => 'PTR-'.strtoupper(Str::random(8)), 'created_by' => auth()->id()]);

        return back()->with('success', 'Partner added.');
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $this->validated($request, $partner);
        $this->validateShares($data['status'] === 'active' ? ($data['profit_share'] ?? null) : null, $partner->id);
        $partner->update($data);

        return back()->with('success', 'Partner updated.');
    }

    public function statement(Partner $partner, AccountingService $service)
    {
        $position = $service->summary()['partners']->first(fn ($row) => $row['partner']->id === $partner->id);
        $transactions = $partner->transactions()->with(['expenseCategory', 'creator'])->latest('transaction_date')->paginate(20);

        return view('partners.statement', compact('partner', 'position', 'transactions'));
    }

    private function validated(Request $request, ?Partner $partner = null): array
    {
        return $request->validate(['name' => ['required', 'string', 'max:150', Rule::unique('partners')->ignore($partner?->id)], 'profit_share' => 'nullable|numeric|min:0|max:100', 'status' => 'required|in:active,inactive']);
    }

    private function validateShares($share, ?int $except = null): void
    {
        if ($share === null || $share === '') {
            return;
        }
        $total = (float) Partner::where('status', 'active')->when($except, fn ($q) => $q->whereKeyNot($except))->sum('profit_share') + (float) $share;
        if ($total > 100.0001) {
            throw ValidationException::withMessages(['profit_share' => 'Active partner profit shares cannot exceed 100%.']);
        }
    }
}
