<?php

namespace Tests\Feature;

use App\Models\ExpenseCategory;
use App\Models\FinancialTransaction;
use App\Models\Partner;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\User;
use App\Services\AccountingService;
use App\Services\BillingService;
use Database\Seeders\HistoricalPartnerTransactionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PartnerAccountingTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private AccountingService $accounting;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->forceFill(['is_admin' => true])->save();
        $this->actingAs($this->admin);
        $this->accounting = app(AccountingService::class);
    }

    public function test_complete_two_partner_scenario_reconciles_without_double_counting(): void
    {
        $a = Partner::create(['uid' => 'PTR-A', 'name' => 'Partner A', 'created_by' => $this->admin->id]);
        $b = Partner::create(['uid' => 'PTR-B', 'name' => 'Partner B', 'created_by' => $this->admin->id]);
        $wifi = ExpenseCategory::create(['name' => 'Internet/Wi-Fi']);
        $appliance = ExpenseCategory::create(['name' => 'Appliances']);
        $electricity = ExpenseCategory::create(['name' => 'Electricity']);
        $r1 = Resident::create(['full_name' => 'Resident 1', 'mobile' => '9000000001', 'joining_date' => today(), 'monthly_rent' => 4000, 'security_deposit' => 8000]);
        $r2 = Resident::create(['full_name' => 'Resident 2', 'mobile' => '9000000002', 'joining_date' => today(), 'monthly_rent' => 4000, 'security_deposit' => 8000]);

        $this->entry('PARTNER_CONTRIBUTION', 90000, ['partner_id' => $a->id, 'description' => 'Building contribution']);
        $this->entry('PARTNER_CONTRIBUTION', 30000, ['partner_id' => $b->id, 'description' => 'Building contribution']);
        $this->entry('PARTNER_PAID_EXPENSE', 1500, ['partner_id' => $a->id, 'expense_category_id' => $wifi->id, 'paid_from' => 'PARTNER', 'description' => 'Wi-Fi']);
        $this->entry('PARTNER_PAID_EXPENSE', 7000, ['partner_id' => $b->id, 'expense_category_id' => $appliance->id, 'paid_from' => 'PARTNER', 'description' => 'Water purifier']);
        foreach ([$r1, $r2] as $resident) {
            $record = RentRecord::create(['resident_id' => $resident->id, 'month' => today()->startOfMonth(), 'due_date' => today(), 'amount' => 4000]);
            app(BillingService::class)->pay(['request_token' => (string) Str::uuid(), 'resident_id' => $resident->id, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => 4000, 'method' => 'upi', 'payment_date' => today()]);
            app(BillingService::class)->pay(['request_token' => (string) Str::uuid(), 'resident_id' => $resident->id, 'type' => 'deposit', 'amount' => 8000, 'method' => 'bank', 'payment_date' => today()]);
        }
        $this->entry('BUSINESS_EXPENSE', 2000, ['expense_category_id' => $electricity->id, 'paid_from' => 'BUSINESS', 'description' => 'Electricity']);

        $summary = $this->accounting->summary();
        $this->assertEquals(8000, $summary['rent']);
        $this->assertEquals(16000, $summary['depositHeld']);
        $this->assertEquals(10500, $summary['expenses']);
        $this->assertEquals(-2500, $summary['profit']);
        $this->assertEquals(142000, $summary['fund']);
        $this->assertEquals(0, $summary['available']);
        $this->assertEquals(91500, $summary['partners']->firstWhere('partner.id', $a->id)['total']);
        $this->assertEquals(37000, $summary['partners']->firstWhere('partner.id', $b->id)['total']);
        $this->assertEquals(54500, $summary['partners']->firstWhere('partner.id', $a->id)['total'] - $summary['partners']->firstWhere('partner.id', $b->id)['total']);
        $this->assertDatabaseCount('financial_transactions', 9);
        $this->assertDatabaseCount('payments', 4);

        try {
            $this->entry('PARTNER_PROFIT_WITHDRAWAL', 1000, ['partner_id' => $a->id, 'description' => 'Profit transfer']);
            $this->fail('Withdrawal from an operating loss was accepted.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('amount', $e->errors());
        }
        $this->entry('OTHER_INCOME', 3500, ['description' => 'Other property income']);
        $withdrawal = $this->entry('PARTNER_PROFIT_WITHDRAWAL', 1000, ['partner_id' => $a->id, 'description' => 'Profit transfer']);
        $summary = $this->accounting->summary();
        $this->assertEquals(1000, $summary['profit']);
        $this->assertEquals(1000, $summary['partners']->firstWhere('partner.id', $a->id)['received']);
        $this->assertEquals(144500, $summary['fund']);
        $this->assertEquals(0, $summary['available']);
        $this->get('/accounting/transactions')->assertOk()->assertSee($withdrawal->transaction_number);
        $this->get('/partners/'.$a->id.'/statement')->assertOk()->assertSee('91,500.00');
    }

    public function test_actual_shyam_and_jees_historical_dataset_matches_acceptance_totals(): void
    {
        $this->seed(HistoricalPartnerTransactionsSeeder::class);

        $summary = $this->accounting->summary();
        $shyam = $summary['partners']->firstWhere('partner.name', 'Shyam');
        $jees = $summary['partners']->firstWhere('partner.name', 'Jees');
        $broker = $summary['categories']->firstWhere('name', 'Broker Fees');
        $other = $summary['categories']->firstWhere('name', 'Other Expenses');

        $this->assertEquals(60000, $shyam['direct']);
        $this->assertEquals(30000, $shyam['categoryTotals'][$broker->id]);
        $this->assertEquals(18000, $shyam['categoryTotals'][$other->id]);
        $this->assertEquals(108000, $shyam['total']);
        $this->assertEquals(60000, $jees['direct']);
        $this->assertEquals(0, $jees['categoryTotals'][$broker->id]);
        $this->assertEquals(38000, $jees['categoryTotals'][$other->id]);
        $this->assertEquals(98000, $jees['total']);
        $this->assertEquals(206000, $summary['partners']->sum('total'));
        $this->assertEquals(10000, $shyam['total'] - $jees['total']);
        $this->assertDatabaseCount('financial_transactions', 19);

        $this->seed(HistoricalPartnerTransactionsSeeder::class);
        $this->assertDatabaseCount('financial_transactions', 19);
        $this->get('/accounting')->assertOk()->assertSee('108,000.00')->assertSee('98,000.00')->assertSee('206,000.00')->assertSee('10,000.00');
    }

    public function test_reversal_preserves_audit_history_and_restores_totals(): void
    {
        $partner = Partner::create(['uid' => 'PTR-A', 'name' => 'Partner A', 'created_by' => $this->admin->id]);
        $entry = $this->entry('PARTNER_CONTRIBUTION', 10000, ['partner_id' => $partner->id, 'description' => 'Capital']);
        $reversal = $this->accounting->reverse($entry, 'Entered against the wrong partner');
        $this->assertSame('reversed', $entry->fresh()->status);
        $this->assertSame('reversal', $reversal->status);
        $this->assertEquals(0, $this->accounting->summary()['fund']);
        $this->assertDatabaseCount('financial_transactions', 2);
    }

    public function test_payment_is_one_canonical_event_and_reversal_reopens_rent(): void
    {
        $resident = Resident::create(['full_name' => 'Resident', 'mobile' => '9000000000', 'joining_date' => today()]);
        $record = RentRecord::create(['resident_id' => $resident->id, 'month' => today()->startOfMonth(), 'due_date' => today(), 'amount' => 4000]);
        $payment = app(BillingService::class)->pay(['request_token' => (string) Str::uuid(), 'resident_id' => $resident->id, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => 4000, 'method' => 'cash', 'payment_date' => today()]);
        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('financial_transactions', 1);
        $this->assertEquals(0, $record->fresh()->pending);
        $this->accounting->reverse($payment->financialTransaction, 'Payment was recorded twice');
        $this->assertEquals(4000, $record->fresh()->pending);
        $this->assertEquals(0, $this->accounting->summary()['rent']);
    }

    public function test_accounting_pages_and_exports_render(): void
    {
        $partner = Partner::create(['uid' => 'PTR-A', 'name' => 'Partner A', 'created_by' => $this->admin->id]);
        ExpenseCategory::create(['name' => 'Maintenance']);
        $entry = $this->entry('PARTNER_CONTRIBUTION', 10000, ['partner_id' => $partner->id, 'description' => 'Capital']);
        foreach (['/accounting', '/accounting/transactions', '/accounting/transactions/create?kind=expense', '/accounting/transactions/create?kind=contribution', '/accounting/transactions/create?kind=other_income', '/accounting/transactions/create?kind=withdrawal', '/partners', '/partners/'.$partner->id.'/statement', '/accounting/transactions/'.$entry->id, '/reports?type=partner_contributions', '/reports?type=expenses', '/reports?type=income', '/reports?type=deposits', '/reports?type=partner_withdrawals', '/reports?type=transactions'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/reports?type=transactions&format=xlsx')->assertOk();
        $this->get('/reports?type=partner_contributions&format=pdf')->assertOk();
    }

    private function entry(string $type, float $amount, array $extra = []): FinancialTransaction
    {
        return $this->accounting->create($extra + ['request_token' => (string) Str::uuid(), 'transaction_date' => today(), 'transaction_type' => $type, 'amount' => $amount, 'payment_method' => 'bank', 'description' => 'Test transaction']);
    }
}
