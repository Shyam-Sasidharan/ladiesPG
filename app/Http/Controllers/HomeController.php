<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\PgNotification;
use App\Models\PgSetting;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $settings = null;
        try {
            if (Schema::hasTable('pg_settings')) {
                $settings = PgSetting::first();
            }
        } catch (\Throwable) {
        }

        $settings ??= new PgSetting([
            'name' => 'SJ Ladies Hostel',
            'phone' => '8590621496',
            'email' => 'sjladieshostel07@gmail.com',
            'address' => 'SJ Ladies Hostel, Ernakulam / Kochi, Kerala',
            'notes' => 'Safe, comfortable, and premium living exclusively for women and students.',
        ]);

        $floors = collect();
        try {
            if (Schema::hasTable('floors')) {
                $floors = Floor::with(['rooms' => function ($q) {
                    $q->whereNull('deleted_at')->orderBy('number');
                }, 'rooms.beds.activeAllocation'])->orderBy('number')->get();
            }
        } catch (\Throwable) {
        }

        $groundFloor = $floors->first(fn ($f) => $f->number === 0 || strtolower($f->name) === 'ground floor') ?? $floors->first();
        $firstFloor = $floors->first(fn ($f) => $f->number === 1 || strtolower($f->name) === 'first floor') ?? $floors->skip(1)->first();

        // Calculate statistics
        $allRooms = collect();
        try {
            if (Schema::hasTable('rooms')) {
                $allRooms = Room::with('beds.activeAllocation')->whereNull('deleted_at')->get();
            }
        } catch (\Throwable) {
        }

        $totalBeds = $allRooms->sum('capacity') ?: 24;
        $availableBeds = $allRooms->sum('available') ?: 23;
        $occupiedBeds = $allRooms->sum('occupied') ?: 1;

        $pricingTiers = [
            [
                'sharing' => 'Six Sharing',
                'capacity' => 6,
                'with_food' => 6500,
                'without_food' => 4200,
                'badge' => 'Budget Friendly',
                'description' => 'Ideal for college students and entry-level professionals.',
                'features' => ['Comfortable single cot & mattress', 'Individual lockable wardrobe', 'Daily housekeeping', 'Study space with power sockets', 'High-speed Wi-Fi included'],
            ],
            [
                'sharing' => 'Five Sharing',
                'capacity' => 5,
                'with_food' => 6500,
                'without_food' => 4200,
                'badge' => 'Most Popular',
                'description' => 'Spacious room layout with ample natural light and ventilation.',
                'features' => ['Spacious individual wardrobes', 'Attached bathroom with hot water', '3 healthy homely meals daily', 'High-speed Wi-Fi', '24/7 CCTV & Security guard'],
            ],
            [
                'sharing' => 'Four Sharing',
                'capacity' => 4,
                'with_food' => 6500,
                'without_food' => 4200,
                'badge' => 'Great Value',
                'description' => 'Balanced comfort and privacy in a peaceful environment.',
                'features' => ['Large attached modern bathroom', 'Personal storage locker with key', 'Homely food with weekend specials', 'Regular linen change & cleaning', 'RO purified drinking water'],
            ],
            [
                'sharing' => 'Two Sharing',
                'capacity' => 2,
                'with_food' => 8600,
                'without_food' => 6500,
                'badge' => 'Premium & Quiet',
                'description' => 'Maximum privacy and calm atmosphere for focused working women.',
                'features' => ['Extra spacious room & storage', 'Dedicated study / work desks', 'Attached luxury bathroom', 'South & North Indian meals', 'Priority maintenance & power backup'],
            ],
        ];

        return view('welcome', compact('settings', 'floors', 'groundFloor', 'firstFloor', 'totalBeds', 'availableBeds', 'occupiedBeds', 'pricingTiers'));
    }

    public function enquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'room_number' => 'nullable|string|max:30',
            'sharing_type' => 'nullable|string|max:50',
            'food_preference' => 'nullable|string|in:with_food,without_food',
            'joining_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $foodText = ($validated['food_preference'] ?? 'with_food') === 'without_food' ? 'Without Food' : 'With Food';
        $roomText = ! empty($validated['room_number']) ? 'Room '.$validated['room_number'] : 'Any Available Room';
        $sharingText = $validated['sharing_type'] ?? 'Flexible';

        try {
            if (Schema::hasTable('notifications')) {
                PgNotification::create([
                    'key' => 'enquiry_'.uniqid(),
                    'type' => 'booking_enquiry',
                    'title' => "New Booking Enquiry: {$validated['name']} ({$roomText})",
                    'message' => "Resident: {$validated['name']} | Phone: {$validated['phone']} | Preference: {$roomText} ({$sharingText}) | Meal Plan: {$foodText} | Joining: ".($validated['joining_date'] ?? 'Immediate').' | Notes: '.($validated['notes'] ?? 'None'),
                    'url' => route('rooms.index'),
                ]);
            }
        } catch (\Throwable) {
        }

        $phoneClean = preg_replace('/[^0-9]/', '', PgSetting::first()?->phone ?? '8590621496');
        if (strlen($phoneClean) === 10) {
            $phoneClean = '91'.$phoneClean;
        }
        $whatsappMsg = rawurlencode("Hello SJ Ladies Hostel, I would like to book/enquire about {$roomText} ({$sharingText}, {$foodText}). My name is {$validated['name']} (Phone: {$validated['phone']}).");
        $whatsappUrl = "https://wa.me/{$phoneClean}?text={$whatsappMsg}";

        return back()
            ->with('success', 'Thank you! Your booking enquiry has been received. Our warden / administration will call you shortly.')
            ->with('whatsapp_url', $whatsappUrl);
    }
}
