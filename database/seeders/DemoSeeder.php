<?php

namespace Database\Seeders;

use App\Models\Bed;
use App\Models\Floor;
use App\Models\PgSetting;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Services\AllocationService;
use App\Services\BillingService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local', 'testing')) {
            throw new \RuntimeException('Demo data is only available in local/testing environments.');
        }
        if (Floor::exists() || Resident::exists()) {
            $this->command?->warn('Demo skipped: property data already exists.');

            return;
        }
        DB::transaction(function () {
            // Settings
            PgSetting::firstOrCreate([], [
                'name' => 'SJ Ladies Hostel',
                'phone' => '8590621496',
                'email' => 'sjladieshostel07@gmail.com',
                'address' => 'SJ Ladies Hostel, Coordinates: 9.9911476, 76.3189574',
                'notes' => 'A Safe & Comfortable Stay for Women.',
            ]);

            // Floors
            $gf = Floor::create(['name' => 'Ground Floor', 'number' => 0]);
            $ff = Floor::create(['name' => 'First Floor', 'number' => 1]);

            // Ground Floor Rooms
            $gfRooms = [
                ['number' => 'A1', 'type' => 'Five Sharing', 'capacity' => 5, 'monthly_rent' => 6500, 'rent_without_food' => 4200, 'security_deposit' => 1000, 'ac' => false, 'attached_bathroom' => true, 'food_included' => true],
                ['number' => 'A2', 'type' => 'Five Sharing', 'capacity' => 5, 'monthly_rent' => 6500, 'rent_without_food' => 4200, 'security_deposit' => 1000, 'ac' => false, 'attached_bathroom' => true, 'food_included' => true],
                ['number' => 'A3', 'type' => 'Two Sharing', 'capacity' => 2, 'monthly_rent' => 8600, 'rent_without_food' => 6500, 'security_deposit' => 1000, 'ac' => false, 'attached_bathroom' => true, 'food_included' => true],
            ];

            foreach ($gfRooms as $r) {
                $room = $gf->rooms()->create($r);
                for ($b = 1; $b <= $r['capacity']; $b++) {
                    $room->beds()->create(['name' => 'B'.$b, 'position' => $b]);
                }
            }

            // First Floor Rooms
            $ffRooms = [
                ['number' => 'B1', 'type' => 'Six Sharing', 'capacity' => 6, 'monthly_rent' => 6500, 'rent_without_food' => 4200, 'security_deposit' => 1000, 'ac' => false, 'attached_bathroom' => true, 'food_included' => true],
                ['number' => 'B2', 'type' => 'Four Sharing', 'capacity' => 4, 'monthly_rent' => 6500, 'rent_without_food' => 4200, 'security_deposit' => 1000, 'ac' => false, 'attached_bathroom' => true, 'food_included' => true],
                ['number' => 'B3', 'type' => 'Two Sharing', 'capacity' => 2, 'monthly_rent' => 8600, 'rent_without_food' => 6500, 'security_deposit' => 1000, 'ac' => false, 'attached_bathroom' => true, 'food_included' => true],
            ];

            foreach ($ffRooms as $r) {
                $room = $ff->rooms()->create($r);
                for ($b = 1; $b <= $r['capacity']; $b++) {
                    $room->beds()->create(['name' => 'B'.$b, 'position' => $b]);
                }
            }

            $names = ['Ananya Sharma', 'Priya Reddy', 'Sneha Patel', 'Kavya Nair', 'Meera Iyer', 'Aditi Rao', 'Divya Menon', 'Riya Kapoor', 'Pooja Verma', 'Nisha Gupta', 'Swathi Kumar', 'Ishita Shah', 'Sana Khan', 'Lakshmi Das', 'Neha Joshi', 'Tanvi Bhat', 'Anjali Singh'];
            $beds = Bed::orderBy('id')->get();
            foreach ($names as $i => $name) {
                if ($i >= $beds->count()) {
                    break;
                }
                $resident = Resident::create([
                    'full_name' => $name,
                    'mobile' => '90000'.str_pad((string) ($i + 1), 5, '0', STR_PAD_LEFT),
                    'email' => strtolower(str_replace(' ', '.', $name)).'@example.com',
                    'joining_date' => today()->subDays(60 - $i)->toDateString(),
                    'date_of_birth' => today()->subYears(22 + $i % 6)->toDateString(),
                    'occupation' => $i % 3 ? 'Software Engineer' : 'Student',
                    'organization' => $i % 3 ? 'Sample Technology Co.' : 'Sample College',
                    'address' => 'Demo address · Bengaluru',
                    'food_required' => true,
                    'expected_checkout' => $i < 2 ? today()->addDays(4 + $i * 5)->toDateString() : null,
                    'emergency_name' => 'Family contact',
                    'emergency_phone' => '9000099999',
                    'status' => 'active',
                ]);
                app(AllocationService::class)->allocate($resident->id, $beds[$i]->id, [
                    'date' => $resident->joining_date->toDateString(),
                    'initial_payment' => 1000,
                    'method' => 'bank',
                ]);
            }
            app(BillingService::class)->generate(today()->format('Y-m'));
            foreach (RentRecord::all() as $i => $record) {
                if ($i % 3 === 0) {
                    continue;
                }
                app(BillingService::class)->pay([
                    'resident_id' => $record->resident_id,
                    'rent_record_id' => $record->id,
                    'type' => 'rent',
                    'amount' => $record->amount,
                    'method' => $i % 2 ? 'upi' : 'bank',
                    'payment_date' => today()->toDateString(),
                    'reference' => 'DEMO-'.($i + 1),
                ]);
            }
        });
    }
}
