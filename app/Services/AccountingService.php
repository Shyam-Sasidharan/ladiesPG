<?php

namespace App\Services;

use App\Models\ExpenseCategory;
use App\Models\FinancialTransaction;
use App\Models\Partner;
use App\Models\Payment;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AccountingService
{
    public const TYPES = [
        'PARTNER_CONTRIBUTION' => 'Partner Contribution', 'PARTNER_PAID_EXPENSE' => 'Partner-paid Expense',
        'BUSINESS_EXPENSE' => 'Business-funded Expense', 'RENT_INCOME' => 'Rent Income', 'OTHER_INCOME' => 'Other Income',
        'SECURITY_DEPOSIT_RECEIVED' => 'Security Deposit Received', 'SECURITY_DEPOSIT_REFUND' => 'Security Deposit Refund',
        'SECURITY_DEPOSIT_ADJUSTMENT' => 'Deposit Applied to Rent', 'PARTNER_PROFIT_WITHDRAWAL' => 'Profit Withdrawal',
        'PARTNER_REIMBURSEMENT' => 'Partner Reimbursement', 'REVERSAL' => 'Reversal',
    ];

    public const METHODS = ['cash' => 'Cash', 'upi' => 'UPI', 'bank' => 'Bank Transfer', 'card' => 'Card', 'cheque' => 'Cheque'];

    public function recordPayment(Payment $payment): FinancialTransaction
    {
        $type = match (true) {
            $payment->method === 'deposit_adjustment' => 'SECURITY_DEPOSIT_ADJUSTMENT',
            $payment->type === 'rent' => 'RENT_INCOME',
            default => 'SECURITY_DEPOSIT_RECEIVED',
        };
        $transaction = FinancialTransaction::firstOrCreate(
            ['source_type' => Payment::class, 'source_id' => $payment->id],
            ['uid' => (string) Str::ulid(), 'transaction_number' => $this->number($type),
                'transaction_date' => $payment->payment_date, 'transaction_type' => $type,
                'resident_id' => $payment->resident_id, 'amount' => $payment->amount,
                'direction' => $type === 'SECURITY_DEPOSIT_ADJUSTMENT' ? 'INTERNAL' : 'IN',
                'payment_method' => $payment->method, 'reference_number' => $payment->reference,
                'description' => $type === 'RENT_INCOME' ? 'Rent received from '.$payment->resident->full_name :
                    ($type === 'SECURITY_DEPOSIT_RECEIVED' ? 'Security deposit received from '.$payment->resident->full_name : 'Security deposit applied to rent for '.$payment->resident->full_name),
                'notes' => $payment->notes, 'status' => $payment->status ?? 'active',
                'created_by' => $payment->created_by, 'updated_by' => $payment->updated_by]
        );
        if (! $payment->transaction_number) {
            $payment->updateQuietly(['transaction_number' => $transaction->transaction_number]);
        }

        return $transaction;
    }

    public function create(array $data): FinancialTransaction
    {
        try {
            return DB::transaction(function () use ($data) {
                DB::table('users')->where('id', auth()->id())->lockForUpdate()->first();
                $this->validateFunds($data);

                return FinancialTransaction::create($data + [
                    'uid' => (string) Str::ulid(), 'transaction_number' => $this->number($data['transaction_type']),
                    'direction' => $this->direction($data['transaction_type']), 'status' => 'active',
                    'created_by' => auth()->id(), 'updated_by' => auth()->id(),
                ]);
            }, 5);
        } catch (UniqueConstraintViolationException $e) {
            $existing = isset($data['request_token']) ? FinancialTransaction::where('request_token', $data['request_token'])->first() : null;
            if ($existing) {
                return $existing;
            }
            throw $e;
        }
    }

    public function reverse(FinancialTransaction $transaction, string $reason): FinancialTransaction
    {
        return DB::transaction(function () use ($transaction, $reason) {
            $transaction = FinancialTransaction::lockForUpdate()->findOrFail($transaction->id);
            if ($transaction->status !== 'active' || $transaction->reversal_of_id) {
                throw ValidationException::withMessages(['transaction' => 'Only active original transactions can be reversed.']);
            }
            $transaction->update(['status' => 'reversed', 'updated_by' => auth()->id(), 'notes' => trim(($transaction->notes ? $transaction->notes."\n" : '').'Reversal reason: '.$reason)]);
            if ($transaction->source instanceof Payment) {
                $transaction->source->updateQuietly(['status' => 'reversed', 'updated_by' => auth()->id()]);
            }

            return FinancialTransaction::create([
                'uid' => (string) Str::ulid(), 'transaction_number' => $this->number('REVERSAL'),
                'transaction_date' => today(), 'transaction_type' => 'REVERSAL', 'partner_id' => $transaction->partner_id,
                'resident_id' => $transaction->resident_id, 'expense_category_id' => $transaction->expense_category_id,
                'amount' => $transaction->amount, 'direction' => $transaction->direction === 'IN' ? 'OUT' : ($transaction->direction === 'OUT' ? 'IN' : 'INTERNAL'),
                'paid_from' => $transaction->paid_from, 'payment_method' => $transaction->payment_method,
                'reference_number' => $transaction->transaction_number, 'description' => 'Reversal of '.$transaction->transaction_number,
                'notes' => $reason, 'status' => 'reversal', 'reversal_of_id' => $transaction->id,
                'created_by' => auth()->id(), 'updated_by' => auth()->id(),
            ]);
        }, 5);
    }

    public function summary(): array
    {
        $tx = FinancialTransaction::where('status', 'active')->whereNull('reversal_of_id')->get();
        $sum = fn (string|array $types) => (float) $tx->whereIn('transaction_type', (array) $types)->sum('amount');
        $rent = $sum('RENT_INCOME') + $sum('SECURITY_DEPOSIT_ADJUSTMENT');
        $other = $sum('OTHER_INCOME');
        $expenses = $sum(['PARTNER_PAID_EXPENSE', 'BUSINESS_EXPENSE']);
        $profit = $rent + $other - $expenses;
        $depositHeld = $sum('SECURITY_DEPOSIT_RECEIVED') - $sum(['SECURITY_DEPOSIT_REFUND', 'SECURITY_DEPOSIT_ADJUSTMENT']);
        $fund = $sum(['PARTNER_CONTRIBUTION', 'RENT_INCOME', 'OTHER_INCOME', 'SECURITY_DEPOSIT_RECEIVED'])
            - $sum(['BUSINESS_EXPENSE', 'SECURITY_DEPOSIT_REFUND', 'PARTNER_PROFIT_WITHDRAWAL', 'PARTNER_REIMBURSEMENT']);
        $withdrawn = $sum('PARTNER_PROFIT_WITHDRAWAL');
        $available = max(0, min($profit - $withdrawn, $fund - max(0, $depositHeld)));
        $categories = ExpenseCategory::whereIn('id', $tx->where('transaction_type', 'PARTNER_PAID_EXPENSE')->pluck('expense_category_id')->filter()->unique())
            ->orderBy('name')->get();
        $partners = Partner::withTrashed()->orderBy('name')->get()->map(function ($partner) use ($tx, $profit, $categories) {
            $rows = $tx->where('partner_id', $partner->id);
            $direct = (float) $rows->where('transaction_type', 'PARTNER_CONTRIBUTION')->sum('amount');
            $expenses = (float) $rows->where('transaction_type', 'PARTNER_PAID_EXPENSE')->sum('amount');
            $received = (float) $rows->whereIn('transaction_type', ['PARTNER_PROFIT_WITHDRAWAL', 'PARTNER_REIMBURSEMENT'])->sum('amount');
            $withdrawal = (float) $rows->where('transaction_type', 'PARTNER_PROFIT_WITHDRAWAL')->sum('amount');
            $reimbursement = (float) $rows->where('transaction_type', 'PARTNER_REIMBURSEMENT')->sum('amount');
            $entitlement = $partner->profit_share === null ? null : $profit * (float) $partner->profit_share / 100;
            $categoryTotals = $categories->mapWithKeys(fn ($category) => [$category->id => (float) $rows->where('transaction_type', 'PARTNER_PAID_EXPENSE')->where('expense_category_id', $category->id)->sum('amount')]);

            return compact('partner', 'direct', 'expenses', 'received', 'withdrawal', 'reimbursement', 'entitlement', 'categoryTotals') + ['total' => $direct + $expenses, 'net' => $direct + $expenses - $received, 'remaining_entitlement' => $entitlement === null ? null : $entitlement - $withdrawal];
        });

        return compact('rent', 'other', 'expenses', 'profit', 'depositHeld', 'fund', 'available', 'partners', 'categories');
    }

    private function validateFunds(array $data): void
    {
        $type = $data['transaction_type'];
        $amount = (float) $data['amount'];
        $summary = $this->summary();
        if (in_array($type, ['BUSINESS_EXPENSE', 'SECURITY_DEPOSIT_REFUND', 'PARTNER_REIMBURSEMENT']) && $amount > $summary['fund']) {
            throw ValidationException::withMessages(['amount' => 'Insufficient property funds for this transaction.']);
        }
        if ($type === 'SECURITY_DEPOSIT_REFUND' && $amount > $summary['depositHeld']) {
            throw ValidationException::withMessages(['amount' => 'Refund exceeds the security deposit currently held.']);
        }
        if ($type === 'SECURITY_DEPOSIT_REFUND') {
            $residentHeld = FinancialTransaction::where('resident_id', $data['resident_id'])->where('status', 'active')->whereNull('reversal_of_id')->get()->sum(fn ($transaction) => match ($transaction->transaction_type) {
                'SECURITY_DEPOSIT_RECEIVED' => (float) $transaction->amount,
                'SECURITY_DEPOSIT_REFUND', 'SECURITY_DEPOSIT_ADJUSTMENT' => -(float) $transaction->amount,
                default => 0,
            });
            if ($amount > $residentHeld) {
                throw ValidationException::withMessages(['amount' => 'Refund exceeds the security deposit held for this resident.']);
            }
        }
        if ($type === 'PARTNER_PROFIT_WITHDRAWAL') {
            if ($amount > $summary['available']) {
                throw ValidationException::withMessages(['amount' => 'Amount exceeds the currently distributable profit.']);
            }
            $position = $summary['partners']->first(fn ($row) => $row['partner']->id === (int) $data['partner_id']);
            if ($position && $position['remaining_entitlement'] !== null && $amount > $position['remaining_entitlement']) {
                throw ValidationException::withMessages(['amount' => 'Amount exceeds this partner’s remaining profit entitlement.']);
            }
        }
    }

    private function direction(string $type): string
    {
        return in_array($type, ['PARTNER_CONTRIBUTION', 'OTHER_INCOME']) ? 'IN' : 'OUT';
    }

    private function number(string $type): string
    {
        $prefix = ['PARTNER_CONTRIBUTION' => 'CON', 'PARTNER_PAID_EXPENSE' => 'EXP', 'BUSINESS_EXPENSE' => 'EXP', 'RENT_INCOME' => 'RENT', 'OTHER_INCOME' => 'INC', 'SECURITY_DEPOSIT_RECEIVED' => 'DEP', 'SECURITY_DEPOSIT_REFUND' => 'REF', 'SECURITY_DEPOSIT_ADJUSTMENT' => 'ADJ', 'PARTNER_PROFIT_WITHDRAWAL' => 'WDL', 'PARTNER_REIMBURSEMENT' => 'RMB', 'REVERSAL' => 'REV'][$type] ?? 'TXN';

        return $prefix.'-'.now()->format('Ymd').'-'.strtoupper(Str::random(8));
    }
}
