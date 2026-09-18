<?php

namespace Tests\Feature;

use App\Models\ActiveAllocation;
use App\Models\Allocation;
use App\Models\Floor;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\Room;
use App\Models\User;
use App\Services\AllocationService;
use App\Services\BillingService;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    private function room(): Room
    {
        $floor = Floor::create(['name' => 'Floor '.Floor::count(), 'number' => 0]);
        $room = Room::create(['floor_id' => $floor->id, 'number' => 'R'.Room::count(), 'capacity' => 2, 'monthly_rent' => 5000, 'security_deposit' => 10000]);
        foreach ([1, 2] as $n) {
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
        foreach (['/', '/residents', '/residents/create', "/residents/{$resident->id}", "/residents/{$resident->id}/edit", '/floors', '/rooms', '/rooms/create', "/rooms/{$room->id}/edit", '/allocation', '/floor-plan', '/billing', '/settings', '/reports'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_non_admin_is_forbidden(): void
    {
        $this->actingAs(User::factory()->create())->get('/')->assertForbidden();
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
        $this->post('/payments', ['resident_id' => $resident->id, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => 4000, 'method' => 'upi', 'payment_date' => today()->toDateString()])->assertSessionHasErrors('amount');
    }

    public function test_checkout_releases_bed_settles_deposit_and_preserves_records(): void
    {
        $room = $this->room();
        $resident = $this->resident();
        $service = app(AllocationService::class);
        $service->allocate($resident->id, $room->beds[0]->id, ['date' => today()->toDateString(), 'initial_payment' => 10000]);
        app(BillingService::class)->generate(today()->format('Y-m'));
        $checkout = $service->checkout($resident->id, ['date' => today()->toDateString(), 'reason' => 'Moving city', 'deductions' => 500]);
        $this->assertEquals(4500, $checkout->refund);
        $this->assertEquals(5000, $checkout->deposit_applied);
        $this->assertEquals(0, RentRecord::first()->pending);
        $this->assertSame('checked_out', $resident->fresh()->status);
        $this->assertSame('available', $room->beds[0]->fresh()->effective_status);
        $this->assertDatabaseCount('allocations', 1);
        $this->assertDatabaseCount('payments', 2);
        $this->assertDatabaseCount('active_allocations', 0);
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
        $this->put('/rooms/'.$room->id,$data)->assertSessionHasErrors('capacity');
        $this->assertEquals(5,$room->fresh()->capacity);
    }
}
