<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountingTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $kind = $this->input('kind');

        return [
            'request_token' => 'required|uuid|unique:financial_transactions,request_token',
            'kind' => 'required|in:contribution,expense,other_income,withdrawal,reimbursement,deposit_refund',
            'transaction_date' => 'required|date|before_or_equal:today', 'amount' => 'required|numeric|min:0.01|max:999999999',
            'partner_id' => [Rule::requiredIf(in_array($kind, ['contribution', 'withdrawal', 'reimbursement']) || ($kind === 'expense' && $this->input('paid_from') === 'PARTNER')), 'nullable', Rule::exists('partners', 'id')->where('status', 'active')->whereNull('deleted_at')],
            'resident_id' => [Rule::requiredIf($kind === 'deposit_refund'), 'nullable', 'exists:residents,id'],
            'expense_category_id' => [Rule::requiredIf($kind === 'expense'), 'nullable', Rule::exists('expense_categories', 'id')->where('status', 'active')],
            'paid_from' => [Rule::requiredIf($kind === 'expense'), 'nullable', 'in:PARTNER,BUSINESS'],
            'payment_method' => 'required|in:cash,upi,bank,card,cheque', 'reference_number' => 'nullable|string|max:255',
            'description' => 'required|string|max:255', 'notes' => 'nullable|string|max:5000',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:10240',
        ];
    }
}
