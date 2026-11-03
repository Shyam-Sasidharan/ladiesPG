<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\PgSetting;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SJHostelSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Update or create PG Settings
            $setting = PgSetting::first() ?? new PgSetting;
            $setting->fill([
                'name' => 'SJ Ladies Hostel',
                'phone' => '8590621496',
                'email' => 'sjladieshostel07@gmail.com',
                'address' => 'SJ Ladies Hostel, Coordinates: 9.9911476, 76.3189574',
                'notes' => 'A Safe & Comfortable Stay for Women.',
            ])->save();

            // 2. Ensure Floors: Ground Floor & First Floor
            $groundFloor = Floor::firstOrCreate(
                ['name' => 'Ground Floor'],
                ['number' => 0, 'notes' => 'Ground level accommodation']
            );
            $groundFloor->update(['number' => 0]);

            $firstFloor = Floor::firstOrCreate(
                ['name' => 'First Floor'],
                ['number' => 1, 'notes' => 'First floor accommodation']
            );
            $firstFloor->update(['number' => 1]);

            // 3. Room Configurations
            $structure = [
                $groundFloor->id => [
                    [
                        'number' => 'A1',
                        'type' => 'Five Sharing',
                        'capacity' => 5,
                        'monthly_rent' => 6500.00,
                        'rent_without_food' => 4200.00,
                        'security_deposit' => 1000.00,
                        'ac' => false,
                        'attached_bathroom' => true,
                        'food_included' => true,
                        'status' => 'active',
                        'notes' => 'Spacious 5-sharing room with attached bathroom on Ground Floor',
                    ],
                    [
                        'number' => 'A2',
                        'type' => 'Five Sharing',
                        'capacity' => 5,
                        'monthly_rent' => 6500.00,
                        'rent_without_food' => 4200.00,
                        'security_deposit' => 1000.00,
                        'ac' => false,
                        'attached_bathroom' => true,
                        'food_included' => true,
                        'status' => 'active',
                        'notes' => 'Spacious 5-sharing room with attached bathroom on Ground Floor',
                    ],
                    [
                        'number' => 'A3',
                        'type' => 'Two Sharing',
                        'capacity' => 2,
                        'monthly_rent' => 8600.00,
                        'rent_without_food' => 6500.00,
                        'security_deposit' => 1000.00,
                        'ac' => false,
                        'attached_bathroom' => true,
                        'food_included' => true,
                        'status' => 'active',
                        'notes' => 'Comfortable 2-sharing room with attached bathroom on Ground Floor',
                    ],
                ],
                $firstFloor->id => [
                    [
                        'number' => 'B1',
                        'type' => 'Six Sharing',
                        'capacity' => 6,
                        'monthly_rent' => 6500.00,
                        'rent_without_food' => 4200.00,
                        'security_deposit' => 1000.00,
                        'ac' => false,
                        'attached_bathroom' => true,
                        'food_included' => true,
                        'status' => 'active',
                        'notes' => 'Well-ventilated 6-sharing room with attached bathroom on First Floor',
                    ],
                    [
                        'number' => 'B2',
                        'type' => 'Four Sharing',
                        'capacity' => 4,
                        'monthly_rent' => 6500.00,
                        'rent_without_food' => 4200.00,
                        'security_deposit' => 1000.00,
                        'ac' => false,
                        'attached_bathroom' => true,
                        'food_included' => true,
                        'status' => 'active',
                        'notes' => 'Spacious 4-sharing room with attached bathroom on First Floor',
                    ],
                    [
                        'number' => 'B3',
                        'type' => 'Two Sharing',
                        'capacity' => 2,
                        'monthly_rent' => 8600.00,
                        'rent_without_food' => 6500.00,
                        'security_deposit' => 1000.00,
                        'ac' => false,
                        'attached_bathroom' => true,
                        'food_included' => true,
                        'status' => 'active',
                        'notes' => 'Comfortable 2-sharing room with attached bathroom on First Floor',
                    ],
                ],
            ];

            // If old rooms (101, 102, 103) exist, map them seamlessly to preserve any active resident allocations
            $oldRoom101 = Room::where('number', '101')->first();
            if ($oldRoom101) {
                $oldRoom101->update(['number' => 'A1_TEMP']);
            }
            $oldRoom102 = Room::where('number', '102')->first();
            if ($oldRoom102) {
                $oldRoom102->update(['number' => 'A2_TEMP']);
            }
            $oldRoom103 = Room::where('number', '103')->first();
            if ($oldRoom103) {
                $oldRoom103->update(['number' => 'A3_TEMP']);
            }

            foreach ($structure as $floorId => $rooms) {
                foreach ($rooms as $roomData) {
                    // Check if room with target number exists
                    $room = Room::where('number', $roomData['number'])->first();

                    // If not found, check if we had a temporary mapped room
                    if (! $room) {
                        if ($roomData['number'] === 'A1' && $oldRoom101) {
                            $room = $oldRoom101;
                        } elseif ($roomData['number'] === 'A2' && $oldRoom102) {
                            $room = $oldRoom102;
                        } elseif ($roomData['number'] === 'A3' && $oldRoom103) {
                            $room = $oldRoom103;
                        } else {
                            $room = new Room;
                        }
                    }

                    $room->fill(array_merge($roomData, ['floor_id' => $floorId]))->save();

                    // Synchronize beds
                    $existingBeds = $room->beds()->orderBy('position')->get();
                    $targetCapacity = $roomData['capacity'];

                    // Create missing beds
                    for ($i = 1; $i <= $targetCapacity; $i++) {
                        $bedName = 'B'.$i;
                        $bed = $room->beds()->where('name', $bedName)->first();
                        if (! $bed) {
                            $room->beds()->create([
                                'name' => $bedName,
                                'position' => $i,
                                'status' => 'available',
                            ]);
                        } else {
                            $bed->update(['position' => $i]);
                        }
                    }

                    // If there are extra beds with position > capacity that have no active allocations, clean them up
                    if ($existingBeds->count() > $targetCapacity) {
                        foreach ($existingBeds as $bed) {
                            if ($bed->position > $targetCapacity && ! $bed->activeAllocation()->exists()) {
                                $bed->delete();
                            }
                        }
                    }
                }
            }

            // Clean up any remaining temp rooms that weren't reused
            Room::where('number', 'like', '%_TEMP')->delete();
        });
    }
}
