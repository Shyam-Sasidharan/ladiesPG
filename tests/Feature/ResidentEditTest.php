<?php

namespace Tests\Feature;

use App\Models\Resident;
use App\Models\User;
use Database\Seeders\SJHostelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResidentEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_and_update_resident_3(): void
    {
        $this->seed(SJHostelSeeder::class);
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $resident = Resident::find(3);
        $this->assertNotNull($resident);

        // Test GET /residents/3/edit
        $response = $this->get('/residents/'.$resident->id.'/edit');
        $response->assertOk();
        $response->assertSee($resident->full_name);

        // Test PUT /residents/3 update
        $updateData = [
            'full_name' => 'Alphy Updated',
            'mobile' => $resident->mobile,
            'whatsapp' => $resident->mobile,
            'email' => 'alphy@example.com',
            'date_of_birth' => '2000-01-15',
            'joining_date' => $resident->joining_date->format('Y-m-d'),
            'expected_checkout' => $resident->expected_checkout?->format('Y-m-d'),
            'monthly_rent' => 6500,
            'security_deposit' => 1000,
            'status' => 'active',
            'food_required' => 1,
            'notes' => 'Updated notes',
        ];

        $response = $this->put('/residents/'.$resident->id, $updateData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/residents/'.$resident->id);

        $this->assertEquals('Alphy Updated', $resident->fresh()->full_name);
    }

    public function test_updating_resident_monthly_rent_syncs_allocation_and_rent_records(): void
    {
        $this->seed(SJHostelSeeder::class);
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $savitha = Resident::where('full_name', 'like', '%savitha%')->firstOrFail();
        $this->assertEquals(4200.0, (float) $savitha->monthly_rent);
        $this->assertEquals(4200.0, (float) $savitha->activeAllocation->allocation->rent);

        // Update rent from 4200 to 4500
        $data = [
            'full_name' => $savitha->full_name,
            'mobile' => $savitha->mobile,
            'joining_date' => $savitha->joining_date->format('Y-m-d'),
            'monthly_rent' => 4500,
            'security_deposit' => $savitha->security_deposit,
            'status' => 'active',
            'food_required' => 0,
        ];

        $response = $this->put('/residents/'.$savitha->id, $data);
        $response->assertSessionHasNoErrors();

        $savitha->refresh();
        $this->assertEquals(4500.0, (float) $savitha->monthly_rent);
        $this->assertEquals(4500.0, (float) $savitha->activeAllocation->allocation->rent);
    }

    public function test_checkout_modal_does_not_render_invalid_refund_input_when_deposit_is_zero(): void
    {
        $this->seed(SJHostelSeeder::class);
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        // Find resident with zero deposit held
        $resident = Resident::whereHas('activeAllocation')->get()->first(function ($r) {
            return $r->payments()->where('type', 'deposit')->where('status', 'active')->count() === 0;
        });

        $this->assertNotNull($resident);

        $response = $this->get('/residents/'.$resident->id);
        $response->assertOk();
        $response->assertDontSee('min="0.01" max="0"', false);
        $response->assertDontSee('name="refund_amount"', false);
        $response->assertSee('No security deposit held for this resident');

        // Test checking out the resident
        $checkoutResponse = $this->post(route('residents.checkout', $resident), [
            'date' => today()->toDateString(),
            'reason' => 'Completed college course',
            'refund_security_deposit' => '0',
        ]);

        $checkoutResponse->assertSessionHasNoErrors();
        $checkoutResponse->assertRedirect(route('residents.show', $resident));
        $this->assertEquals('checked_out', $resident->fresh()->status);
    }

    public function test_checked_out_residents_are_excluded_from_next_month_rent_generation_and_billing_default_view(): void
    {
        $this->seed(SJHostelSeeder::class);
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $resident = Resident::where('status', 'active')->whereHas('activeAllocation')->firstOrFail();
        $billingService = app(\App\Services\BillingService::class);
        $allocationService = app(\App\Services\AllocationService::class);

        // Generate rent for current month while active
        $currentMonth = today()->format('Y-m');
        $billingService->generate($currentMonth);

        // Verify current month rent record exists for resident
        $this->assertDatabaseHas('rent_records', [
            'resident_id' => $resident->id,
            'month' => today()->startOfMonth()->toDateString(),
        ]);

        // Checkout the resident
        $allocationService->checkout($resident->id, [
            'date' => today()->toDateString(),
            'reason' => 'Moving to another city',
            'refund_security_deposit' => false,
        ]);

        $this->assertEquals('checked_out', $resident->fresh()->status);

        // Generate rent for next month
        $nextMonth = today()->addMonth()->format('Y-m');
        $billingService->generate($nextMonth);

        // Verify no rent record was created for the checked out resident for next month
        $this->assertDatabaseMissing('rent_records', [
            'resident_id' => $resident->id,
            'month' => today()->addMonth()->startOfMonth()->toDateString(),
        ]);

        // Verify billing index by default does not show checked out residents
        $billingResponse = $this->get(route('billing.index'));
        $billingResponse->assertOk();
        $billingResponse->assertDontSee($resident->full_name);

        // But when specifically filtering for checked out residents, they are visible
        $checkedOutResponse = $this->get(route('billing.index', ['resident_status' => 'checked_out']));
        $checkedOutResponse->assertOk();
        $checkedOutResponse->assertSee($resident->full_name);
    }
}
