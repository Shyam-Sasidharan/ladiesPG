<?php

namespace Tests\Feature;

use App\Models\ActiveAllocation;
use App\Models\Allocation;
use App\Models\Checkout;
use App\Models\FinancialTransaction;
use App\Models\Floor;
use App\Models\Payment;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\Room;
use App\Models\User;
use App\Services\AccountingService;
use App\Services\AllocationService;
use App\Services\BillingService;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $user->forceFill(['is_admin' => true])->save();
        $this->actingAs($user);
    }

    private function room(int $capacity = 2): Room
    {
        $floor = Floor::create(['name' => 'Floor '.Floor::count(), 'number' => 0]);
        $room = Room::create(['floor_id' => $floor->id, 'number' => 'R'.Room::count(), 'capacity' => $capacity, 'monthly_rent' => 5000, 'security_deposit' => 10000]);
        foreach (range(1, $capacity) as $n) {
            $room->beds()->create(['name' => 'B'.$n, 'position' => $n]);
        }

        return $room;
    }

    private function resident(): Resident
    {
        return Resident::create(['full_name' => 'Test Resident', 'mobile' => '9000000000', 'joining_date' => today()->toDateString(), 'monthly_rent' => 5000, 'security_deposit' => 10000]);
    }

    public function test_all_management_pages_render(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        app(AllocationService::class)->allocate($resident->id, $room->beds->first()->id, ['date' => today()->toDateString()]);
        app(BillingService::class)->generate(today()->format('Y-m'));
        foreach (['/dashboard', '/residents', '/residents/create', "/residents/{$resident->id}", "/residents/{$resident->id}/edit", '/floors', '/rooms', '/rooms/create', "/rooms/{$room->id}/edit", '/allocation', '/floor-plan', '/billing', '/settings', '/reports'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_non_admin_is_forbidden(): void
    {
        $this->actingAs(User::factory()->create())->get('/dashboard')->assertForbidden();
    }

    public function test_allocation_and_duplicate_bed_and_resident_protection(): void
    {
        $room = $this->room();
        $a = $this->resident();
        $b = $this->resident();
        $service = app(AllocationService::class);
        $service->allocate($a->id, $room->beds[0]->id, ['date' => today()->toDateString()]);
        foreach ([[$b->id, $room->beds[0]->id], [$a->id, $room->beds[1]->id]] as [$resident,$bed]) {
            try {
                $service->allocate($resident, $bed, ['date' => today()->toDateString()]);
                $this->fail('Duplicate allocation accepted');
            } catch (ValidationException $e) {
                $this->assertNotEmpty($e->errors());
            }
        } $this->assertDatabaseCount('active_allocations', 1);
        $this->assertDatabaseCount('allocations', 1);
    }

    public function test_database_enforces_unique_active_bed_and_resident(): void
    {
        $room = $this->room();
        $a = $this->resident();
        $b = $this->resident();
        $first = app(AllocationService::class)->allocate($a->id, $room->beds[0]->id, ['date' => today()->toDateString()]);
        $second = Allocation::create(['resident_id' => $b->id, 'bed_id' => $room->beds[0]->id, 'check_in' => today(), 'rent' => 5000, 'deposit' => 10000]);
        $this->expectException(QueryException::class);
        ActiveAllocation::create(['resident_id' => $b->id, 'bed_id' => $room->beds[0]->id, 'allocation_id' => $second->id]);
    }

    public function test_blocked_beds_cannot_be_allocated(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        foreach (['maintenance', 'reserved'] as $status) {
            $room->beds[0]->update(['status' => $status]);
            $this->post('/allocation', ['resident_id' => $resident->id, 'bed_id' => $room->beds[0]->id, 'date' => today()->toDateString()])->assertSessionHasErrors('allocation');
        } $this->assertDatabaseCount('allocations', 0);
    }

    public function test_failed_transfer_rolls_back_and_success_preserves_history(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        $service = app(AllocationService::class);
        $old = $service->allocate($resident->id, $room->beds[0]->id, ['date' => today()->subDays(3)->toDateString()]);
        $room->beds[1]->update(['status' => 'maintenance']);
        $this->post('/transfer', ['resident_id' => $resident->id, 'bed_id' => $room->beds[1]->id, 'date' => today()->toDateString()])->assertSessionHasErrors('allocation');
        $this->assertNull($old->fresh()->check_out);
        $room->beds[1]->update(['status' => 'available']);
        $service->transfer($resident->id, $room->beds[1]->id, ['date' => today()->toDateString()]);
        $this->assertDatabaseCount('allocations', 2);
        $this->assertDatabaseCount('room_transfers', 1);
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
        $this->assertSame(today()->subDays(3)->toDateString(), $resident->fresh()->joining_date->toDateString());
    }

    public function test_monthly_rent_is_idempotent_and_payments_cannot_overpay(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        app(AllocationService::class)->allocate($resident->id, $room->beds[0]->id, ['date' => today()->toDateString()]);
        $service = app(BillingService::class);
        $this->assertSame(1, $service->generate(today()->format('Y-m')));
        $this->assertSame(0, $service->generate(today()->format('Y-m')));
        $record = RentRecord::first();
        $service->pay(['resident_id' => $resident->id, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => 2000, 'method' => 'upi', 'payment_date' => today()->toDateString()]);
        $this->assertEquals(3000, $record->fresh()->pending);
        $this->assertSame('partially_paid', $record->fresh()->status);
        $this->post('/payments', ['request_token' => (string) Str::uuid(), 'resident_id' => $resident->id, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => 4000, 'method' => 'upi', 'payment_date' => today()->toDateString()])->assertSessionHasErrors('amount');
    }

    public function test_checkout_releases_bed_settles_deposit_and_preserves_records(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        $service = app(AllocationService::class);
        $service->allocate($resident->id, $room->beds[0]->id, ['date' => today()->toDateString(), 'initial_payment' => 10000]);
        app(BillingService::class)->generate(today()->format('Y-m'));
        $checkout = $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Moving city', 'refund_security_deposit' => false, 'refund_amount' => 99999]);
        $this->assertEquals(10000, $checkout->pending_refund);
        $this->assertEquals(0, $checkout->deposit_applied);
        $this->assertEquals(5000, RentRecord::first()->pending);
        $this->assertSame('checked_out', $resident->fresh()->status);
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
        $this->assertDatabaseCount('allocations', 1);
        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('active_allocations', 0);
    }

    public function test_vacate_with_refund_later_releases_only_selected_bed_and_allows_reallocation(): void
    {
        $room = $this->room(3);
        $service = app(AllocationService::class);
        $residents = collect(['Resident A', 'Ayana', 'Resident C'])->map(fn ($name, $index) => Resident::create([
            'full_name' => $name, 'mobile' => '900000001'.$index, 'joining_date' => today(),
            'monthly_rent' => 5000, 'security_deposit' => 8000,
        ]));
        foreach ($residents as $index => $resident) {
            $service->allocate($resident->id, $room->beds[$index]->id, [
                'date' => today()->toDateString(), 'initial_payment' => $index === 1 ? 8000 : 0,
            ]);
        }

        $checkout = $service->checkout($residents[1]->id, [
            'date' => today()->toDateString(), 'notice_date' => today()->subWeek()->toDateString(),
            'reason' => 'Moving home', 'refund_security_deposit' => false,
        ]);

        $this->assertSame('checked_out', $residents[1]->fresh()->status);
        $this->assertEquals(8000, $checkout->pending_refund);
        $this->assertEquals(0, $checkout->deposit_refunded);
        $this->assertSame('available', $room->beds[1]->fresh()->effective_status);
        $this->assertSame('occupied', $room->beds[0]->fresh()->effective_status);
        $this->assertSame('occupied', $room->beds[2]->fresh()->effective_status);
        $this->assertEquals(2, $room->fresh()->occupied);
        $this->assertEquals(1, $room->fresh()->available);
        $this->assertDatabaseCount('allocations', 3);
        $this->assertDatabaseCount('payments', 1);

        $newResident = Resident::create(['full_name' => 'Resident D', 'mobile' => '9000000099', 'joining_date' => today()]);
        $service->allocate($newResident->id, $room->beds[1]->id, ['date' => today()->toDateString()]);
        $this->assertSame('occupied', $room->beds[1]->fresh()->effective_status);
        $this->assertDatabaseCount('allocations', 4);
        $this->assertDatabaseCount('active_allocations', 3);
        $this->assertEquals(2, $room->beds[1]->allocations()->count());
    }

    public function test_refund_now_creates_one_deposit_refund_transaction(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        $service = app(AllocationService::class);
        $service->allocate($resident->id, $room->beds[0]->id, ['date' => today()->toDateString(), 'initial_payment' => 10000]);

        $checkout = $service->checkout($resident->id, [
            'date' => today()->toDateString(), 'reason' => 'Leaving', 'refund_security_deposit' => true,
            'refund_amount' => 10000,
        ]);

        $this->assertEquals(10000, $checkout->deposit_refunded);
        $this->assertEquals(0, $checkout->pending_refund);
        $this->assertDatabaseHas('financial_transactions', [
            'transaction_type' => 'SECURITY_DEPOSIT_REFUND', 'resident_id' => $resident->id,
            'source_type' => Checkout::class, 'source_id' => $checkout->id, 'amount' => 10000,
        ]);
    }

    public function test_checkout_without_deposit_succeeds_without_refund_transaction(): void
    {
        [$service, $room, $resident] = $this->allocatedResidentWithDeposit(0);
        $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Leaving', 'refund_security_deposit' => false]);

        $this->assertSame('checked_out', $resident->fresh()->status);
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
        $this->assertSame(0, FinancialTransaction::where('transaction_type', 'SECURITY_DEPOSIT_REFUND')->count());
    }

    public function test_partial_checkout_refund_leaves_remaining_deposit_pending(): void
    {
        [$service, $room, $resident] = $this->allocatedResidentWithDeposit(8000);
        $checkout = $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Leaving', 'refund_security_deposit' => true, 'refund_amount' => 5000]);

        $this->assertEquals(5000, $checkout->deposit_refunded);
        $this->assertEquals(3000, $checkout->pending_refund);
        $this->assertEquals(3000, $service->depositHeldForResident($resident));
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
    }

    public function test_excess_checkout_refund_rolls_back_occupancy_and_financial_history(): void
    {
        [$service, $room, $resident] = $this->allocatedResidentWithDeposit(8000);

        try {
            $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Leaving', 'refund_security_deposit' => true, 'refund_amount' => 9000]);
            $this->fail('An excessive refund was accepted.');
        } catch (ValidationException $exception) {
            $this->assertSame('Refund exceeds the security deposit currently held.', $exception->errors()['allocation'][0]);
        }

        $this->assertSame('active', $resident->fresh()->status);
        $this->assertSame('occupied', $room->beds[0]->fresh()->effective_status);
        $this->assertDatabaseCount('checkouts', 0);
        $this->assertSame(0, FinancialTransaction::where('transaction_type', 'SECURITY_DEPOSIT_REFUND')->count());
    }

    public function test_unchecked_refund_ignores_a_hidden_excess_amount(): void
    {
        [$service, $room, $resident] = $this->allocatedResidentWithDeposit(8000);
        $checkout = $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Leaving', 'refund_security_deposit' => false, 'refund_amount' => 9000]);

        $this->assertEquals(0, $checkout->deposit_refunded);
        $this->assertEquals(8000, $checkout->pending_refund);
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
    }

    public function test_checkout_refund_works_for_legacy_deposit_missing_ledger_link(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        $service = app(AllocationService::class);
        $service->allocate($resident->id, $room->beds[0]->id, ['date' => today()->toDateString()]);
        Payment::withoutEvents(fn () => Payment::create(['resident_id' => $resident->id, 'type' => 'deposit', 'amount' => 8000, 'payment_date' => today(), 'method' => 'cash', 'status' => 'active']));

        $checkout = $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Leaving', 'refund_security_deposit' => true, 'refund_amount' => 8000]);

        $this->assertEquals(8000, $checkout->deposit_refunded);
        $this->assertEquals(0, $service->depositHeldForResident($resident));
        $this->assertDatabaseCount('financial_transactions', 2);
    }

    public function test_checkout_refunds_only_balance_remaining_after_previous_refund(): void
    {
        [$service, $room, $resident] = $this->allocatedResidentWithDeposit(8000);
        app(AccountingService::class)->create([
            'request_token' => (string) Str::uuid(), 'transaction_date' => today(),
            'transaction_type' => 'SECURITY_DEPOSIT_REFUND', 'resident_id' => $resident->id,
            'amount' => 3000, 'description' => 'Earlier partial deposit refund',
        ]);

        $checkout = $service->checkout($resident->id, [
            'date' => today()->toDateString(), 'reason' => 'Leaving',
            'refund_security_deposit' => true, 'refund_amount' => 5000,
        ]);

        $this->assertEquals(5000, $checkout->deposit_held);
        $this->assertEquals(5000, $checkout->deposit_refunded);
        $this->assertEquals(0, $service->depositHeldForResident($resident));
        $this->assertEquals(8000, FinancialTransaction::where('transaction_type', 'SECURITY_DEPOSIT_REFUND')->sum('amount'));
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
    }

    private function allocatedResidentWithDeposit(float $deposit): array
    {
        $room = $this->room();
        $resident = $this->resident();
        $service = app(AllocationService::class);
        $service->allocate($resident->id, $room->beds[0]->id, ['date' => today()->toDateString(), 'initial_payment' => $deposit]);

        return [$service, $room, $resident];
    }

    public function test_resident_documents_are_private_and_validated(): void
    {
        Storage::fake('local');
        $resident = $this->resident();
        $this->post("/residents/{$resident->id}/documents", ['name' => 'ID', 'type' => 'id_proof', 'document' => UploadedFile::fake()->image('id.jpg')])->assertSessionHasNoErrors();
        $doc = $resident->documents()->firstOrFail();
        Storage::disk('local')->assertExists($doc->path);
        $this->get('/documents/'.$doc->id)->assertOk();
        auth()->logout();
        $this->get('/documents/'.$doc->id)->assertRedirect('/login');
    }

    public function test_reports_export_pdf_and_real_xlsx(): void
    {
        $this->room();
        $this->get('/reports?format=pdf')->assertOk()->assertHeader('content-type', 'application/pdf');
        $response = $this->get('/reports?format=xlsx');
        $response->assertOk();
        $this->assertStringStartsWith('PK', $response->streamedContent());
    }

    public function test_room_capacity_creates_beds_and_cannot_shrink_history(): void
    {
        $floor = Floor::create(['name' => 'Ground', 'number' => 0]);
        $data = ['floor_id' => $floor->id, 'number' => '101', 'type' => 'Sharing', 'capacity' => 5, 'monthly_rent' => 5000, 'security_deposit' => 10000, 'status' => 'active'];
        $this->post('/rooms', $data)->assertSessionHasNoErrors();
        $this->assertDatabaseCount('beds', 5);
        $room = Room::first();
        $data['capacity'] = 3;
        $this->put('/rooms/'.$room->id, $data)->assertSessionHasErrors('capacity');
        $this->assertEquals(5, $room->fresh()->capacity);
    }
}
