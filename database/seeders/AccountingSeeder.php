<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class AccountingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Advance', 'Broker Fees', 'Other Expenses', 'Building', 'Maintenance', 'Electricity', 'Water', 'Internet/Wi-Fi', 'Furniture', 'Beds', 'Appliances', 'Cleaning', 'Painting', 'Groceries', 'Repairs', 'Other'] as $name) {
            ExpenseCategory::firstOrCreate(['name' => $name], ['status' => 'active']);
        }
    }
}
