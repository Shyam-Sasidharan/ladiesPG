<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\GalleryImage;
use App\Models\HostelUpdate;
use App\Models\PgSetting;
use App\Models\Testimonial;
use App\Models\WebsiteRoomShowcase;
use Illuminate\Http\Request;

class WebsiteContentController extends Controller
{
    public function index(Request $request)
    {
        $settings = PgSetting::first() ?? new PgSetting(['name' => 'SJ Ladies Hostel']);
        $rooms = WebsiteRoomShowcase::orderBy('sort_order')->latest('id')->get();
        $facilities = Facility::orderBy('sort_order')->latest('id')->get();
        $gallery = GalleryImage::orderBy('sort_order')->latest('id')->get();
        $testimonials = Testimonial::orderBy('sort_order')->latest('id')->get();
        $updates = HostelUpdate::orderBy('sort_order')->latest('id')->get();

        $activeTab = $request->query('tab', 'general');

        return view('website-content.index', compact(
            'settings',
            'rooms',
            'facilities',
            'gallery',
            'testimonials',
            'updates',
            'activeTab'
        ));
    }

    public function updateGeneral(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'tagline' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:30',
            'alternate_phone' => 'nullable|string|max:30',
            'whatsapp_number' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:2000',
            'visiting_hours' => 'nullable|string|max:150',
            'map_embed_url' => 'nullable|string|max:3000',
            'instagram_url' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('website', 'public');
        }
        unset($data['logo']);

        PgSetting::updateOrCreate(['id' => 1], $data);

        return redirect()->route('website.content.index', ['tab' => 'general'])->with('success', 'Branding & contact info updated.');
    }

    public function updateHero(Request $request)
    {
        $data = $request->validate([
            'hero_badge' => 'nullable|string|max:100',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:1000',
            'promo_title' => 'nullable|string|max:150',
            'promo_tagline' => 'nullable|string|max:255',
            'promo_perk_1' => 'nullable|string|max:255',
            'promo_perk_2' => 'nullable|string|max:255',
            'promo_perk_3' => 'nullable|string|max:255',
            'promo_btn_text' => 'nullable|string|max:80',
            'stat_1_val' => 'nullable|string|max:50',
            'stat_1_label' => 'nullable|string|max:100',
            'stat_1_sub' => 'nullable|string|max:100',
            'stat_2_val' => 'nullable|string|max:50',
            'stat_2_label' => 'nullable|string|max:100',
            'stat_2_sub' => 'nullable|string|max:100',
            'stat_3_val' => 'nullable|string|max:50',
            'stat_3_label' => 'nullable|string|max:100',
            'stat_3_sub' => 'nullable|string|max:100',
            'stat_4_val' => 'nullable|string|max:50',
            'stat_4_label' => 'nullable|string|max:100',
            'stat_4_sub' => 'nullable|string|max:100',
        ]);

        PgSetting::updateOrCreate(['id' => 1], $data);

        return redirect()->route('website.content.index', ['tab' => 'hero'])->with('success', 'Hero, promo card & statistics updated.');
    }

    // Showcase Rooms
    public function storeRoom(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'sharing_type' => 'required|string|max:100',
            'room_number' => 'nullable|string|max:50',
            'monthly_rent' => 'required|numeric|min:0',
            'rent_without_food' => 'nullable|numeric|min:0',
            'price_tag' => 'nullable|string|max:50',
            'sleeps_text' => 'nullable|string|max:80',
            'bed_type_text' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:80',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = '/storage/' . $request->file('image_file')->store('website/rooms', 'public');
        }
        unset($data['image_file']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        WebsiteRoomShowcase::create($data);

        return redirect()->route('website.content.index', ['tab' => 'rooms'])->with('success', 'Room card added.');
    }

    public function updateRoom(Request $request, WebsiteRoomShowcase $room)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'sharing_type' => 'required|string|max:100',
            'room_number' => 'nullable|string|max:50',
            'monthly_rent' => 'required|numeric|min:0',
            'rent_without_food' => 'nullable|numeric|min:0',
            'price_tag' => 'nullable|string|max:50',
            'sleeps_text' => 'nullable|string|max:80',
            'bed_type_text' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:80',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = '/storage/' . $request->file('image_file')->store('website/rooms', 'public');
        }
        unset($data['image_file']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $room->update($data);

        return redirect()->route('website.content.index', ['tab' => 'rooms'])->with('success', 'Room card updated.');
    }

    public function destroyRoom(WebsiteRoomShowcase $room)
    {
        $room->delete();

        return redirect()->route('website.content.index', ['tab' => 'rooms'])->with('success', 'Room card removed.');
    }

    // Facilities
    public function storeFacility(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:500',
            'icon' => 'required|string|max:30',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        Facility::create($data);

        return redirect()->route('website.content.index', ['tab' => 'facilities'])->with('success', 'Facility added.');
    }

    public function updateFacility(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:500',
            'icon' => 'required|string|max:30',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $facility->update($data);

        return redirect()->route('website.content.index', ['tab' => 'facilities'])->with('success', 'Facility updated.');
    }

    public function destroyFacility(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('website.content.index', ['tab' => 'facilities'])->with('success', 'Facility removed.');
    }

    // Gallery Images
    public function storeGallery(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
            'is_tall' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = '/storage/' . $request->file('image_file')->store('website/gallery', 'public');
        }
        unset($data['image_file']);

        if (empty($data['image_url'])) {
            return back()->withErrors(['image_url' => 'Please provide an image file or URL.']);
        }

        $data['is_tall'] = $request->boolean('is_tall', false);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        GalleryImage::create($data);

        return redirect()->route('website.content.index', ['tab' => 'gallery'])->with('success', 'Photo added to gallery.');
    }

    public function updateGallery(Request $request, GalleryImage $image)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
            'is_tall' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = '/storage/' . $request->file('image_file')->store('website/gallery', 'public');
        }
        unset($data['image_file']);

        $data['is_tall'] = $request->boolean('is_tall', false);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $image->update(array_filter($data, fn ($v) => ! is_null($v)));

        return redirect()->route('website.content.index', ['tab' => 'gallery'])->with('success', 'Gallery photo updated.');
    }

    public function destroyGallery(GalleryImage $image)
    {
        $image->delete();

        return redirect()->route('website.content.index', ['tab' => 'gallery'])->with('success', 'Photo removed from gallery.');
    }

    // Testimonials
    public function storeTestimonial(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'role' => 'nullable|string|max:150',
            'stay_date' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'headline' => 'nullable|string|max:255',
            'quote' => 'required|string|max:2000',
            'avatar_url' => 'nullable|string|max:2000',
            'avatar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar_file')) {
            $data['avatar_url'] = '/storage/' . $request->file('avatar_file')->store('website/testimonials', 'public');
        }
        unset($data['avatar_file']);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        Testimonial::create($data);

        return redirect()->route('website.content.index', ['tab' => 'testimonials'])->with('success', 'Testimonial added.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'role' => 'nullable|string|max:150',
            'stay_date' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'headline' => 'nullable|string|max:255',
            'quote' => 'required|string|max:2000',
            'avatar_url' => 'nullable|string|max:2000',
            'avatar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar_file')) {
            $data['avatar_url'] = '/storage/' . $request->file('avatar_file')->store('website/testimonials', 'public');
        }
        unset($data['avatar_file']);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $testimonial->update(array_filter($data, fn ($v) => ! is_null($v)));

        return redirect()->route('website.content.index', ['tab' => 'testimonials'])->with('success', 'Testimonial updated.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('website.content.index', ['tab' => 'testimonials'])->with('success', 'Testimonial removed.');
    }

    // Hostel Updates (News / Blog)
    public function storeUpdate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:1000',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'date_text' => 'nullable|string|max:100',
            'views_count' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = '/storage/' . $request->file('image_file')->store('website/updates', 'public');
        }
        unset($data['image_file']);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['views_count'] = (int) ($data['views_count'] ?? rand(120, 280));

        HostelUpdate::create($data);

        return redirect()->route('website.content.index', ['tab' => 'updates'])->with('success', 'Hostel update published.');
    }

    public function updateUpdate(Request $request, HostelUpdate $update)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:1000',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'date_text' => 'nullable|string|max:100',
            'views_count' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = '/storage/' . $request->file('image_file')->store('website/updates', 'public');
        }
        unset($data['image_file']);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $update->update(array_filter($data, fn ($v) => ! is_null($v)));

        return redirect()->route('website.content.index', ['tab' => 'updates'])->with('success', 'Hostel update updated.');
    }

    public function destroyUpdate(HostelUpdate $update)
    {
        $update->delete();

        return redirect()->route('website.content.index', ['tab' => 'updates'])->with('success', 'Hostel update removed.');
    }
}
