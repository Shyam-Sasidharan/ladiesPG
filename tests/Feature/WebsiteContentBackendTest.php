<?php

namespace Tests\Feature;

use App\Models\Facility;
use App\Models\GalleryImage;
use App\Models\HostelUpdate;
use App\Models\PgSetting;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WebsiteRoomShowcase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteContentBackendTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);
    }

    public function test_guest_is_redirected_from_website_content_cms(): void
    {
        $response = $this->get(route('website.content.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_website_content_portal(): void
    {
        $response = $this->actingAs($this->admin)->get(route('website.content.index'));
        $response->assertStatus(200);
        $response->assertSee('Website Content');
        $response->assertSee('Branding & Contact');
        $response->assertSee('Hero & Stats');
        $response->assertSee('Room Cards');
        $response->assertSee('Facilities');
        $response->assertSee('Gallery Photos');
        $response->assertSee('Testimonials');
        $response->assertSee('Hostel Life / News');
    }

    public function test_admin_can_update_general_branding_and_hero(): void
    {
        $response = $this->actingAs($this->admin)->post(route('website.content.general'), [
            'name' => 'Hosteller SJ PG',
            'tagline' => 'Luxury Student & Working Women Living',
            'phone' => '9876543210',
            'alternate_phone' => '9876543211',
            'whatsapp_number' => '9876543210',
            'email' => 'info@hosteller.test',
            'address' => 'Palarivattom, Kochi',
            'visiting_hours' => '6:00 AM – 10:00 PM',
            'map_embed_url' => 'https://maps.google.com/?q=Kochi',
            'instagram_url' => 'https://instagram.com/hosteller',
        ]);

        $response->assertRedirect(route('website.content.index', ['tab' => 'general']));

        $setting = PgSetting::first();
        $this->assertSame('Hosteller SJ PG', $setting->name);
        $this->assertSame('Luxury Student & Working Women Living', $setting->tagline);
        $this->assertSame('9876543210', $setting->phone);

        $heroResponse = $this->actingAs($this->admin)->post(route('website.content.hero'), [
            'hero_badge' => 'Premium Stays In Kochi',
            'hero_title' => 'Where Modern Living Feels Like Home',
            'hero_subtitle' => 'Safe, elegant spaces built for women.',
            'promo_title' => 'Experience Elevated Hostel Living',
            'promo_tagline' => 'More than just a stay',
            'stat_1_val' => '120+',
            'stat_1_label' => 'Happy Residents',
            'stat_2_val' => '4.9★',
            'stat_2_label' => 'Average Rating',
        ]);

        $heroResponse->assertRedirect(route('website.content.index', ['tab' => 'hero']));

        $setting->refresh();
        $this->assertSame('Premium Stays In Kochi', $setting->hero_badge);
        $this->assertSame('120+', $setting->stat_1_val);
    }

    public function test_admin_can_crud_room_showcase(): void
    {
        // Create
        $response = $this->actingAs($this->admin)->post(route('website.content.rooms.store'), [
            'title' => 'Deluxe 2-Sharing Room',
            'sharing_type' => '2-Sharing',
            'room_number' => 'A1',
            'monthly_rent' => 6500,
            'rent_without_food' => 4200,
            'price_tag' => '₹6,500/mo',
            'sleeps_text' => '2 Residents',
            'bed_type_text' => 'Single Cot / Box Bed',
            'badge' => 'Most Popular',
            'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=800&q=80',
            'sort_order' => 1,
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('website.content.index', ['tab' => 'rooms']));
        $this->assertDatabaseHas('website_room_showcases', [
            'title' => 'Deluxe 2-Sharing Room',
            'monthly_rent' => 6500,
        ]);

        $room = WebsiteRoomShowcase::first();

        // Update
        $updateResponse = $this->actingAs($this->admin)->put(route('website.content.rooms.update', $room), [
            'title' => 'Deluxe 2-Sharing Executive',
            'sharing_type' => '2-Sharing',
            'monthly_rent' => 7000,
            'sort_order' => 1,
            'is_active' => 1,
        ]);
        $updateResponse->assertRedirect(route('website.content.index', ['tab' => 'rooms']));
        $this->assertDatabaseHas('website_room_showcases', [
            'id' => $room->id,
            'title' => 'Deluxe 2-Sharing Executive',
            'monthly_rent' => 7000,
        ]);

        // Delete
        $deleteResponse = $this->actingAs($this->admin)->delete(route('website.content.rooms.destroy', $room));
        $deleteResponse->assertRedirect(route('website.content.index', ['tab' => 'rooms']));
        $this->assertDatabaseMissing('website_room_showcases', ['id' => $room->id]);
    }

    public function test_admin_can_crud_facility(): void
    {
        $response = $this->actingAs($this->admin)->post(route('website.content.facilities.store'), [
            'title' => 'High-Speed Fiber Wi-Fi',
            'description' => 'Unlimited 300 Mbps fiber internet with dual backup lines.',
            'icon' => 'wifi',
            'sort_order' => 1,
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('website.content.index', ['tab' => 'facilities']));
        $this->assertDatabaseHas('facilities', ['title' => 'High-Speed Fiber Wi-Fi']);

        $facility = Facility::first();

        $updateResponse = $this->actingAs($this->admin)->put(route('website.content.facilities.update', $facility), [
            'title' => 'Ultra High-Speed Wi-Fi',
            'description' => '500 Mbps backup lines.',
            'icon' => 'wifi',
            'sort_order' => 2,
            'is_active' => 1,
        ]);
        $updateResponse->assertRedirect(route('website.content.index', ['tab' => 'facilities']));
        $this->assertDatabaseHas('facilities', ['id' => $facility->id, 'title' => 'Ultra High-Speed Wi-Fi']);

        $deleteResponse = $this->actingAs($this->admin)->delete(route('website.content.facilities.destroy', $facility));
        $deleteResponse->assertRedirect(route('website.content.index', ['tab' => 'facilities']));
        $this->assertDatabaseMissing('facilities', ['id' => $facility->id]);
    }

    public function test_admin_can_crud_gallery_testimonial_and_update(): void
    {
        // Gallery
        $galleryRes = $this->actingAs($this->admin)->post(route('website.content.gallery.store'), [
            'title' => 'Lobby Lounge',
            'category' => 'Common Areas',
            'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=800&q=80',
            'is_tall' => 0,
            'sort_order' => 1,
            'is_active' => 1,
        ]);
        $galleryRes->assertRedirect(route('website.content.index', ['tab' => 'gallery']));
        $this->assertDatabaseHas('gallery_images', ['title' => 'Lobby Lounge']);

        $gallery = GalleryImage::first();
        $this->actingAs($this->admin)->delete(route('website.content.gallery.destroy', $gallery))
            ->assertRedirect(route('website.content.index', ['tab' => 'gallery']));
        $this->assertDatabaseMissing('gallery_images', ['id' => $gallery->id]);

        // Testimonial
        $testiRes = $this->actingAs($this->admin)->post(route('website.content.testimonials.store'), [
            'name' => 'Ananya Verma',
            'role' => 'Software Engineer, Infopark',
            'quote' => 'Best ladies hostel in Kochi. Homely food and super safe.',
            'rating' => 5,
            'sort_order' => 1,
            'is_active' => 1,
        ]);
        $testiRes->assertRedirect(route('website.content.index', ['tab' => 'testimonials']));
        $this->assertDatabaseHas('testimonials', ['name' => 'Ananya Verma']);

        $testimonial = Testimonial::first();
        $this->actingAs($this->admin)->delete(route('website.content.testimonials.destroy', $testimonial))
            ->assertRedirect(route('website.content.index', ['tab' => 'testimonials']));
        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);

        // Hostel Life Update
        $updateRes = $this->actingAs($this->admin)->post(route('website.content.updates.store'), [
            'title' => 'Diwali Celebration Night',
            'category' => 'Community',
            'excerpt' => 'Special dinner, lights decoration and fun games.',
            'date_text' => 'Nov 2026',
            'sort_order' => 1,
            'is_active' => 1,
        ]);
        $updateRes->assertRedirect(route('website.content.index', ['tab' => 'updates']));
        $this->assertDatabaseHas('hostel_updates', ['title' => 'Diwali Celebration Night']);

        $hostelUpdate = HostelUpdate::first();
        $this->actingAs($this->admin)->delete(route('website.content.updates.destroy', $hostelUpdate))
            ->assertRedirect(route('website.content.index', ['tab' => 'updates']));
        $this->assertDatabaseMissing('hostel_updates', ['id' => $hostelUpdate->id]);
    }
}
