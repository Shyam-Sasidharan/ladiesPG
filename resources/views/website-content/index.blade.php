@extends('layouts.app')
@section('title', 'Website Content')
@section('content')

<div class="page-heading">
    <div>
        <span class="eyebrow">ONLINE PRESENCE & CMS</span>
        <h1>Website Content<span class="accent">.</span></h1>
        <p>Manage all public website content: rooms, photos, amenities, reviews, news, and contacts.</p>
    </div>
    <div class="actions">
        <a href="{{ route('home') }}" target="_blank" class="btn primary">View Live Website ↗</a>
    </div>
</div>

<!-- TABS NAVIGATION -->
<div class="filters" style="margin-bottom:20px;display:flex;gap:8px;flex-wrap:wrap;border-bottom:1px solid var(--border);padding-bottom:12px;">
    @php
        $tabs = [
            'general' => '🏢 Branding & Contact',
            'hero' => '✦ Hero & Stats',
            'rooms' => '🛏️ Room Cards (' . $rooms->count() . ')',
            'facilities' => '📶 Facilities (' . $facilities->count() . ')',
            'gallery' => '📷 Gallery Photos (' . $gallery->count() . ')',
            'testimonials' => '💬 Testimonials (' . $testimonials->count() . ')',
            'updates' => '📰 Hostel Life / News (' . $updates->count() . ')',
        ];
    @endphp

    @foreach($tabs as $tabKey => $tabLabel)
        <a href="{{ route('website.content.index', ['tab' => $tabKey]) }}"
           class="btn small {{ $activeTab === $tabKey ? 'primary' : '' }}"
           style="{{ $activeTab === $tabKey ? 'font-weight:700;' : 'background:#fff;border-color:var(--border);' }}">
           {{ $tabLabel }}
        </a>
    @endforeach
</div>

@if($activeTab === 'general')
<!-- 1. BRANDING & CONTACT INFO -->
<form class="panel" action="{{ route('website.content.general') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="panel-heading">
        <div>
            <h2>Hostel Branding & Contact Information</h2>
            <p>These details power the header, contact cards, map embed, and footer across the public site.</p>
        </div>
    </div>
    <div class="padded">
        <div class="form-grid">
            <x-field name="name" label="Hostel Name *" :value="$settings->name" required/>
            <x-field name="tagline" label="Tagline / Subtitle" :value="$settings->tagline ?? 'Safe & Homely Stay · Kochi'"/>
            <x-field name="phone" label="Primary Phone Number" :value="$settings->phone ?? '8590621496'"/>
            <x-field name="alternate_phone" label="Alternate Phone Number" :value="$settings->alternate_phone ?? '9207096339'"/>
            <x-field name="whatsapp_number" label="WhatsApp Number (with country code)" :value="$settings->whatsapp_number ?? '8590621496'"/>
            <x-field name="email" label="Contact Email" type="email" :value="$settings->email ?? 'sjladieshostel07@gmail.com'"/>
            <x-field name="visiting_hours" label="Visiting Hours" :value="$settings->visiting_hours ?? 'Everyday 6:00 AM – 9:30 PM'"/>
            <x-field name="instagram_url" label="Instagram Profile URL" :value="$settings->instagram_url"/>
            <x-field name="facebook_url" label="Facebook Profile URL" :value="$settings->facebook_url"/>
            <x-field name="logo" label="Custom Logo Image (Optional)" type="file" accept="image/jpeg,image/png,image/webp"/>
        </div>

        <label class="field" style="margin-top:16px;">
            <span>Full Address</span>
            <textarea name="address" rows="3">{{ old('address', $settings->address ?? 'SJ Ladies Hostel, Ernakulam / Kochi, Kerala') }}</textarea>
        </label>

        <label class="field" style="margin-top:16px;">
            <span>Google Maps Embed URL / iframe src</span>
            <textarea name="map_embed_url" rows="3" placeholder="https://www.google.com/maps/embed?...">{{ old('map_embed_url', $settings->map_embed_url) }}</textarea>
            <small class="muted">Paste the `src` attribute from Google Maps 'Share > Embed a map'.</small>
        </label>

        <div style="margin-top:20px;">
            <button class="btn primary">Save Branding & Contact</button>
        </div>
    </div>
</form>

@elseif($activeTab === 'hero')
<!-- 2. HERO, PROMO CARD & STATS -->
<form class="panel" action="{{ route('website.content.hero') }}" method="post">
    @csrf
    <div class="panel-heading">
        <div>
            <h2>Hero Headline, Promo Banner & Stats</h2>
            <p>Customize the top hero banners and the 4-column trust ratings bar.</p>
        </div>
    </div>
    <div class="padded">
        <h3 style="margin-bottom:12px;font-size:1.05rem;">Hero Header</h3>
        <div class="form-grid">
            <x-field name="hero_badge" label="Top Eyebrow Badge" :value="$settings->hero_badge ?? '✦ Welcome to Your New Home'"/>
            <x-field name="hero_title" label="Main Hero Headline" :value="$settings->hero_title ?? 'Experience Safe, Clean & Homely Living'"/>
        </div>
        <label class="field" style="margin-top:14px;margin-bottom:24px;">
            <span>Hero Subtitle Description</span>
            <textarea name="hero_subtitle" rows="2">{{ old('hero_subtitle', $settings->hero_subtitle ?? 'Exclusively designed for female students and working professionals in Kochi. Attached bathrooms in all rooms, 3 fresh daily meals, and 24/7 security.') }}</textarea>
        </label>

        <hr style="border:0;border-top:1px solid var(--border);margin:24px 0;">

        <h3 style="margin-bottom:12px;font-size:1.05rem;">Deep Navy Promo Card ("Stay Longer, Save More")</h3>
        <div class="form-grid">
            <x-field name="promo_title" label="Promo Card Title" :value="$settings->promo_title ?? 'Stay Longer, Save More'"/>
            <x-field name="promo_tagline" label="Promo Tagline" :value="$settings->promo_tagline ?? 'It\'s simple: transparent pricing with zero hidden charges and total peace of mind!'"/>
            <x-field name="promo_perk_1" label="Bullet Perk 1" :value="$settings->promo_perk_1 ?? 'Healthy 3 Daily Home-Cooked Meals with South & North Indian varieties.'"/>
            <x-field name="promo_perk_2" label="Bullet Perk 2" :value="$settings->promo_perk_2 ?? 'Flexible Plans from ₹4,200/mo (Without Food) to ₹6,500/mo (With Food).'"/>
            <x-field name="promo_perk_3" label="Bullet Perk 3" :value="$settings->promo_perk_3 ?? 'Attached Bathrooms in 100% of rooms with 24/7 hot & cold water.'"/>
            <x-field name="promo_btn_text" label="Button Text" :value="$settings->promo_btn_text ?? 'Choose room'"/>
        </div>

        <hr style="border:0;border-top:1px solid var(--border);margin:24px 0;">

        <h3 style="margin-bottom:12px;font-size:1.05rem;">4-Column Ratings & Trust Strip</h3>
        <div class="form-grid">
            <x-field name="stat_1_val" label="Stat 1 Value" :value="$settings->stat_1_val ?? '4.9 /5'"/>
            <x-field name="stat_1_sub" label="Stat 1 Subtitle" :value="$settings->stat_1_sub ?? '240+ verified ratings'"/>
            <x-field name="stat_1_label" label="Stat 1 Brand/Label" :value="$settings->stat_1_label ?? 'Google Reviews'"/>

            <x-field name="stat_2_val" label="Stat 2 Value" :value="$settings->stat_2_val ?? '100% Safe'"/>
            <x-field name="stat_2_sub" label="Stat 2 Subtitle" :value="$settings->stat_2_sub ?? 'Biometric & CCTV'"/>
            <x-field name="stat_2_label" label="Stat 2 Brand/Label" :value="$settings->stat_2_label ?? '24/7 Protection'"/>

            <x-field name="stat_3_val" label="Stat 3 Value" :value="$settings->stat_3_val ?? '3 Meals'"/>
            <x-field name="stat_3_sub" label="Stat 3 Subtitle" :value="$settings->stat_3_sub ?? 'Fresh & Homely daily'"/>
            <x-field name="stat_3_label" label="Stat 3 Brand/Label" :value="$settings->stat_3_label ?? 'Hygienic Kitchen'"/>

            <x-field name="stat_4_val" label="Stat 4 Value" :value="$settings->stat_4_val ?? '98% Rate'"/>
            <x-field name="stat_4_sub" label="Stat 4 Subtitle" :value="$settings->stat_4_sub ?? 'Resident satisfaction'"/>
            <x-field name="stat_4_label" label="Stat 4 Brand/Label" :value="$settings->stat_4_label ?? 'Recommended'"/>
        </div>

        <div style="margin-top:20px;">
            <button class="btn primary">Save Hero & Stats</button>
        </div>
    </div>
</form>

@elseif($activeTab === 'rooms')
<!-- 3. FEATURED ROOM CARDS -->
<div class="panel">
    <div class="panel-heading">
        <div>
            <h2>Featured Room Cards ({{ $rooms->count() }})</h2>
            <p>Control the room cards displayed in the top hero grid and accommodation showcases.</p>
        </div>
        <button type="button" class="btn primary small" onclick="openRoomModal()">+ Add Room Card</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title & Sharing</th>
                    <th>Room #</th>
                    <th>Monthly Rent</th>
                    <th>Sleeps / Beds</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $item)
                <tr>
                    <td style="width:70px;">
                        @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" style="width:60px;height:42px;object-fit:cover;border-radius:6px;border:1px solid var(--border);">
                        @else
                            <span class="avatar" style="border-radius:6px;">🛏️</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $item->title }}</strong>
                        <small>{{ $item->sharing_type }}</small>
                    </td>
                    <td>{{ $item->room_number ?? '—' }}</td>
                    <td>
                        <strong>₹{{ number_format($item->monthly_rent) }}</strong>
                        @if($item->rent_without_food)
                            <small>Without food: ₹{{ number_format($item->rent_without_food) }}</small>
                        @endif
                    </td>
                    <td>{{ $item->sleeps_text ?? '—' }} · {{ $item->bed_type_text ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'active' : 'inactive' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn small" onclick='editRoomModal(@json($item))'>Edit</button>
                            <form action="{{ route('website.content.rooms.destroy', $item) }}" method="post" onsubmit="return confirm('Delete this room showcase?');">
                                @csrf @method('delete')
                                <button class="btn danger small">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty">No showcase rooms added yet. Default room templates are shown on the site.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ROOM MODAL DIALOG -->
<dialog id="roomModal" class="booking-modal" style="max-width:560px;">
    <div class="modal-header">
        <h3 id="roomModalTitle">Add Room Card</h3>
        <button type="button" class="modal-close-btn" onclick="document.getElementById('roomModal').close()">&times;</button>
    </div>
    <form id="roomModalForm" action="{{ route('website.content.rooms.store') }}" method="post" enctype="multipart/form-data" class="modal-body">
        @csrf
        <div id="roomMethodPut"></div>
        <div class="form-group">
            <label>Card Title *</label>
            <input type="text" name="title" id="room_title" class="form-control" required placeholder="e.g. Bed in 6-Bed Room with Attached Bathroom">
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Sharing Type *</label>
                <select name="sharing_type" id="room_sharing" class="form-control">
                    <option value="Six Sharing">Six Sharing</option>
                    <option value="Five Sharing">Five Sharing</option>
                    <option value="Four Sharing">Four Sharing</option>
                    <option value="Two Sharing">Two Sharing</option>
                </select>
            </div>
            <div class="form-group">
                <label>Room Number(s)</label>
                <input type="text" name="room_number" id="room_number" class="form-control" placeholder="e.g. B1 or A1, B1">
            </div>
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Monthly Rent (With Food) ₹ *</label>
                <input type="number" name="monthly_rent" id="room_rent" class="form-control" step="0.01" required placeholder="6500">
            </div>
            <div class="form-group">
                <label>Rent Without Food ₹</label>
                <input type="number" name="rent_without_food" id="room_rent_without_food" class="form-control" step="0.01" placeholder="4200">
            </div>
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Sleeps Text</label>
                <input type="text" name="sleeps_text" id="room_sleeps" class="form-control" placeholder="e.g. 6 Sleeps">
            </div>
            <div class="form-group">
                <label>Bed Details</label>
                <input type="text" name="bed_type_text" id="room_bed_type" class="form-control" placeholder="e.g. TOP & DOWN Beds">
            </div>
        </div>
        <div class="form-group">
            <label>Upload Room Image</label>
            <input type="file" name="image_file" class="form-control" accept="image/*">
            <small class="muted">Or provide an external Image URL below:</small>
        </div>
        <div class="form-group">
            <input type="url" name="image_url" id="room_image_url" class="form-control" placeholder="https://images.unsplash.com/...">
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" id="room_sort_order" class="form-control" value="0">
            </div>
            <div class="form-group" style="display:flex;align-items:center;margin-top:28px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" id="room_is_active" value="1" checked> Active on site
                </label>
            </div>
        </div>
        <div style="display:flex;gap:10px;margin-top:16px;">
            <button type="button" class="btn" onclick="document.getElementById('roomModal').close()">Cancel</button>
            <button class="btn primary" style="flex:1;">Save Room</button>
        </div>
    </form>
</dialog>

@elseif($activeTab === 'facilities')
<!-- 4. FACILITIES -->
<div class="panel">
    <div class="panel-heading">
        <div>
            <h2>Hostel Amenities & Facilities ({{ $facilities->count() }})</h2>
            <p>These appear in the 2x2 grid in "We have everything you need".</p>
        </div>
        <button type="button" class="btn primary small" onclick="openFacilityModal()">+ Add Facility</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($facilities as $item)
                <tr>
                    <td style="font-size:22px;text-align:center;">{{ $item->icon }}</td>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'active' : 'inactive' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn small" onclick='editFacilityModal(@json($item))'>Edit</button>
                            <form action="{{ route('website.content.facilities.destroy', $item) }}" method="post" onsubmit="return confirm('Delete this facility?');">
                                @csrf @method('delete')
                                <button class="btn danger small">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty">No facilities added yet. Default facilities are active on site.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- FACILITY MODAL -->
<dialog id="facilityModal" class="booking-modal" style="max-width:500px;">
    <div class="modal-header">
        <h3 id="facilityModalTitle">Add Facility</h3>
        <button type="button" class="modal-close-btn" onclick="document.getElementById('facilityModal').close()">&times;</button>
    </div>
    <form id="facilityModalForm" action="{{ route('website.content.facilities.store') }}" method="post" class="modal-body">
        @csrf
        <div id="facilityMethodPut"></div>
        <div class="form-group">
            <label>Icon Emoji or Symbol *</label>
            <input type="text" name="icon" id="facility_icon" class="form-control" required placeholder="📶 or 📍 or 🧳 or 🅿️">
        </div>
        <div class="form-group">
            <label>Facility Title *</label>
            <input type="text" name="title" id="facility_title" class="form-control" required placeholder="e.g. Free high speed WiFi">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="facility_desc" class="form-control" rows="2" placeholder="High-speed fiber internet for uninterrupted work..."></textarea>
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" id="facility_sort_order" class="form-control" value="0">
            </div>
            <div class="form-group" style="display:flex;align-items:center;margin-top:28px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" id="facility_is_active" value="1" checked> Active on site
                </label>
            </div>
        </div>
        <div style="display:flex;gap:10px;margin-top:16px;">
            <button type="button" class="btn" onclick="document.getElementById('facilityModal').close()">Cancel</button>
            <button class="btn primary" style="flex:1;">Save Facility</button>
        </div>
    </form>
</dialog>

@elseif($activeTab === 'gallery')
<!-- 5. PHOTO GALLERY -->
<div class="panel">
    <div class="panel-heading">
        <div>
            <h2>Photos of Our Rooms & Hostel ({{ $gallery->count() }})</h2>
            <p>These power the bento photo gallery and zoom lightbox on the website.</p>
        </div>
        <button type="button" class="btn primary small" onclick="openGalleryModal()">+ Add Photo</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Caption / Title</th>
                    <th>Category</th>
                    <th>Layout Style</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gallery as $item)
                <tr>
                    <td style="width:80px;">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" style="width:70px;height:48px;object-fit:cover;border-radius:6px;border:1px solid var(--border);">
                    </td>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td>{{ $item->category ?? 'General' }}</td>
                    <td>{{ $item->is_tall ? 'Tall (Left Column)' : 'Standard' }}</td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'active' : 'inactive' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn small" onclick='editGalleryModal(@json($item))'>Edit</button>
                            <form action="{{ route('website.content.gallery.destroy', $item) }}" method="post" onsubmit="return confirm('Delete this gallery photo?');">
                                @csrf @method('delete')
                                <button class="btn danger small">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty">No custom gallery photos uploaded yet. Built-in hostel photos are displayed.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- GALLERY MODAL -->
<dialog id="galleryModal" class="booking-modal" style="max-width:520px;">
    <div class="modal-header">
        <h3 id="galleryModalTitle">Add Gallery Photo</h3>
        <button type="button" class="modal-close-btn" onclick="document.getElementById('galleryModal').close()">&times;</button>
    </div>
    <form id="galleryModalForm" action="{{ route('website.content.gallery.store') }}" method="post" enctype="multipart/form-data" class="modal-body">
        @csrf
        <div id="galleryMethodPut"></div>
        <div class="form-group">
            <label>Photo Caption / Title *</label>
            <input type="text" name="title" id="gallery_title" class="form-control" required placeholder="e.g. Secure Building Exterior & Entrance">
        </div>
        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" id="gallery_cat" class="form-control" placeholder="e.g. Building, Bedroom, Kitchen, Dining">
        </div>
        <div class="form-group">
            <label>Upload Image File</label>
            <input type="file" name="image_file" class="form-control" accept="image/*">
            <small class="muted">Or provide image URL:</small>
        </div>
        <div class="form-group">
            <input type="text" name="image_url" id="gallery_url" class="form-control" placeholder="https://... or /images/building.jpg">
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group" style="display:flex;align-items:center;margin-top:20px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_tall" id="gallery_is_tall" value="1"> Tall card (span 2 rows)
                </label>
            </div>
            <div class="form-group" style="display:flex;align-items:center;margin-top:20px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" id="gallery_is_active" value="1" checked> Active on site
                </label>
            </div>
        </div>
        <div style="display:flex;gap:10px;margin-top:16px;">
            <button type="button" class="btn" onclick="document.getElementById('galleryModal').close()">Cancel</button>
            <button class="btn primary" style="flex:1;">Save Photo</button>
        </div>
    </form>
</dialog>

@elseif($activeTab === 'testimonials')
<!-- 6. TESTIMONIALS -->
<div class="panel">
    <div class="panel-heading">
        <div>
            <h2>Resident Testimonials & Reviews ({{ $testimonials->count() }})</h2>
            <p>Manage reviews shown in the interactive testimonial slider.</p>
        </div>
        <button type="button" class="btn primary small" onclick="openTestimonialModal()">+ Add Review</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Resident Name</th>
                    <th>Role / Details</th>
                    <th>Rating</th>
                    <th>Review Headline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $item)
                <tr>
                    <td style="width:60px;">
                        @if($item->avatar_url)
                            <img src="{{ $item->avatar_url }}" alt="{{ $item->name }}" style="width:42px;height:42px;border-radius:50%;object-fit:cover;border:1px solid var(--border);">
                        @else
                            <span class="avatar">{{ substr($item->name, 0, 1) }}</span>
                        @endif
                    </td>
                    <td><strong>{{ $item->name }}</strong><small>{{ $item->stay_date }}</small></td>
                    <td>{{ $item->role ?? '—' }}</td>
                    <td style="color:var(--star-gold);font-weight:700;">{{ str_repeat('★', $item->rating) }}</td>
                    <td><strong>{{ $item->headline }}</strong><small>{{ Str::limit($item->quote, 60) }}</small></td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'active' : 'inactive' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn small" onclick='editTestimonialModal(@json($item))'>Edit</button>
                            <form action="{{ route('website.content.testimonials.destroy', $item) }}" method="post" onsubmit="return confirm('Delete this testimonial?');">
                                @csrf @method('delete')
                                <button class="btn danger small">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty">No custom testimonials added yet. Sample reviews are displayed.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- TESTIMONIAL MODAL -->
<dialog id="testimonialModal" class="booking-modal" style="max-width:540px;">
    <div class="modal-header">
        <h3 id="testimonialModalTitle">Add Testimonial</h3>
        <button type="button" class="modal-close-btn" onclick="document.getElementById('testimonialModal').close()">&times;</button>
    </div>
    <form id="testimonialModalForm" action="{{ route('website.content.testimonials.store') }}" method="post" enctype="multipart/form-data" class="modal-body">
        @csrf
        <div id="testimonialMethodPut"></div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Resident Full Name *</label>
                <input type="text" name="name" id="test_name" class="form-control" required placeholder="e.g. Lisa Adams">
            </div>
            <div class="form-group">
                <label>Occupation / College</label>
                <input type="text" name="role" id="test_role" class="form-control" placeholder="e.g. Software Engineer, Kakkanad">
            </div>
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Stay Date</label>
                <input type="text" name="stay_date" id="test_date" class="form-control" placeholder="e.g. Stay: October 2026">
            </div>
            <div class="form-group">
                <label>Star Rating (1 - 5) *</label>
                <select name="rating" id="test_rating" class="form-control">
                    <option value="5">★★★★★ (5 Stars)</option>
                    <option value="4">★★★★☆ (4 Stars)</option>
                    <option value="3">★★★☆☆ (3 Stars)</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Headline *</label>
            <input type="text" name="headline" id="test_headline" class="form-control" required placeholder="e.g. Very cozy room close to everything, feels just like home!">
        </div>
        <div class="form-group">
            <label>Full Review Quote *</label>
            <textarea name="quote" id="test_quote" class="form-control" rows="3" required placeholder="SJ Ladies Hostel is truly a home away from home..."></textarea>
        </div>
        <div class="form-group">
            <label>Upload Photo</label>
            <input type="file" name="avatar_file" class="form-control" accept="image/*">
            <small class="muted">Or avatar URL:</small>
        </div>
        <div class="form-group">
            <input type="url" name="avatar_url" id="test_avatar_url" class="form-control" placeholder="https://images.unsplash.com/...">
        </div>
        <div style="display:flex;gap:10px;margin-top:16px;">
            <button type="button" class="btn" onclick="document.getElementById('testimonialModal').close()">Cancel</button>
            <button class="btn primary" style="flex:1;">Save Testimonial</button>
        </div>
    </form>
</dialog>

@elseif($activeTab === 'updates')
<!-- 7. HOSTEL LIFE / NEWS -->
<div class="panel">
    <div class="panel-heading">
        <div>
            <h2>Hostel Life & Updates / News ({{ $updates->count() }})</h2>
            <p>Publish articles, updates, dining news, and announcements for residents and visitors.</p>
        </div>
        <button type="button" class="btn primary small" onclick="openUpdateModal()">+ Add Article / Update</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($updates as $item)
                <tr>
                    <td style="width:70px;">
                        @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" style="width:60px;height:42px;object-fit:cover;border-radius:6px;border:1px solid var(--border);">
                        @else
                            <span class="avatar" style="border-radius:6px;">📰</span>
                        @endif
                    </td>
                    <td><strong>{{ $item->title }}</strong><small>{{ Str::limit($item->excerpt, 60) }}</small></td>
                    <td><span class="badge">{{ $item->category }}</span></td>
                    <td>{{ $item->date_text ?? 'November 2026' }}</td>
                    <td>{{ $item->views_count }} views</td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'active' : 'inactive' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn small" onclick='editUpdateModal(@json($item))'>Edit</button>
                            <form action="{{ route('website.content.updates.destroy', $item) }}" method="post" onsubmit="return confirm('Delete this update?');">
                                @csrf @method('delete')
                                <button class="btn danger small">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty">No updates published yet. Default hostel news is displayed.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- UPDATE MODAL -->
<dialog id="updateModal" class="booking-modal" style="max-width:540px;">
    <div class="modal-header">
        <h3 id="updateModalTitle">Add Article / Update</h3>
        <button type="button" class="modal-close-btn" onclick="document.getElementById('updateModal').close()">&times;</button>
    </div>
    <form id="updateModalForm" action="{{ route('website.content.updates.store') }}" method="post" enctype="multipart/form-data" class="modal-body">
        @csrf
        <div id="updateMethodPut"></div>
        <div class="form-group">
            <label>Article Title *</label>
            <input type="text" name="title" id="update_title" class="form-control" required placeholder="e.g. Fresh Kerala meals prepared with pure hygiene every single day">
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>Category Badge *</label>
                <input type="text" name="category" id="update_cat" class="form-control" required placeholder="e.g. Food & Health or Security">
            </div>
            <div class="form-group">
                <label>Month / Date</label>
                <input type="text" name="date_text" id="update_date" class="form-control" placeholder="e.g. November 2026">
            </div>
        </div>
        <div class="form-group">
            <label>Excerpt / Short Description</label>
            <textarea name="excerpt" id="update_excerpt" class="form-control" rows="3" placeholder="Enjoy wholesome breakfast, packed lunch, evening snacks..."></textarea>
        </div>
        <div class="form-group">
            <label>Upload Article Image</label>
            <input type="file" name="image_file" class="form-control" accept="image/*">
            <small class="muted">Or provide image URL:</small>
        </div>
        <div class="form-group">
            <input type="url" name="image_url" id="update_image_url" class="form-control" placeholder="https://images.unsplash.com/...">
        </div>
        <div class="form-grid" style="grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group">
                <label>View Count</label>
                <input type="number" name="views_count" id="update_views" class="form-control" value="180">
            </div>
            <div class="form-group" style="display:flex;align-items:center;margin-top:28px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" id="update_is_active" value="1" checked> Active on site
                </label>
            </div>
        </div>
        <div style="display:flex;gap:10px;margin-top:16px;">
            <button type="button" class="btn" onclick="document.getElementById('updateModal').close()">Cancel</button>
            <button class="btn primary" style="flex:1;">Save Update</button>
        </div>
    </form>
</dialog>
@endif

@endsection

@push('scripts')
<script>
    // ROOM MODAL LOGIC
    function openRoomModal() {
        document.getElementById('roomModalTitle').textContent = 'Add Room Card';
        document.getElementById('roomModalForm').action = "{{ route('website.content.rooms.store') }}";
        document.getElementById('roomMethodPut').innerHTML = '';
        document.getElementById('room_title').value = '';
        document.getElementById('room_sharing').value = 'Four Sharing';
        document.getElementById('room_number').value = '';
        document.getElementById('room_rent').value = '6500';
        document.getElementById('room_rent_without_food').value = '4200';
        document.getElementById('room_sleeps').value = '4 Sleeps';
        document.getElementById('room_bed_type').value = 'TOP & DOWN Beds';
        document.getElementById('room_image_url').value = '';
        document.getElementById('room_sort_order').value = '0';
        document.getElementById('room_is_active').checked = true;
        document.getElementById('roomModal').showModal();
    }

    function editRoomModal(item) {
        document.getElementById('roomModalTitle').textContent = 'Edit Room Card';
        document.getElementById('roomModalForm').action = `/website-content/rooms/${item.id}`;
        document.getElementById('roomMethodPut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('room_title').value = item.title;
        document.getElementById('room_sharing').value = item.sharing_type;
        document.getElementById('room_number').value = item.room_number || '';
        document.getElementById('room_rent').value = item.monthly_rent;
        document.getElementById('room_rent_without_food').value = item.rent_without_food || '';
        document.getElementById('room_sleeps').value = item.sleeps_text || '';
        document.getElementById('room_bed_type').value = item.bed_type_text || '';
        document.getElementById('room_image_url').value = item.image_url || '';
        document.getElementById('room_sort_order').value = item.sort_order || 0;
        document.getElementById('room_is_active').checked = item.is_active;
        document.getElementById('roomModal').showModal();
    }

    // FACILITY MODAL LOGIC
    function openFacilityModal() {
        document.getElementById('facilityModalTitle').textContent = 'Add Facility';
        document.getElementById('facilityModalForm').action = "{{ route('website.content.facilities.store') }}";
        document.getElementById('facilityMethodPut').innerHTML = '';
        document.getElementById('facility_icon').value = '📶';
        document.getElementById('facility_title').value = '';
        document.getElementById('facility_desc').value = '';
        document.getElementById('facility_sort_order').value = '0';
        document.getElementById('facility_is_active').checked = true;
        document.getElementById('facilityModal').showModal();
    }

    function editFacilityModal(item) {
        document.getElementById('facilityModalTitle').textContent = 'Edit Facility';
        document.getElementById('facilityModalForm').action = `/website-content/facilities/${item.id}`;
        document.getElementById('facilityMethodPut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('facility_icon').value = item.icon;
        document.getElementById('facility_title').value = item.title;
        document.getElementById('facility_desc').value = item.description || '';
        document.getElementById('facility_sort_order').value = item.sort_order || 0;
        document.getElementById('facility_is_active').checked = item.is_active;
        document.getElementById('facilityModal').showModal();
    }

    // GALLERY MODAL LOGIC
    function openGalleryModal() {
        document.getElementById('galleryModalTitle').textContent = 'Add Gallery Photo';
        document.getElementById('galleryModalForm').action = "{{ route('website.content.gallery.store') }}";
        document.getElementById('galleryMethodPut').innerHTML = '';
        document.getElementById('gallery_title').value = '';
        document.getElementById('gallery_cat').value = 'Bedroom';
        document.getElementById('gallery_url').value = '';
        document.getElementById('gallery_is_tall').checked = false;
        document.getElementById('gallery_is_active').checked = true;
        document.getElementById('galleryModal').showModal();
    }

    function editGalleryModal(item) {
        document.getElementById('galleryModalTitle').textContent = 'Edit Gallery Photo';
        document.getElementById('galleryModalForm').action = `/website-content/gallery/${item.id}`;
        document.getElementById('galleryMethodPut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('gallery_title').value = item.title;
        document.getElementById('gallery_cat').value = item.category || '';
        document.getElementById('gallery_url').value = item.image_url || '';
        document.getElementById('gallery_is_tall').checked = item.is_tall;
        document.getElementById('gallery_is_active').checked = item.is_active;
        document.getElementById('galleryModal').showModal();
    }

    // TESTIMONIAL MODAL LOGIC
    function openTestimonialModal() {
        document.getElementById('testimonialModalTitle').textContent = 'Add Testimonial';
        document.getElementById('testimonialModalForm').action = "{{ route('website.content.testimonials.store') }}";
        document.getElementById('testimonialMethodPut').innerHTML = '';
        document.getElementById('test_name').value = '';
        document.getElementById('test_role').value = '';
        document.getElementById('test_date').value = 'Stay: November 2026';
        document.getElementById('test_rating').value = '5';
        document.getElementById('test_headline').value = '';
        document.getElementById('test_quote').value = '';
        document.getElementById('test_avatar_url').value = '';
        document.getElementById('testimonialModal').showModal();
    }

    function editTestimonialModal(item) {
        document.getElementById('testimonialModalTitle').textContent = 'Edit Testimonial';
        document.getElementById('testimonialModalForm').action = `/website-content/testimonials/${item.id}`;
        document.getElementById('testimonialMethodPut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('test_name').value = item.name;
        document.getElementById('test_role').value = item.role || '';
        document.getElementById('test_date').value = item.stay_date || '';
        document.getElementById('test_rating').value = item.rating || 5;
        document.getElementById('test_headline').value = item.headline || '';
        document.getElementById('test_quote').value = item.quote;
        document.getElementById('test_avatar_url').value = item.avatar_url || '';
        document.getElementById('testimonialModal').showModal();
    }

    // UPDATE / NEWS MODAL LOGIC
    function openUpdateModal() {
        document.getElementById('updateModalTitle').textContent = 'Add Article / Update';
        document.getElementById('updateModalForm').action = "{{ route('website.content.updates.store') }}";
        document.getElementById('updateMethodPut').innerHTML = '';
        document.getElementById('update_title').value = '';
        document.getElementById('update_cat').value = 'Hostel Life';
        document.getElementById('update_date').value = 'November 2026';
        document.getElementById('update_excerpt').value = '';
        document.getElementById('update_image_url').value = '';
        document.getElementById('update_views').value = '180';
        document.getElementById('update_is_active').checked = true;
        document.getElementById('updateModal').showModal();
    }

    function editUpdateModal(item) {
        document.getElementById('updateModalTitle').textContent = 'Edit Article / Update';
        document.getElementById('updateModalForm').action = `/website-content/updates/${item.id}`;
        document.getElementById('updateMethodPut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('update_title').value = item.title;
        document.getElementById('update_cat').value = item.category || '';
        document.getElementById('update_date').value = item.date_text || '';
        document.getElementById('update_excerpt').value = item.excerpt || '';
        document.getElementById('update_image_url').value = item.image_url || '';
        document.getElementById('update_views').value = item.views_count || 180;
        document.getElementById('update_is_active').checked = item.is_active;
        document.getElementById('updateModal').showModal();
    }
</script>
@endpush
