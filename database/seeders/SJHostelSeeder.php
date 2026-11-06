<?php

namespace Database\Seeders;

use App\Models\ActiveAllocation;
use App\Models\Allocation;
use App\Models\Bed;
use App\Models\Checkout;
use App\Models\Facility;
use App\Models\Floor;
use App\Models\GalleryImage;
use App\Models\HostelUpdate;
use App\Models\PgSetting;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\Room;
use App\Models\RoomCapacityHistory;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WebsiteRoomShowcase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SJHostelSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Admin user reference
            $admin = User::where('is_admin', true)->first();

            // 1. Update or create PG Settings & Website CMS Branding
            $setting = PgSetting::first() ?? new PgSetting;
            $setting->fill([
                'name' => 'SJ Ladies Hostel',
                'tagline' => 'Safe & Homely Stay · Kochi',
                'phone' => '8590621496',
                'alternate_phone' => '9207096339',
                'whatsapp_number' => '8590621496',
                'email' => 'sjladieshostel07@gmail.com',
                'address' => 'SJ Ladies Hostel, Near Metro / IT Hub, Kochi, Kerala',
                'visiting_hours' => 'Everyday 6:00 AM – 9:30 PM',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125745.74838687728!2d76.22329841838634!3d9.98234281358327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d514abec6bf%3A0xbd582caa5844192!2sKochi%2C%20Kerala!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
                'notes' => 'A Safe & Comfortable Stay for Women in Kochi.',
                'hero_badge' => '✦ Welcome to Your New Home',
                'hero_title' => 'Experience Safe, Clean & Homely Living',
                'hero_subtitle' => 'Exclusively designed for female students and working professionals in Kochi. Attached bathrooms in all rooms, 3 fresh daily meals, and 24/7 security.',
                'promo_title' => 'Stay Longer, Save More',
                'promo_tagline' => 'It\'s simple: transparent pricing with zero hidden charges and total peace of mind!',
                'promo_perk_1' => 'Healthy 3 Daily Home-Cooked Meals with South & North Indian varieties.',
                'promo_perk_2' => 'Flexible Plans from ₹4,200/mo (Without Food) to ₹6,500/mo (With Food).',
                'promo_perk_3' => 'Attached Bathrooms in 100% of rooms with 24/7 hot & cold water.',
                'promo_btn_text' => 'Choose room',
                'stat_1_val' => '4.9 /5',
                'stat_1_sub' => '240+ verified ratings',
                'stat_1_label' => 'Google Reviews',
                'stat_2_val' => '100% Safe',
                'stat_2_sub' => 'Biometric & CCTV',
                'stat_2_label' => '24/7 Protection',
                'stat_3_val' => '3 Meals',
                'stat_3_sub' => 'Fresh & Homely daily',
                'stat_3_label' => 'Hygienic Kitchen',
                'stat_4_val' => '98% Rate',
                'stat_4_sub' => 'Resident satisfaction',
                'stat_4_label' => 'Recommended',
            ])->save();

            // 1b. Website Room Showcases
            if (WebsiteRoomShowcase::count() === 0) {
                WebsiteRoomShowcase::create([
                    'title' => 'Bed in Sharing Room (Room A1, B1) with Attached Bathroom',
                    'sharing_type' => 'Six Sharing',
                    'room_number' => 'A1, B1',
                    'monthly_rent' => 6500.00,
                    'rent_without_food' => 4200.00,
                    'price_tag' => '₹4,200',
                    'sleeps_text' => 'Rooms A1 & B1',
                    'bed_type_text' => '₹4,200 / ₹6,500 with food',
                    'badge' => 'Most Popular',
                    'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=700&q=80',
                    'sort_order' => 1,
                    'is_active' => true,
                ]);

                WebsiteRoomShowcase::create([
                    'title' => 'Double Room (Room A3, B3) with Attached Bathroom',
                    'sharing_type' => 'Two Sharing',
                    'room_number' => 'A3, B3',
                    'monthly_rent' => 8600.00,
                    'rent_without_food' => 6500.00,
                    'price_tag' => '₹8,600',
                    'sleeps_text' => '2 Sleeps',
                    'bed_type_text' => '₹6,500 / ₹8,600 with food',
                    'badge' => 'Premium',
                    'image_url' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=700&q=80',
                    'sort_order' => 2,
                    'is_active' => true,
                ]);
            }

            // 1c. Facilities
            if (Facility::count() === 0) {
                $facilityList = [
                    ['icon' => '📶', 'title' => 'Free high speed WiFi', 'description' => 'High-speed fiber internet for uninterrupted work & online studies.', 'sort_order' => 1],
                    ['icon' => '📍', 'title' => 'Convenient location in center', 'description' => 'Quick access to bus stands, metro, InfoPark & educational institutes.', 'sort_order' => 2],
                    ['icon' => '🧳', 'title' => 'Free storage of luggage', 'description' => 'Spacious lockable wardrobes and dedicated safe luggage space.', 'sort_order' => 3],
                    ['icon' => '🅿️', 'title' => 'Parking place allocated', 'description' => 'Dedicated secure two-wheeler and vehicle parking on the premises.', 'sort_order' => 4],
                ];
                foreach ($facilityList as $fac) {
                    Facility::create($fac);
                }
            }

            // 1d. Gallery Photos
            if (GalleryImage::count() === 0) {
                $galleryList = [
                    ['title' => 'Secure Building Exterior & Entrance', 'category' => 'Building', 'image_url' => '/images/building.jpg', 'is_tall' => true, 'sort_order' => 1],
                    ['title' => 'Cozy Bedroom with Attached Bath', 'category' => 'Bedroom', 'image_url' => '/images/hall.jpg', 'is_tall' => false, 'sort_order' => 2],
                    ['title' => 'Comfortable Interior & Wardrobes', 'category' => 'Living', 'image_url' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=700&q=80', 'is_tall' => false, 'sort_order' => 3],
                    ['title' => 'Hygienic Dining & Kitchen Area', 'category' => 'Dining', 'image_url' => '/images/kitchen.jpg', 'is_tall' => false, 'sort_order' => 4],
                    ['title' => 'Naturally Ventilated Bedrooms', 'category' => 'Bedroom', 'image_url' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=700&q=80', 'is_tall' => false, 'sort_order' => 5],
                ];
                foreach ($galleryList as $gal) {
                    GalleryImage::create($gal);
                }
            }

            // 1e. Testimonials
            if (Testimonial::count() === 0) {
                $testimonialList = [
                    [
                        'name' => 'Lisa Adams',
                        'role' => 'Software Engineer, Kakkanad',
                        'stay_date' => 'Date of stay: October 2026',
                        'rating' => 5,
                        'headline' => 'Very cozy room close to everything, feels just like home!',
                        'quote' => 'SJ Ladies Hostel is truly a home away from home. The food is hygienic and delicious, attached bathrooms in every room make morning routines effortless, and the warden takes care of everyone like family. Highly recommended for any woman in Kochi!',
                        'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Betty Randal',
                        'role' => 'Postgraduate Student, Rajagiri',
                        'stay_date' => 'Date of stay: September 2026',
                        'rating' => 5,
                        'headline' => 'Extremely safe with wonderful food and calm study environment',
                        'quote' => 'Being a student, having a quiet atmosphere and high-speed Wi-Fi was essential. The roommates are friendly, the security is strict, and the homely food saves so much time every day. 10/10 stay!',
                        'avatar_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=700&q=80',
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'Dr. Gopika Krishnan',
                        'role' => 'Healthcare Professional',
                        'stay_date' => 'Date of stay: August 2026',
                        'rating' => 5,
                        'headline' => 'Clean attached bathrooms, 24/7 hot water, and flexible rules',
                        'quote' => 'Hospital shift duties can be demanding, but SJ Ladies Hostel has been the most comfortable accommodation I have found in Kochi. Clean rooms, supportive staff, and peaceful nights.',
                        'avatar_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=700&q=80',
                        'sort_order' => 3,
                    ],
                ];
                foreach ($testimonialList as $tst) {
                    Testimonial::create($tst);
                }
            }

            // 1f. Hostel Updates
            if (HostelUpdate::count() === 0) {
                $updateList = [
                    [
                        'title' => 'Fresh Kerala meals prepared with pure hygiene every single day',
                        'category' => 'Food & Health',
                        'excerpt' => 'Enjoy wholesome breakfast, packed lunch for work/college, hot evening tea with snacks, and light delicious dinner.',
                        'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80',
                        'date_text' => 'November 2026',
                        'views_count' => 180,
                        'sort_order' => 1,
                    ],
                    [
                        'title' => 'A quiet, focused study and work atmosphere for women',
                        'category' => 'Community',
                        'excerpt' => 'Designed for exam preparation, remote IT work, and peaceful relaxation without noisy interruptions.',
                        'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=700&q=80',
                        'date_text' => 'November 2026',
                        'views_count' => 240,
                        'sort_order' => 2,
                    ],
                    [
                        'title' => '24/7 CCTV surveillance and verified biometric safety',
                        'category' => 'Security',
                        'excerpt' => 'Continuous safety monitoring, power backup, caring residential warden, and strict visitor verification.',
                        'image_url' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=700&q=80',
                        'date_text' => 'November 2026',
                        'views_count' => 310,
                        'sort_order' => 3,
                    ],
                ];
                foreach ($updateList as $upd) {
                    HostelUpdate::create($upd);
                }
            }

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
