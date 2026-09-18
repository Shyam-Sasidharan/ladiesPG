<?php

namespace Database\Seeders;

use App\Models\Bed;
use App\Models\Floor;
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
            foreach (['Ground Floor', 'First Floor', 'Second Floor'] as $n => $name) {
                $floor = Floor::create(['name' => $name, 'number' => $n]);
                foreach ([4, 4, 2] as $j => $capacity) {
                    $room = $floor->rooms()->create(['number' => (string) (($n + 1) * 100 + $j + 1), 'type' => 'Sharing', 'capacity' => $capacity, 'monthly_rent' => 5000 + $n * 500, 'security_deposit' => 10000, 'ac' => $n === 2, 'attached_bathroom' => true, 'food_included' => true]);
                    for ($b = 1; $b <= $capacity; $b++) {
                        $room->beds()->create(['name' => 'B'.$b, 'position' => $b]);
                    }
                }
            }
            $names = ['Ananya Sharma', 'Priya Reddy', 'Sneha Patel', 'Kavya Nair', 'Meera Iyer', 'Aditi Rao', 'Divya Menon', 'Riya Kapoor', 'Pooja Verma', 'Nisha Gupta', 'Swathi Kumar', 'Ishita Shah', 'Sana Khan', 'Lakshmi Das', 'Neha Joshi', 'Tanvi Bhat', 'Anjali Singh', 'Shruti Jain', 'Deepa Rao', 'Rashmi Shetty', 'Maya Thomas', 'Sowmya Reddy'];
            $beds = Bed::orderBy('id')->get();
            foreach ($names as $i => $name) {
                $resident = Resident::create(['full_name' => $name, 'mobile' => '90000'.str_pad((string) ($i + 1), 5, '0', STR_PAD_LEFT), 'email' => strtolower(str_replace(' ', '.', $name)).'@example.com', 'joining_date' => today()->subDays(60 - $i)->toDateString(), 'date_of_birth' => today()->subYears(22 + $i % 6)->toDateString(), 'occupation' => $i % 3 ? 'Software Engineer' : 'Student', 'organization' => $i % 3 ? 'Sample Technology Co.' : 'Sample College', 'address' => 'Demo address · Bengaluru', 'food_required' => true, 'expected_checkout' => $i < 3 ? today()->addDays(4 + $i * 5)->toDateString() : null, 'emergency_name' => 'Family contact', 'emergency_phone' => '9000099999', 'status' => 'active']);
                app(AllocationService::class)->allocate($resident->id, $beds[$i]->id, ['date' => $resident->joining_date->toDateString(), 'initial_payment' => 10000, 'method' => 'bank']);
            }
            app(BillingService::class)->generate(today()->format('Y-m'));
            foreach (RentRecord::all() as $i => $record) {
                if ($i % 4 === 0) {
                    continue;
                } app(BillingService::class)->pay(['resident_id' => $record->resident_id, 'rent_record_id' => $record->id, 'type' => 'rent', 'amount' => $i % 5 === 0 ? 2000 : $record->amount, 'method' => $i % 2 ? 'upi' : 'bank', 'payment_date' => today()->toDateString(), 'reference' => 'DEMO-'.($i + 1)]);
            }
            $beds[26]->update(['status' => 'maintenance']);
            $beds[27]->update(['status' => 'maintenance']);
        });
    }
}
