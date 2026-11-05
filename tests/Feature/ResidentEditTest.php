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
}
