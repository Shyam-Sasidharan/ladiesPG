<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add extra website fields to pg_settings
        Schema::table('pg_settings', function (Blueprint $t) {
            $t->string('tagline')->nullable()->after('name');
            $t->string('alternate_phone', 30)->nullable()->after('phone');
            $t->string('whatsapp_number', 30)->nullable()->after('alternate_phone');
            $t->string('visiting_hours')->nullable()->after('address');
            $t->text('map_embed_url')->nullable()->after('visiting_hours');
            $t->string('instagram_url')->nullable()->after('map_embed_url');
            $t->string('facebook_url')->nullable()->after('instagram_url');
            $t->string('logo_path')->nullable()->after('facebook_url');

            // Hero section
            $t->string('hero_badge')->nullable();
            $t->string('hero_title')->nullable();
            $t->text('hero_subtitle')->nullable();

            // Navy Promo Card ("Stay Longer, Save More")
            $t->string('promo_title')->nullable();
            $t->text('promo_tagline')->nullable();
            $t->string('promo_perk_1')->nullable();
            $t->string('promo_perk_2')->nullable();
            $t->string('promo_perk_3')->nullable();
            $t->string('promo_btn_text')->nullable();

            // Ratings / Trust strip stats
            $t->string('stat_1_val')->nullable();
            $t->string('stat_1_label')->nullable();
            $t->string('stat_1_sub')->nullable();

            $t->string('stat_2_val')->nullable();
            $t->string('stat_2_label')->nullable();
            $t->string('stat_2_sub')->nullable();

            $t->string('stat_3_val')->nullable();
            $t->string('stat_3_label')->nullable();
            $t->string('stat_3_sub')->nullable();

            $t->string('stat_4_val')->nullable();
            $t->string('stat_4_label')->nullable();
            $t->string('stat_4_sub')->nullable();
        });

        // 2. Featured / Website Rooms Showcase
        Schema::create('website_room_showcases', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('sharing_type')->default('Four Sharing');
            $t->string('room_number')->nullable();
            $t->decimal('monthly_rent', 10, 2)->default(6500.00);
            $t->decimal('rent_without_food', 10, 2)->nullable();
            $t->string('price_tag')->nullable();
            $t->string('sleeps_text')->nullable();
            $t->string('bed_type_text')->nullable();
            $t->string('badge')->nullable();
            $t->string('image_url')->nullable();
            $t->integer('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        // 3. Facilities ("We have everything you need")
        Schema::create('facilities', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->text('description')->nullable();
            $t->string('icon')->default('📶');
            $t->integer('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        // 4. Photos of our rooms / Gallery
        Schema::create('gallery_images', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('category')->nullable();
            $t->string('image_url');
            $t->boolean('is_tall')->default(false);
            $t->integer('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        // 5. Testimonials ("What our guests say")
        Schema::create('testimonials', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('role')->nullable();
            $t->string('stay_date')->nullable();
            $t->unsignedTinyInteger('rating')->default(5);
            $t->string('headline')->nullable();
            $t->text('quote');
            $t->string('avatar_url')->nullable();
            $t->integer('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        // 6. Hostel Life & Updates (News / Blog)
        Schema::create('hostel_updates', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('category')->default('Hostel Life');
            $t->text('excerpt')->nullable();
            $t->string('image_url')->nullable();
            $t->string('date_text')->nullable();
            $t->integer('views_count')->default(150);
            $t->integer('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostel_updates');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('website_room_showcases');

        Schema::table('pg_settings', function (Blueprint $t) {
            $t->dropColumn([
                'tagline', 'alternate_phone', 'whatsapp_number', 'visiting_hours', 'map_embed_url',
                'instagram_url', 'facebook_url', 'logo_path', 'hero_badge', 'hero_title', 'hero_subtitle',
                'promo_title', 'promo_tagline', 'promo_perk_1', 'promo_perk_2', 'promo_perk_3', 'promo_btn_text',
                'stat_1_val', 'stat_1_label', 'stat_1_sub',
                'stat_2_val', 'stat_2_label', 'stat_2_sub',
                'stat_3_val', 'stat_3_label', 'stat_3_sub',
                'stat_4_val', 'stat_4_label', 'stat_4_sub',
            ]);
        });
    }
};
