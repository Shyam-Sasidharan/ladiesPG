<?php

namespace Tests\Feature;

use App\Models\Bed;
use App\Models\Floor;
use App\Models\Resident;
use App\Models\Room;
use App\Models\User;
use Database\Seeders\SJHostelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExcelResidentsAndDynamicCapacityTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_excel_residents_and_room_allocations_are_properly_seeded(): void
    {
        $admin = $this->admin();
        $this->seed(SJHostelSeeder::class);

        // Verify Ground Floor Room 1 (A1)
        $a1 = Room::where('number', 'A1')->first();
        $this->assertNotNull($a1);
        $this->assertEquals(5, $a1->capacity);
        $this->assertEquals(4, $a1->occupied);
        $this->assertEquals(1, $a1->available);

        // Residents in A1
        $alphy = Resident::where('mobile', '9539633470')->first();
        $this->assertNotNull($alphy);
        $this->assertEquals('Alphy', $alphy->full_name);
        $this->assertEquals('active', $alphy->status);
        $this->assertEquals('DOWN', $alphy->activeAllocation->bed->tier);

        $savitha = Resident::where('mobile', '7593865024')->first();
        $this->assertNotNull($savitha);
        $this->assertEquals('savitha kevin', $savitha->full_name);
        $this->assertEquals('active', $savitha->status);
        $this->assertEquals('DOWN', $savitha->activeAllocation->bed->tier);

        $anakha = Resident::where('mobile', '7306332706')->first();
        $this->assertNotNull($anakha);
        $this->assertEquals('Anakha', $anakha->full_name);
        $this->assertEquals('checked_out', $anakha->status);
        $this->assertNull($anakha->activeAllocation);
        $this->assertTrue($anakha->checkouts()->whereDate('date', '2026-09-27')->exists());

        $neha = Resident::where('mobile', '8606734614')->first();
        $this->assertNotNull($neha);
        $this->assertEquals('Neha mathew', $neha->full_name);
        $this->assertEquals('active', $neha->status);
        $this->assertEquals('DOWN', $neha->activeAllocation->bed->tier);

        $anagha = Resident::where('full_name', 'Anagha')->first();
        $this->assertNotNull($anagha);
        $this->assertEquals('active', $anagha->status);
        $this->assertEquals('TOP', $anagha->activeAllocation->bed->tier);

        // Verify Ground Floor Room 2 (A2)
        $a2 = Room::where('number', 'A2')->first();
        $this->assertNotNull($a2);
        $this->assertEquals(5, $a2->capacity);
        $this->assertEquals(3, $a2->occupied);
        $this->assertEquals(2, $a2->available);

        $emil = Resident::where('mobile', '9207096339')->first();
        $this->assertNotNull($emil);
        $this->assertEquals('EMIL', $emil->full_name);
        $this->assertEquals('active', $emil->status);
        $this->assertEquals('DOWN', $emil->activeAllocation->bed->tier);

        $karthika = Resident::where('mobile', '8590344467')->first();
        $this->assertNotNull($karthika);
        $this->assertEquals('KARTHIKA', $karthika->full_name);
        $this->assertEquals('DOWN', $karthika->activeAllocation->bed->tier);

        $malu = Resident::where('mobile', '7510948187')->first();
        $this->assertNotNull($malu);
        $this->assertEquals('MALU VIJAYAN', $malu->full_name);
        $this->assertEquals('DOWN', $malu->activeAllocation->bed->tier);

        // Verify Ground Floor Room 3 (A3) Transition:
        // Initially 4-share (Sept-Oct), changed to 2-share from Nov 1
        $a3 = Room::where('number', 'A3')->first();
        $this->assertNotNull($a3);
        $this->assertEquals(2, $a3->capacity);
        $this->assertEquals('Two Sharing', $a3->type);
        $this->assertEquals(1, $a3->occupied);
        $this->assertEquals(1, $a3->available);

        // Historical capacity records for Room A3
        $this->assertTrue($a3->capacityHistories()->where('capacity', 4)->whereDate('effective_from', '2026-09-01')->exists());
        $this->assertTrue($a3->capacityHistories()->where('capacity', 2)->whereDate('effective_from', '2026-11-01')->exists());

        // Nandana (Checked out on 2026-11-01)
        $nandana = Resident::where('mobile', '9567166703')->first();
        $this->assertNotNull($nandana);
        $this->assertEquals('NANDANA', $nandana->full_name);
        $this->assertEquals('checked_out', $nandana->status);
        $this->assertTrue($nandana->checkouts()->whereDate('date', '2026-11-01')->exists());

        // Anaswara (Checked out on 2026-11-01)
        $anaswara = Resident::where('mobile', '7994424934')->first();
        $this->assertNotNull($anaswara);
        $this->assertEquals('ANASWARA', $anaswara->full_name);
        $this->assertEquals('checked_out', $anaswara->status);
        $this->assertTrue($anaswara->checkouts()->whereDate('date', '2026-11-01')->exists());

        // Dharmaja (Active in Bed B2)
        $dharmaja = Resident::where('mobile', '6238962671')->first();
        $this->assertNotNull($dharmaja);
        $this->assertEquals('DHARMAJA', $dharmaja->full_name);
        $this->assertEquals('active', $dharmaja->status);
        $this->assertEquals('B2', $dharmaja->activeAllocation->bed->name);
        $this->assertEquals('DOWN', $dharmaja->activeAllocation->bed->tier);
    }

    public function test_dynamic_room_sharing_configuration_via_controller(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);
        $this->seed(SJHostelSeeder::class);

        $a2 = Room::where('number', 'A2')->first();
        // A2 has 3 active residents (Emil, Karthika, Malu) and capacity 5
        $this->assertEquals(5, $a2->capacity);
        $this->assertEquals(3, $a2->occupied);
        $this->assertEquals(2, $a2->available);

        // 1. Changing to 4-sharing should succeed and adjust available beds to 1
        $response = $this->put('/rooms/'.$a2->id, [
            'floor_id' => $a2->floor_id,
            'number' => 'A2',
            'type' => 'Four Sharing',
            'capacity' => 4,
            'effective_date' => '2026-11-05',
            'monthly_rent' => 6500,
            'rent_without_food' => 4200,
            'security_deposit' => 1000,
            'status' => 'active',
            'notes' => 'Reduced from 5-share to 4-share',
        ]);
        $response->assertSessionHasNoErrors();

        $a2->refresh();
        $this->assertEquals(4, $a2->capacity);
        $this->assertEquals(3, $a2->occupied);
        $this->assertEquals(1, $a2->available);
        $this->assertTrue($a2->capacityHistories()->where('capacity', 4)->exists());

        // 2. Changing to 3-sharing should succeed (3 active residents, 0 vacancy)
        $response = $this->put('/rooms/'.$a2->id, [
            'floor_id' => $a2->floor_id,
            'number' => 'A2',
            'type' => 'Three Sharing',
            'capacity' => 3,
            'effective_date' => '2026-11-05',
            'monthly_rent' => 7500,
            'rent_without_food' => 5000,
            'security_deposit' => 1000,
            'status' => 'active',
        ]);
        $response->assertSessionHasNoErrors();
        $a2->refresh();
        $this->assertEquals(3, $a2->capacity);
        $this->assertEquals(3, $a2->occupied);
        $this->assertEquals(0, $a2->available);

        // 3. Attempting to reduce below active occupancy (3) to 2 should fail with validation error
        $response = $this->put('/rooms/'.$a2->id, [
            'floor_id' => $a2->floor_id,
            'number' => 'A2',
            'type' => 'Two Sharing',
            'capacity' => 2,
            'effective_date' => '2026-11-05',
            'monthly_rent' => 8600,
            'rent_without_food' => 6500,
            'security_deposit' => 1000,
            'status' => 'active',
        ]);
        $response->assertSessionHasErrors('capacity');
        $this->assertEquals(3, $a2->fresh()->capacity);

        // 4. Expanding capacity from 3 to 5 should add beds dynamically
        $response = $this->put('/rooms/'.$a2->id, [
            'floor_id' => $a2->floor_id,
            'number' => 'A2',
            'type' => 'Five Sharing',
            'capacity' => 5,
            'effective_date' => '2026-11-05',
            'monthly_rent' => 6500,
            'rent_without_food' => 4200,
            'security_deposit' => 1000,
            'status' => 'active',
        ]);
        $response->assertSessionHasNoErrors();
        $a2->refresh();
        $this->assertEquals(5, $a2->capacity);
        $this->assertEquals(3, $a2->occupied);
        $this->assertEquals(2, $a2->available);
    }
}
