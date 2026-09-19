<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\FinancialTransaction;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoricalPartnerTransactionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $userId = User::where('is_admin', true)->value('id') ?? User::value('id');
            $partners = collect(['Shyam', 'Jees'])->mapWithKeys(fn ($name) => [$name => Partner::firstOrCreate(
                ['name' => $name],
                ['uid' => 'PTR-'.strtoupper($name), 'status' => 'active', 'created_by' => $userId]
            )]);
            $categories = collect(['Broker Fees', 'Other Expenses'])->mapWithKeys(fn ($name) => [$name => ExpenseCategory::firstOrCreate(['name' => $name], ['status' => 'active'])]);

            FinancialTransaction::where('transaction_number', 'like', 'HIST-%')
                ->where('notes', 'Imported historical partner transaction')
                ->whereIn('transaction_type', ['PARTNER_CONTRIBUTION', 'PARTNER_PAID_EXPENSE'])
                ->delete();

            $entries = [
                ['Shyam', 'PARTNER_CONTRIBUTION', null, 'Advance', 60000],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Broker Fees', 'Broker Fee', 30000],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'WiFi', 1500],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Vishal Mart', 2000],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Kaloor double-decker porter fee', 300],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Dustbin', 300],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Washing machine', 5000],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Double-decker Kalamassery', 8700],
                ['Shyam', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Garbage bag', 200],
                ['Jees', 'PARTNER_CONTRIBUTION', null, 'Advance', 60000],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Bed & pillow - Broadway', 8000],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Water purifier', 7000],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Agreement paper', 500],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'PG poster', 100],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Double-decker advance - Kalamassery', 3000],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Double-decker - Kaloor', 3250],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Paint', 600],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Bucket + garbage bag', 400],
                ['Jees', 'PARTNER_PAID_EXPENSE', 'Other Expenses', 'Double-decker - Kalamassery', 15150],
            ];

            foreach ($entries as $index => [$partner, $type, $category, $description, $amount]) {
                FinancialTransaction::create([
                    'uid' => sprintf('HISTORICAL-%03d', $index + 1),
                    'transaction_number' => sprintf('HIST-%03d', $index + 1),
                    'transaction_date' => '2026-09-01',
                    'transaction_type' => $type,
                    'partner_id' => $partners[$partner]->id,
                    'expense_category_id' => $category ? $categories[$category]->id : null,
                    'amount' => $amount,
                    'direction' => $type === 'PARTNER_CONTRIBUTION' ? 'IN' : 'OUT',
                    'paid_from' => $type === 'PARTNER_PAID_EXPENSE' ? 'PARTNER' : null,
                    'payment_method' => 'cash',
                    'description' => $description,
                    'notes' => 'Imported historical partner transaction',
                    'status' => 'active',
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }
        });
    }
}
