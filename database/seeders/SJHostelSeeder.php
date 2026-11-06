<?php

namespace Database\Seeders;

use App\Models\ActiveAllocation;
use App\Models\Allocation;
use App\Models\Bed;
use App\Models\Checkout;
use App\Models\Floor;
use App\Models\PgSetting;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\Room;
use App\Models\RoomCapacityHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SJHostelSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Admin user reference
            $admin = User::where('is_admin', true)->first();

            // 1. Update or create PG Settings
            $setting = PgSetting::first() ?? new PgSetting;
            $setting->fill([
                'name' => 'SJ Ladies Hostel',
                'phone' => '8590621496',
                'email' => 'sjladieshostel07@gmail.com',
                'address' => 'SJ Ladies Hostel, Coordinates: 9.9911476, 76.3189574',
                'notes' => 'A Safe & Comfortable Stay for Women in Kochi.',
            ])->save();

            // 2. Floors: Ground Floor & First Floor
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

            // 3. Room Configurations (Initial & Current)
            $roomsData = [
                // Ground Floor
                [
                    'floor_id' => $groundFloor->id,
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
                    'beds' => [
                        ['name' => 'B1', 'position' => 1, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B2', 'position' => 2, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B3', 'position' => 3, 'tier' => 'TOP', 'status' => 'available'],
                        ['name' => 'B4', 'position' => 4, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B5', 'position' => 5, 'tier' => 'TOP', 'status' => 'available'],
                    ],
                    'histories' => [
                        [
                            'capacity' => 5,
                            'sharing_type' => 'Five Sharing',
                            'effective_from' => '2026-09-01',
                            'effective_to' => null,
                            'monthly_rent' => 6500.00,
                            'rent_without_food' => 4200.00,
                            'notes' => 'Ground Floor Room A1 5-sharing configuration',
                        ],
                    ],
                ],
                [
                    'floor_id' => $groundFloor->id,
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
                    'beds' => [
                        ['name' => 'B1', 'position' => 1, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B2', 'position' => 2, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B3', 'position' => 3, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B4', 'position' => 4, 'tier' => 'TOP', 'status' => 'available'],
                        ['name' => 'B5', 'position' => 5, 'tier' => 'TOP', 'status' => 'available'],
                    ],
                    'histories' => [
                        [
                            'capacity' => 5,
                            'sharing_type' => 'Five Sharing',
                            'effective_from' => '2026-09-01',
                            'effective_to' => null,
                            'monthly_rent' => 6500.00,
                            'rent_without_food' => 4200.00,
                            'notes' => 'Ground Floor Room A2 5-sharing configuration',
                        ],
                    ],
                ],
                [
                    'floor_id' => $groundFloor->id,
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
                    'notes' => 'Ground Floor Room 3: Reconfigured from 4-sharing to 2-sharing from November 2026 onwards',
                    'beds' => [
                        ['name' => 'B1', 'position' => 1, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B2', 'position' => 2, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B3', 'position' => 3, 'tier' => 'TOP', 'status' => 'archived'],
                        ['name' => 'B4', 'position' => 4, 'tier' => 'TOP', 'status' => 'archived'],
                    ],
                    'histories' => [
                        [
                            'capacity' => 4,
                            'sharing_type' => 'Four Sharing',
                            'effective_from' => '2026-09-01',
                            'effective_to' => '2026-10-31',
                            'monthly_rent' => 6500.00,
                            'rent_without_food' => 4200.00,
                            'notes' => 'Ground Floor Room 3: Initial 4-sharing configuration (Sep-Oct 2026)',
                        ],
                        [
                            'capacity' => 2,
                            'sharing_type' => 'Two Sharing',
                            'effective_from' => '2026-11-01',
                            'effective_to' => null,
                            'monthly_rent' => 8600.00,
                            'rent_without_food' => 6500.00,
                            'notes' => 'Ground Floor Room 3: Reconfigured to 2-sharing from November 2026 onwards',
                        ],
                    ],
                ],
                // First Floor
                [
                    'floor_id' => $firstFloor->id,
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
                    'beds' => [
                        ['name' => 'B1', 'position' => 1, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B2', 'position' => 2, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B3', 'position' => 3, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B4', 'position' => 4, 'tier' => 'TOP', 'status' => 'available'],
                        ['name' => 'B5', 'position' => 5, 'tier' => 'TOP', 'status' => 'available'],
                        ['name' => 'B6', 'position' => 6, 'tier' => 'TOP', 'status' => 'available'],
                    ],
                    'histories' => [
                        [
                            'capacity' => 6,
                            'sharing_type' => 'Six Sharing',
                            'effective_from' => '2026-09-01',
                            'effective_to' => null,
                            'monthly_rent' => 6500.00,
                            'rent_without_food' => 4200.00,
                            'notes' => 'First Floor Room B1 6-sharing configuration',
                        ],
                    ],
                ],
                [
                    'floor_id' => $firstFloor->id,
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
                    'beds' => [
                        ['name' => 'B1', 'position' => 1, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B2', 'position' => 2, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B3', 'position' => 3, 'tier' => 'TOP', 'status' => 'available'],
                        ['name' => 'B4', 'position' => 4, 'tier' => 'TOP', 'status' => 'available'],
                    ],
                    'histories' => [
                        [
                            'capacity' => 4,
                            'sharing_type' => 'Four Sharing',
                            'effective_from' => '2026-09-01',
                            'effective_to' => null,
                            'monthly_rent' => 6500.00,
                            'rent_without_food' => 4200.00,
                            'notes' => 'First Floor Room B2 4-sharing configuration',
                        ],
                    ],
                ],
                [
                    'floor_id' => $firstFloor->id,
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
                    'beds' => [
                        ['name' => 'B1', 'position' => 1, 'tier' => 'DOWN', 'status' => 'available'],
                        ['name' => 'B2', 'position' => 2, 'tier' => 'TOP', 'status' => 'available'],
                    ],
                    'histories' => [
                        [
                            'capacity' => 2,
                            'sharing_type' => 'Two Sharing',
                            'effective_from' => '2026-09-01',
                            'effective_to' => null,
                            'monthly_rent' => 8600.00,
                            'rent_without_food' => 6500.00,
                            'notes' => 'First Floor Room B3 2-sharing configuration',
                        ],
                    ],
                ],
            ];

            $savedRooms = [];

            foreach ($roomsData as $rData) {
                $bedsData = $rData['beds'];
                $historiesData = $rData['histories'];
                unset($rData['beds'], $rData['histories']);

                $room = Room::where('number', $rData['number'])->first() ?? new Room;
                $room->fill($rData)->save();
                $savedRooms[$room->number] = $room;

                // Sync capacity histories
                foreach ($historiesData as $hData) {
                    RoomCapacityHistory::updateOrCreate(
                        [
                            'room_id' => $room->id,
                            'effective_from' => $hData['effective_from'],
                        ],
                        array_merge($hData, [
                            'room_id' => $room->id,
                            'created_by' => $admin?->id,
                        ])
                    );
                }

                // Sync beds
                foreach ($bedsData as $bData) {
                    $bed = Bed::where('room_id', $room->id)->where('name', $bData['name'])->first();
                    if (! $bed) {
                        $bed = Bed::create([
                            'room_id' => $room->id,
                            'name' => $bData['name'],
                            'position' => $bData['position'],
                            'tier' => $bData['tier'],
                            'status' => $bData['status'],
                        ]);
                    } else {
                        $bed->update([
                            'position' => $bData['position'],
                            'tier' => $bData['tier'],
                            'status' => $bData['status'],
                        ]);
                    }
                }
            }

            // 4. Resident Details from Excel Sheet
            $residentsData = [
                // Room A1
                [
                    'full_name' => 'Alphy',
                    'mobile' => '9539633470',
                    'joining_date' => '2026-09-06',
                    'expected_checkout' => '2027-03-06',
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A1',
                    'bed_name' => 'B1',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-09-06',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'savitha kevin',
                    'mobile' => '7593865024',
                    'joining_date' => '2026-09-06',
                    'expected_checkout' => '2027-03-06',
                    'status' => 'active',
                    'food_required' => false,
                    'monthly_rent' => 4200.00,
                    'room_number' => 'A1',
                    'bed_name' => 'B2',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-09-06',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'Anakha',
                    'mobile' => '7306332706',
                    'joining_date' => '2026-09-06',
                    'expected_checkout' => '2026-09-27',
                    'status' => 'checked_out',
                    'food_required' => true,
                    'room_number' => 'A1',
                    'bed_name' => 'B3',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-09-06',
                    'check_out' => '2026-09-27',
                    'checkout_reason' => 'Vacated bed on 27/09/2026 as per notice',
                ],
                [
                    'full_name' => 'Neha mathew',
                    'mobile' => '8606734614',
                    'joining_date' => '2026-09-07',
                    'expected_checkout' => '2026-11-11',
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A1',
                    'bed_name' => 'B4',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-09-07',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'Anagha',
                    'mobile' => '9846055555',
                    'joining_date' => '2026-10-06',
                    'expected_checkout' => '2026-11-11',
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A1',
                    'bed_name' => 'B5',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-10-06',
                    'check_out' => null,
                ],

                // Room A2
                [
                    'full_name' => 'EMIL',
                    'mobile' => '9207096339',
                    'joining_date' => '2026-10-14',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A2',
                    'bed_name' => 'B1',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-10-14',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'KARTHIKA',
                    'mobile' => '8590344467',
                    'joining_date' => '2026-10-14',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A2',
                    'bed_name' => 'B2',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-10-14',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'MALU VIJAYAN',
                    'mobile' => '7510948187',
                    'joining_date' => '2026-09-17',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A2',
                    'bed_name' => 'B3',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-09-17',
                    'check_out' => null,
                ],

                // Room A3 (Historical 4-Share residents who vacated on Nov 1 + Active resident)
                [
                    'full_name' => 'NANDANA',
                    'mobile' => '9567166703',
                    'joining_date' => '2026-09-13',
                    'expected_checkout' => '2026-11-01',
                    'status' => 'checked_out',
                    'food_required' => true,
                    'room_number' => 'A3',
                    'bed_name' => 'B1',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-09-13',
                    'check_out' => '2026-11-01',
                    'checkout_reason' => 'Vacated on 01/11/2026 during room reconfiguration',
                ],
                [
                    'full_name' => 'DHARMAJA',
                    'mobile' => '6238962671',
                    'joining_date' => '2026-10-06',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'A3',
                    'bed_name' => 'B2',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-10-06',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'ANASWARA',
                    'mobile' => '7994424934',
                    'joining_date' => '2026-10-09',
                    'expected_checkout' => '2026-11-01',
                    'status' => 'checked_out',
                    'food_required' => true,
                    'room_number' => 'A3',
                    'bed_name' => 'B3',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-10-09',
                    'check_out' => '2026-11-01',
                    'checkout_reason' => 'Vacated on 01/11/2026 during room reconfiguration',
                ],

                // First Floor - Room B1 (1 ST FLOOR 6SHARE)
                [
                    'full_name' => 'AMRITHA ARUN KUMAR',
                    'mobile' => '9207124537',
                    'joining_date' => '2026-10-10',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B1',
                    'bed_name' => 'B4',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-10-10',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'GRACE',
                    'mobile' => '8281138051',
                    'joining_date' => '2026-10-31',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B1',
                    'bed_name' => 'B5',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-10-31',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'AKSA SEBASTIAN',
                    'mobile' => null,
                    'joining_date' => '2026-10-31',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B1',
                    'bed_name' => 'B6',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-10-31',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'ALPHINA',
                    'mobile' => null,
                    'joining_date' => '2026-10-31',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B1',
                    'bed_name' => 'B1',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-10-31',
                    'check_out' => null,
                ],

                // First Floor - Room B2 (1ST FLOOR 4 SHARE)
                [
                    'full_name' => 'VINITHA',
                    'mobile' => '9207472123',
                    'joining_date' => '2026-11-02',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B2',
                    'bed_name' => 'B1',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-11-02',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'ALEENA',
                    'mobile' => '9961241964',
                    'joining_date' => '2026-11-02',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B2',
                    'bed_name' => 'B2',
                    'bed_tier' => 'DOWN',
                    'check_in' => '2026-11-02',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'RAKSHA',
                    'mobile' => null,
                    'joining_date' => '2026-11-02',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B2',
                    'bed_name' => 'B3',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-11-02',
                    'check_out' => null,
                ],
                [
                    'full_name' => 'SANA',
                    'mobile' => null,
                    'joining_date' => '2026-11-02',
                    'expected_checkout' => null,
                    'status' => 'active',
                    'food_required' => true,
                    'room_number' => 'B2',
                    'bed_name' => 'B4',
                    'bed_tier' => 'TOP',
                    'check_in' => '2026-11-02',
                    'check_out' => null,
                ],
            ];

            // Clear existing active allocations for these specific residents first to prevent unique constraint collisions during bed realignment
            $allResidentMobiles = array_filter(array_column($residentsData, 'mobile'));
            $allResidentNames = array_column($residentsData, 'full_name');
            $existingResIds = Resident::whereIn('full_name', $allResidentNames)
                ->when(! empty($allResidentMobiles), fn ($q) => $q->orWhereIn('mobile', $allResidentMobiles))
                ->pluck('id');

            ActiveAllocation::whereIn('resident_id', $existingResIds)->delete();

            foreach ($residentsData as $resItem) {
                // Find or create resident
                $resident = Resident::where('full_name', $resItem['full_name'])
                    ->when(! empty($resItem['mobile']), fn ($q) => $q->orWhere('mobile', $resItem['mobile']))
                    ->first();

                if (! $resident) {
                    $resident = new Resident;
                }

                $room = $savedRooms[$resItem['room_number']];
                $residentRent = $resItem['monthly_rent'] ?? ($resItem['food_required'] ? $room->monthly_rent : ($room->rent_without_food ?? $room->monthly_rent));

                $resident->fill([
                    'full_name' => $resItem['full_name'],
                    'mobile' => $resItem['mobile'],
                    'joining_date' => $resItem['joining_date'],
                    'expected_checkout' => $resItem['expected_checkout'],
                    'status' => $resItem['status'],
                    'food_required' => $resItem['food_required'],
                    'monthly_rent' => $residentRent,
                    'security_deposit' => 1000.00,
                    'created_by' => $admin?->id,
                ])->save();

                $bed = Bed::where('room_id', $room->id)->where('name', $resItem['bed_name'])->first();

                if ($bed) {
                    $bed->update(['tier' => $resItem['bed_tier']]);

                    // Check allocation
                    $allocation = Allocation::where('resident_id', $resident->id)
                        ->where('bed_id', $bed->id)
                        ->first();

                    if (! $allocation) {
                        $allocation = Allocation::create([
                            'resident_id' => $resident->id,
                            'bed_id' => $bed->id,
                            'check_in' => $resItem['check_in'],
                            'check_out' => $resItem['check_out'],
                            'rent' => $residentRent,
                            'deposit' => $room->security_deposit,
                            'notes' => 'Allocated from resident Excel sheet',
                            'created_by' => $admin?->id,
                        ]);
                    } else {
                        $allocation->update([
                            'check_in' => $resItem['check_in'],
                            'check_out' => $resItem['check_out'],
                            'rent' => $residentRent,
                        ]);
                    }

                    // Keep any existing open rent records synchronized with current monthly rent
                    RentRecord::where('resident_id', $resident->id)
                        ->whereDoesntHave('payments')
                        ->update(['amount' => $residentRent]);

                    if ($resItem['status'] === 'active') {
                        // Ensure active allocation
                        ActiveAllocation::updateOrCreate(
                            ['resident_id' => $resident->id],
                            [
                                'bed_id' => $bed->id,
                                'allocation_id' => $allocation->id,
                            ]
                        );
                    } else {
                        // Checked out: remove active allocation if present
                        ActiveAllocation::where('resident_id', $resident->id)->delete();

                        // Ensure checkout record exists
                        Checkout::firstOrCreate(
                            ['allocation_id' => $allocation->id],
                            [
                                'resident_id' => $resident->id,
                                'date' => $resItem['check_out'] ?? $resItem['expected_checkout'],
                                'reason' => $resItem['checkout_reason'] ?? 'Stay completed',
                                'pending_rent' => 0.00,
                                'deductions' => 0.00,
                                'refund' => 1000.00,
                                'notes' => 'Checked out with full records preserved',
                                'created_by' => $admin?->id,
                            ]
                        );
                    }
                }
            }
        });
    }
}
