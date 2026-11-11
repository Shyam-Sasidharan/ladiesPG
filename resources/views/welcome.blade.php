<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->name ?? 'SJ Ladies Hostel' }} · Premium, Safe & Homely Women's PG in Kochi</title>
    <meta name="description" content="{{ $settings->notes ?? 'SJ Ladies Hostel offers safe, comfortable, and homely accommodation for working women and female students in Kochi. Attached bathrooms in all rooms, 3 fresh home-cooked meals, Wi-Fi, and 24/7 security.' }}">
    <link rel="icon" type="image/jpeg" href="{{ $settings->logo_path ? asset('storage/'.$settings->logo_path) : asset('images/logo.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* HOSTELLER MODEL DESIGN PALETTE */
            --hostel-blue: #2563eb;         /* Hosteller Primary Vibrant Blue */
            --hostel-blue-dark: #1d4ed8;
            --hostel-blue-light: #eff6ff;
            --hostel-navy: #0b2545;         /* Hosteller Deep Navy Banner & Footer */
            --hostel-navy-dark: #07192f;
            --hostel-navy-light: #133a68;

            /* Neutral canvas & surfaces */
            --bg-body: #f8fafc;
            --surface: #ffffff;
            --surface-muted: #f1f5f9;
            --border: #e2e8f0;
            --border-light: #f1f5f9;

            /* Typography colors */
            --text-heading: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --text-light: #94a3b8;

            /* Accents */
            --star-gold: #f59e0b;
            --wa-green: #25d366;
            --wa-green-dark: #1ea952;

            /* Radii & Shadows */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-pill: 9999px;

            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 4px 14px -2px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 12px 32px -4px rgba(15, 23, 42, 0.12);
            --shadow-xl: 0 20px 45px -8px rgba(11, 37, 69, 0.18);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            font-size: 15px;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--text-heading);
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: inherit;
            font-size: 0.93rem;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: var(--radius-pill);
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--hostel-blue);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);
        }
        .btn-primary:hover {
            background-color: var(--hostel-blue-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35);
        }

        .btn-dark {
            background-color: var(--hostel-navy);
            color: #ffffff;
        }
        .btn-dark:hover {
            background-color: var(--hostel-navy-dark);
            transform: translateY(-1px);
        }

        .btn-white {
            background-color: #ffffff;
            color: var(--hostel-navy);
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .btn-white:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--hostel-blue);
            border-color: var(--border);
        }
        .btn-outline:hover {
            background-color: var(--hostel-blue-light);
            border-color: var(--hostel-blue);
        }

        .btn-sm {
            padding: 7px 16px;
            font-size: 0.85rem;
        }

        /* HEADER / NAVBAR */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 74px;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-logo-img {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border);
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        .brand-text {
            display: flex;
            flex-direction: column;
        }
        .brand-name {
            font-size: 1.22rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.02em;
            line-height: 1.15;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .brand-name span {
            color: var(--hostel-blue);
        }
        .brand-sub {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
        }
        .nav-link {
            font-size: 0.93rem;
            font-weight: 500;
            color: var(--text-body);
            position: relative;
            padding: 4px 0;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--hostel-blue);
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--hostel-blue);
            border-radius: 2px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .admin-link {
            font-size: 0.86rem;
            font-weight: 600;
            color: var(--text-muted);
            padding: 8px 14px;
            border-radius: var(--radius-pill);
            border: 1px solid var(--border);
        }
        .admin-link:hover {
            color: var(--text-heading);
            border-color: var(--text-muted);
            background: var(--surface-muted);
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-heading);
        }

        .mobile-staff-item {
            display: none;
        }

        /* HERO & FEATURED ROOMS (3-CARD GRID IN VIDEO) */
        .hero-section {
            padding: 48px 0 36px;
        }

        .hero-heading-wrap {
            margin-bottom: 32px;
            text-align: center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--hostel-blue);
            background: var(--hostel-blue-light);
            padding: 5px 14px;
            border-radius: var(--radius-pill);
            margin-bottom: 12px;
        }
        .hero-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 10px;
            letter-spacing: -0.03em;
        }
        .hero-subtitle {
            font-size: 1.05rem;
            color: var(--text-muted);
            max-width: 640px;
            margin: 0 auto;
        }

        .featured-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            align-items: stretch;
            margin-top: 18px;
        }

        .room-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.28s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: #cbd5e1;
        }

        .room-card-img-wrap {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: #e2e8f0;
        }
        .room-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .room-card:hover .room-card-img {
            transform: scale(1.04);
        }

        .price-badge {
            position: absolute;
            bottom: 14px;
            right: 14px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: var(--radius-pill);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            font-size: 0.84rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        .price-badge strong {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-heading);
        }

        .room-card-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .room-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 12px;
            line-height: 1.35;
        }

        .room-meta-row {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border-light);
        }
        .room-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .card-bottom-link {
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--hostel-blue);
        }
        .card-bottom-link:hover {
            color: var(--hostel-blue-dark);
            gap: 10px;
        }

        /* PROMOTIONAL CARD 3 (DEEP NAVY: "STAY LONGER, SAVE MORE") */
        .promo-navy-card {
            background-color: var(--hostel-navy);
            color: #ffffff;
            border-radius: var(--radius-lg);
            padding: 34px 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
        }
        .promo-navy-card::after {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(11, 37, 69, 0) 70%);
            pointer-events: none;
        }
        .promo-navy-card h2 {
            font-size: 1.85rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 10px;
            letter-spacing: -0.03em;
        }
        .promo-tagline {
            font-size: 0.95rem;
            color: #93c5fd;
            margin-bottom: 24px;
            line-height: 1.5;
        }
        .promo-perks-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 28px;
        }
        .promo-perk-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.92rem;
            color: #e2e8f0;
            line-height: 1.45;
        }
        .promo-perk-item strong {
            color: #ffffff;
        }
        .promo-check-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2563eb;
            color: #ffffff;
            font-size: 11px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* SECTION: "WE HAVE EVERYTHING YOU NEED" */
        .everything-section {
            padding: 80px 0;
            background: #ffffff;
            border-top: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
        }
        .everything-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.95fr;
            gap: 56px;
            align-items: center;
        }

        .everything-content h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 14px;
            letter-spacing: -0.03em;
        }
        .everything-intro {
            font-size: 1.02rem;
            color: var(--text-muted);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .features-2x2-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 36px;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .feature-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            color: var(--hostel-blue);
            background: var(--surface);
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }
        .feature-item-text h4 {
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 4px;
        }
        .feature-item-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.45;
        }

        .everything-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .more-about-link {
            font-size: 0.93rem;
            font-weight: 700;
            color: var(--hostel-blue);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .more-about-link:hover {
            color: var(--hostel-blue-dark);
            gap: 10px;
        }

        .everything-media-wrap {
            position: relative;
        }
        .everything-media-img {
            width: 100%;
            height: 460px;
            object-fit: cover;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
        }
        .media-floating-badge {
            position: absolute;
            bottom: 24px;
            left: 24px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            padding: 14px 20px;
            border-radius: var(--radius-lg);
            box-shadow: 0 10px 25px rgba(0,0,0,0.14);
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid var(--border);
        }
        .media-badge-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--hostel-blue);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
        .media-badge-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-heading);
        }
        .media-badge-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* SECTION: 4-COLUMN RATINGS & TRUST STRIP */
        .ratings-strip-section {
            padding: 38px 0;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
        }
        .ratings-strip-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            align-items: center;
            text-align: center;
        }
        .rating-col {
            padding: 12px 16px;
            border-right: 1px solid var(--border-light);
        }
        .rating-col:last-child {
            border-right: none;
        }
        .rating-score {
            font-size: 2.1rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.03em;
            line-height: 1.1;
            margin-bottom: 4px;
        }
        .rating-score span {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-muted);
        }
        .rating-notes {
            font-size: 0.84rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }
        .rating-brand-badge {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--hostel-blue);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* SECTION: "WHAT OUR GUESTS SAY" TESTIMONIALS */
        .testimonials-section {
            padding: 80px 0;
            background: var(--bg-body);
        }
        .section-header-center {
            text-align: center;
            margin-bottom: 48px;
        }
        .section-header-center h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.03em;
            margin-bottom: 8px;
        }
        .section-header-center p {
            font-size: 1.02rem;
            color: var(--text-muted);
        }

        .testimonial-showcase-grid {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 40px;
            align-items: center;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            padding: 32px;
        }

        .testimonial-photo-wrap {
            height: 380px;
            border-radius: var(--radius-lg);
            overflow: hidden;
        }
        .testimonial-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .testimonial-content {
            padding: 10px 18px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .star-row {
            display: flex;
            align-items: center;
            gap: 4px;
            color: var(--star-gold);
            font-size: 18px;
            margin-bottom: 12px;
        }
        .stay-date-tag {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 14px;
        }
        .testimonial-quote-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 14px;
            line-height: 1.3;
        }
        .testimonial-quote-body {
            font-size: 0.98rem;
            color: var(--text-body);
            line-height: 1.65;
            margin-bottom: 24px;
        }
        .testimonial-author-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 18px;
            border-top: 1px solid var(--border-light);
        }
        .author-info h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-heading);
        }
        .author-info p {
            font-size: 0.84rem;
            color: var(--text-muted);
        }
        .testimonial-nav-arrows {
            display: flex;
            gap: 8px;
        }
        .nav-arrow-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: #ffffff;
            color: var(--text-heading);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 16px;
        }
        .nav-arrow-btn:hover {
            background: var(--hostel-blue);
            color: #ffffff;
            border-color: var(--hostel-blue);
        }

        /* SECTION: "FIND SUITABLE BUDGET ACCOMMODATION" */
        .budget-accom-section {
            padding: 80px 0;
            background: #ffffff;
            border-top: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
        }
        .budget-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }
        .budget-content h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 14px;
            letter-spacing: -0.03em;
        }
        .budget-intro {
            font-size: 1.02rem;
            color: var(--text-muted);
            margin-bottom: 30px;
        }
        .budget-features-stack {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 28px;
        }
        .budget-feature-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px;
            background: var(--surface-muted);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-light);
        }
        .budget-card-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--hostel-blue);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .budget-card-text h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .budget-card-text p {
            font-size: 0.86rem;
            color: var(--text-muted);
        }

        .showcase-room-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
        }
        .floating-review-callout {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(8px);
            padding: 12px 18px;
            border-radius: var(--radius-md);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            border: 1px solid var(--border);
            max-width: 250px;
        }
        .floating-review-callout p {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 4px;
        }

        /* SECTION: "PHOTOS OF OUR ROOMS" BENTO GALLERY */
        .gallery-section {
            padding: 80px 0;
            background: var(--bg-body);
        }
        .gallery-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }
        .gallery-header-row h2 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .bento-gallery-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr;
            grid-template-rows: 230px 230px;
            gap: 20px;
        }
        .gallery-item {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: #cbd5e1;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }
        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }
        .gallery-item.tall {
            grid-row: span 2;
        }
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .gallery-overlay-icon {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--text-heading);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.24s ease;
        }
        .gallery-item:hover .gallery-overlay-icon {
            opacity: 1;
            transform: scale(1);
        }
        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
            color: #ffffff;
            font-size: 0.92rem;
            font-weight: 600;
        }

        /* SECTION: "HOSTELLER NEWS" / HOSTEL LIFE */
        .news-section {
            padding: 80px 0;
            background: #ffffff;
            border-top: 1px solid var(--border-light);
        }
        .news-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
        }
        .news-header-row h2 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }
        .news-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .news-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.28s ease;
            box-shadow: var(--shadow-sm);
        }
        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }
        .news-card-img-wrap {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .news-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .news-card:hover .news-card-img {
            transform: scale(1.05);
        }
        .news-category-tag {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            color: var(--hostel-blue);
            font-size: 0.76rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: var(--radius-pill);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .news-card-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .news-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 10px;
            line-height: 1.35;
        }
        .news-card-excerpt {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 18px;
        }
        .news-card-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--text-light);
            padding-top: 14px;
            border-top: 1px solid var(--border-light);
        }

        /* SECTION: "CONTACTS" & LOCATION */
        .contacts-section {
            padding: 80px 0;
            background: var(--bg-body);
            border-top: 1px solid var(--border);
        }
        .contacts-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 48px;
            align-items: center;
        }
        .contacts-content h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 12px;
            letter-spacing: -0.03em;
        }
        .contacts-intro {
            font-size: 1.02rem;
            color: var(--text-muted);
            margin-bottom: 32px;
        }
        .contacts-2x2-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }
        .contact-box {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .contact-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--hostel-blue);
            background: #ffffff;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }
        .contact-box-text h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 4px;
        }
        .contact-box-text p, .contact-box-text a {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.45;
        }
        .contact-box-text a:hover {
            color: var(--hostel-blue);
        }

        .map-card-wrap {
            height: 400px;
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-lg);
            background: #ffffff;
        }
        .map-card-wrap iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* FOOTER */
        .site-footer {
            background-color: var(--hostel-navy);
            color: #cbd5e1;
            padding: 70px 0 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 0.8fr 1fr 0.8fr;
            gap: 40px;
            margin-bottom: 50px;
        }
        .footer-brand h3 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-brand h3 span {
            color: #60a5fa;
        }
        .footer-brand p {
            font-size: 0.9rem;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 20px;
            max-width: 320px;
        }

        .footer-col h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 18px;
            position: relative;
        }
        .footer-links-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .footer-links-list a {
            font-size: 0.9rem;
            color: #94a3b8;
        }
        .footer-links-list a:hover {
            color: #ffffff;
            padding-left: 4px;
        }

        .footer-contact-info p {
            font-size: 0.9rem;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 12px;
        }
        .footer-contact-info a {
            color: #94a3b8;
        }
        .footer-contact-info a:hover {
            color: #ffffff;
        }

        .footer-social-row {
            display: flex;
            gap: 12px;
            margin-top: 14px;
        }
        .social-circle-link {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s ease;
        }
        .social-circle-link:hover {
            background: var(--hostel-blue);
            transform: translateY(-2px);
        }

        .footer-bottom-bar {
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            color: #64748b;
        }

        /* MODAL ENQUIRY / BOOKING DIALOG */
        dialog.booking-modal {
            margin: auto;
            padding: 0;
            border: none;
            border-radius: var(--radius-xl);
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            max-width: 520px;
            width: 90%;
            max-height: 88vh;
            max-height: 88dvh;
            background: #ffffff;
            overflow: hidden;
        }
        dialog.booking-modal[open] {
            display: flex;
            flex-direction: column;
        }
        dialog.booking-modal::backdrop {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
        }
        .modal-header {
            padding: 18px 24px;
            background: var(--hostel-navy);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .modal-header h3 {
            color: #ffffff;
            font-size: 1.25rem;
            margin: 0;
        }
        .modal-close-btn {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 24px;
            cursor: pointer;
            line-height: 1;
        }
        .modal-body {
            padding: 20px 24px;
            overflow-y: auto;
            flex: 1;
            -webkit-overflow-scrolling: touch;
        }
        .form-group {
            margin-bottom: 14px;
        }
        .modal-form-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid var(--border-light);
            background: #ffffff;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }
        .form-group label {
            display: block;
            font-size: 0.86rem;
            font-weight: 600;
            color: var(--text-heading);
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 0.95rem;
            background: #ffffff;
            outline: none;
            transition: border-color 0.2s ease;
        }
        .form-control:focus {
            border-color: var(--hostel-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* AVAILABILITY & VACANCY MODAL */
        dialog.availability-modal {
            margin: auto;
            padding: 0;
            border: none;
            border-radius: var(--radius-xl);
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            max-width: 740px;
            width: 92%;
            max-height: 88vh;
            background: #ffffff;
            overflow: hidden;
        }
        dialog.availability-modal[open] {
            display: flex;
            flex-direction: column;
        }
        dialog.availability-modal::backdrop {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(5px);
        }
        .avail-stats-bar {
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .avail-stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            color: #166534;
            background: #dcfce7;
            padding: 6px 14px;
            border-radius: var(--radius-pill);
            font-weight: 700;
        }
        .avail-tabs {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .avail-tab-btn {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-pill);
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-body);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .avail-tab-btn:hover {
            border-color: var(--hostel-blue);
            color: var(--hostel-blue);
        }
        .avail-tab-btn.active {
            background: var(--hostel-blue);
            color: #ffffff;
            border-color: var(--hostel-blue);
        }
        .avail-modal-body {
            padding: 20px 24px;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .floor-group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid var(--border);
        }
        .floor-badge {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-heading);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .floor-stats {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
        }
        .rooms-slot-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 16px;
        }
        .room-slot-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
        }
        .room-slot-card.has-vacancy {
            border-color: #86efac;
            background: #f0fdf4;
        }
        .room-slot-card.highlighted-room {
            border: 2px solid var(--hostel-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
            animation: pulseHighlight 1.5s ease-in-out;
        }
        @keyframes pulseHighlight {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        .room-slot-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }
        .room-slot-number {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.2;
        }
        .room-slot-type {
            font-size: 0.82rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        .slot-pill {
            font-size: 0.76rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: var(--radius-pill);
            white-space: nowrap;
        }
        .slot-pill.vacant {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .slot-pill.full {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .room-slot-pricing {
            display: flex;
            flex-direction: column;
            gap: 3px;
            font-size: 0.82rem;
            color: var(--text-body);
            background: rgba(255, 255, 255, 0.75);
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .room-slot-pricing strong {
            color: var(--text-heading);
        }
        .beds-slot-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .beds-list-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--text-muted);
        }
        .beds-pill-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .bed-slot-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 9px;
            border-radius: 6px;
            border: 1px solid transparent;
            text-decoration: none;
        }
        .bed-slot-chip.available {
            background: #ffffff;
            border-color: #86efac;
            color: #166534;
            box-shadow: 0 1px 2px rgba(22, 101, 52, 0.1);
        }
        .bed-slot-chip.occupied {
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #94a3b8;
        }
        .bed-chip-tier {
            font-size: 0.65rem;
            padding: 1px 5px;
            border-radius: 4px;
            font-weight: 800;
        }
        .bed-chip-tier.top {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .bed-chip-tier.down {
            background: #fef3c7;
            color: #b45309;
        }
        .bed-chip-status {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-left: 2px;
        }
        .bed-slot-chip.available .bed-chip-status {
            color: #15803d;
        }
        .room-slot-actions {
            margin-top: auto;
            padding-top: 8px;
            display: flex;
            gap: 8px;
        }
        .btn-whatsapp-slot {
            flex: 1;
            background: var(--wa-green);
            color: #ffffff !important;
            font-size: 0.84rem;
            font-weight: 700;
            padding: 9px 12px;
            border-radius: var(--radius-pill);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: none;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-whatsapp-slot:hover {
            background: var(--wa-green-dark);
            color: #ffffff !important;
        }
        .btn-call-slot {
            background: #ffffff;
            border: 1px solid var(--border);
            color: var(--text-heading) !important;
            padding: 9px 12px;
            border-radius: var(--radius-pill);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-call-slot:hover {
            border-color: var(--hostel-blue);
            color: var(--hostel-blue) !important;
        }
        .btn-full-slot {
            flex: 1;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 9px 12px;
            border-radius: var(--radius-pill);
            border: 1px solid #e2e8f0;
            cursor: not-allowed;
            text-align: center;
        }
        .avail-modal-footer {
            padding: 14px 24px;
            background: #f8fafc;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .footer-help-text {
            font-size: 0.84rem;
            color: var(--text-muted);
        }
        .footer-btn-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        @media (max-width: 640px) {
            dialog.availability-modal {
                width: 95%;
                max-height: 92vh;
            }
            .avail-stats-bar {
                padding: 10px 16px;
            }
            .avail-modal-body {
                padding: 16px;
            }
            .rooms-slot-grid {
                grid-template-columns: 1fr;
            }
            .avail-modal-footer {
                padding: 12px 16px;
                flex-direction: column;
                align-items: stretch;
            }
            .footer-btn-group {
                justify-content: flex-end;
            }
        }

        /* FLOATING WHATSAPP BUTTON */
        .floating-wa-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99;
            background-color: var(--wa-green);
            color: #ffffff;
            padding: 12px 20px;
            border-radius: var(--radius-pill);
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 0.92rem;
            transition: all 0.24s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .floating-wa-btn:hover {
            background-color: var(--wa-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(37, 211, 102, 0.5);
            color: #ffffff;
        }

        /* LIGHTBOX POPUP */
        #lightbox {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        #lightbox img {
            max-width: 90%;
            max-height: 85%;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 1024px) {
            .featured-cards-grid {
                grid-template-columns: 1fr;
            }
            .everything-grid {
                grid-template-columns: 1fr;
            }
            .budget-grid {
                grid-template-columns: 1fr;
            }
            .contacts-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .bento-gallery-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
            }
            .gallery-item.tall {
                grid-row: span 1;
            }
            .ratings-strip-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .rating-col:nth-child(2) {
                border-right: none;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }
            .site-header {
                position: sticky;
                top: 0;
                z-index: 100;
            }
            .header-inner {
                height: 64px;
                gap: 8px;
            }
            .brand-link {
                gap: 10px;
                min-width: 0;
                flex: 1;
                margin-right: 6px;
            }
            .brand-logo-img {
                width: 38px;
                height: 38px;
                border-radius: 8px;
                flex-shrink: 0;
            }
            .brand-text {
                min-width: 0;
                overflow: hidden;
            }
            .brand-name {
                font-size: 1.05rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                display: flex;
                align-items: baseline;
                gap: 4px;
                line-height: 1.2;
            }
            .brand-sub {
                font-size: 0.65rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 170px;
                display: block;
                line-height: 1.2;
            }
            .header-actions {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-shrink: 0;
            }
            .header-actions .admin-link {
                display: none !important;
            }
            .header-actions .btn-sm {
                padding: 7px 13px;
                font-size: 0.82rem;
                font-weight: 700;
                white-space: nowrap;
                border-radius: var(--radius-pill);
            }
            .mobile-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--surface-muted);
                color: var(--text-heading);
                font-size: 20px;
                line-height: 1;
                cursor: pointer;
                padding: 0;
                flex-shrink: 0;
                transition: background 0.15s, border-color 0.15s;
            }
            .mobile-toggle:hover, .mobile-toggle:active {
                background: #e2e8f0;
            }
            .nav-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                padding: 14px 18px 20px;
                box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
                border-bottom: 1px solid var(--border);
                gap: 4px;
                z-index: 1000;
            }
            .nav-menu.is-open {
                display: flex !important;
                animation: navSlideDown 0.22s ease-out forwards;
            }
            @keyframes navSlideDown {
                from { opacity: 0; transform: translateY(-8px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .nav-menu li {
                width: 100%;
                list-style: none;
            }
            .nav-menu .nav-link {
                display: block;
                padding: 10px 14px;
                font-size: 0.98rem;
                font-weight: 600;
                color: var(--text-heading);
                border-radius: 8px;
                transition: all 0.15s ease;
            }
            .nav-menu .nav-link:hover, .nav-menu .nav-link.active {
                background: var(--hostel-blue-light);
                color: var(--hostel-blue);
            }
            .nav-menu .nav-link.active::after {
                display: none;
            }
            .mobile-staff-item {
                display: block !important;
                margin-top: 10px;
                padding-top: 12px;
                border-top: 1px solid var(--border);
            }
            .mobile-staff-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 10px 16px;
                border-radius: var(--radius-pill);
                background: var(--surface-muted);
                border: 1px solid var(--border);
                color: var(--text-heading);
                font-weight: 700;
                font-size: 0.92rem;
                text-align: center;
                transition: all 0.15s ease;
            }
            .mobile-staff-btn:hover {
                background: #e2e8f0;
            }
            .hero-section {
                padding: 32px 0 24px;
            }
            .hero-heading-wrap {
                margin-bottom: 24px;
            }
            .hero-title {
                font-size: 1.85rem;
                line-height: 1.25;
                letter-spacing: -0.02em;
            }
            .hero-subtitle {
                font-size: 0.95rem;
                line-height: 1.5;
                padding: 0 4px;
            }
            .everything-section,
            .budget-accom-section,
            .testimonials-section,
            .gallery-section,
            .news-section,
            .contacts-section {
                padding: 48px 0;
            }
            .everything-content h2,
            .budget-content h2,
            .contacts-content h2,
            .gallery-header-row h2,
            .section-header-center h2 {
                font-size: 1.75rem;
                line-height: 1.25;
            }
            .everything-grid,
            .budget-grid,
            .contacts-grid {
                gap: 32px;
            }
            .features-2x2-grid,
            .contacts-2x2-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .news-cards-grid {
                grid-template-columns: 1fr;
            }
            .testimonial-showcase-grid {
                grid-template-columns: 1fr;
                padding: 24px 20px;
            }
            .testimonial-photo-wrap {
                height: 260px;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .ratings-strip-grid {
                grid-template-columns: 1fr;
            }
            .rating-col {
                border-right: none;
                border-bottom: 1px solid var(--border-light);
            }
            .bento-gallery-grid {
                grid-template-columns: 1fr;
                grid-template-rows: auto;
            }
            .gallery-item {
                min-height: 220px;
                height: 220px;
            }
            .floating-wa-btn {
                bottom: 18px;
                right: 18px;
                padding: 10px 16px;
                font-size: 0.85rem;
                box-shadow: 0 6px 20px rgba(37, 211, 102, 0.45);
            }
        }

        @media (max-width: 480px) {
            .brand-sub {
                display: none;
            }
            .brand-name {
                font-size: 0.98rem;
            }
            .header-actions .btn-sm {
                padding: 6px 11px;
                font-size: 0.78rem;
            }
            .hero-title {
                font-size: 1.62rem;
            }
            .hero-subtitle {
                font-size: 0.88rem;
            }
            .promo-navy-card {
                padding: 24px 18px;
            }
            .promo-navy-card h2 {
                font-size: 1.55rem;
            }
            .floating-wa-btn {
                bottom: 14px;
                right: 14px;
                padding: 9px 13px;
                font-size: 0.8rem;
                gap: 6px;
            }
            .room-card-body {
                padding: 18px 16px;
            }
            dialog.booking-modal {
                width: 95%;
                max-height: 92vh;
                max-height: 92dvh;
                border-radius: var(--radius-lg);
            }
            .modal-header {
                padding: 16px 18px;
            }
            .modal-body {
                padding: 16px 18px 18px;
            }
        }
    </style>
</head>
<body>

    <!-- STICKY SITE HEADER -->
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ $settings->logo_path ? asset('storage/'.$settings->logo_path) : asset('images/logo.jpg') }}" alt="{{ $settings->name ?? 'SJ Ladies Hostel' }}" class="brand-logo-img">
                <div class="brand-text">
                    <span class="brand-name">
                        @php
                            $nameParts = explode(' ', $settings->name ?? 'SJ Ladies Hostel', 2);
                        @endphp
                        {{ $nameParts[0] }} <span>{{ $nameParts[1] ?? '' }}</span>
                    </span>
                    <span class="brand-sub">{{ $settings->tagline ?? 'Safe & Homely Stay · Kochi' }}</span>
                </div>
            </a>

            <nav>
                <ul class="nav-menu">
                    <li><a href="#home" class="nav-link active">Home</a></li>
                    <li><a href="#rooms" class="nav-link">Rooms</a></li>
                    <li><a href="#facilities" class="nav-link">Facilities</a></li>
                    <li><a href="#testimonials" class="nav-link">Reviews</a></li>
                    <li><a href="#gallery" class="nav-link">Photos</a></li>
                    <li><a href="#news" class="nav-link">Hostel Life</a></li>
                    <li><a href="#contacts" class="nav-link">Contacts</a></li>
                    <li class="mobile-staff-item">
                        <a href="{{ route('login') }}" class="mobile-staff-btn">🔐 Staff Login</a>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="{{ route('login') }}" class="admin-link">Staff Login</a>
                <button type="button" class="btn btn-primary btn-sm" onclick="openEnquiryModal('General Booking')">Book Now</button>
                <button type="button" class="mobile-toggle" onclick="toggleMobileMenu()" aria-label="Menu" aria-expanded="false">☰</button>
            </div>
        </div>
    </header>

    <!-- HERO & ROOM CARDS SECTION -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="hero-heading-wrap">
                <span class="hero-badge">{{ $settings->hero_badge ?? '✦ Welcome to Your New Home' }}</span>
                <h1 class="hero-title">{{ $settings->hero_title ?? 'Experience Safe, Clean & Homely Living' }}</h1>
                <p class="hero-subtitle">{{ $settings->hero_subtitle ?? 'Exclusively designed for female students and working professionals in Kochi. Attached bathrooms in all rooms, 3 fresh daily meals, and 24/7 security.' }}</p>
            </div>

            <!-- 3 FEATURED CARDS (DYNAMIC FROM BACKEND) -->
            <div class="featured-cards-grid" id="rooms">
                @if($websiteRooms->isNotEmpty())
                    @foreach($websiteRooms as $rItem)
                        <div class="room-card">
                            <div class="room-card-img-wrap">
                                <img src="{{ $rItem->image_url ?: 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=700&q=80' }}" alt="{{ $rItem->title }}" class="room-card-img">
                                <div class="price-badge">
                                    <strong>{{ $rItem->price_tag ?: ('₹' . number_format($rItem->rent_without_food ?: $rItem->monthly_rent)) }}</strong> / month
                                </div>
                            </div>
                            <div class="room-card-body">
                                <h3 class="room-card-title">{{ $rItem->title }}</h3>
                                <div class="room-meta-row">
                                    <span class="room-meta-item">🛏️ {{ $rItem->sleeps_text ?: ($rItem->sharing_type) }}</span>
                                    <span class="room-meta-item">🪜 {{ $rItem->bed_type_text ?: ('₹' . number_format($rItem->monthly_rent) . ' with food') }}</span>
                                </div>
                                <a href="javascript:void(0)" onclick="openAvailabilityModal('{{ $rItem->room_number ?: $rItem->title }}')" class="card-bottom-link">See availability →</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- DEFAULT ROOM 1 (Room A1, B1) -->
                    <div class="room-card">
                        <div class="room-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=700&q=80" alt="Bed in 6-Bed Room" class="room-card-img">
                            <div class="price-badge">
                                <strong>₹4,200</strong> / month
                            </div>
                        </div>
                        <div class="room-card-body">
                            <h3 class="room-card-title">Bed in Sharing Room (Room A1, B1) with Attached Bathroom</h3>
                            <div class="room-meta-row">
                                <span class="room-meta-item">🛏️ Rooms A1 & B1</span>
                                <span class="room-meta-item">₹4,200 / ₹6,500 with food</span>
                            </div>
                            <a href="javascript:void(0)" onclick="openAvailabilityModal('A1')" class="card-bottom-link">See availability →</a>
                        </div>
                    </div>

                    <!-- DEFAULT ROOM 2 (Room A3, B3) -->
                    <div class="room-card">
                        <div class="room-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=700&q=80" alt="Double Room" class="room-card-img">
                            <div class="price-badge">
                                <strong>₹8,600</strong> / month
                            </div>
                        </div>
                        <div class="room-card-body">
                            <h3 class="room-card-title">Double Room (Room A3, B3) with Attached Bathroom</h3>
                            <div class="room-meta-row">
                                <span class="room-meta-item">🛏️ 2 Sleeps</span>
                                <span class="room-meta-item">₹6,500 / ₹8,600 with food</span>
                            </div>
                            <a href="javascript:void(0)" onclick="openAvailabilityModal('A3')" class="card-bottom-link">See availability →</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: "WE HAVE EVERYTHING YOU NEED" (FACILITIES DYNAMIC FROM BACKEND) -->
    <section class="everything-section" id="facilities">
        <div class="container everything-grid">
            <div class="everything-content">
                <h2>We have everything you need</h2>
                <p class="everything-intro">Thoughtfully created facilities exclusively for female students and working professionals in Kochi. Live comfortably in a safe, hygienic, and peaceful atmosphere.</p>

                <div class="features-2x2-grid">
                    @if($facilities->isNotEmpty())
                        @foreach($facilities as $fac)
                            <div class="feature-item">
                                <div class="feature-icon-box">{{ $fac->icon }}</div>
                                <div class="feature-item-text">
                                    <h4>{{ $fac->title }}</h4>
                                    <p>{{ $fac->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="feature-item">
                            <div class="feature-icon-box">📶</div>
                            <div class="feature-item-text">
                                <h4>Free high speed WiFi</h4>
                                <p>High-speed fiber internet for uninterrupted work & online studies.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon-box">📍</div>
                            <div class="feature-item-text">
                                <h4>Convenient location in center</h4>
                                <p>Quick access to bus stands, metro, InfoPark & educational institutes.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon-box">🧳</div>
                            <div class="feature-item-text">
                                <h4>Free storage of luggage</h4>
                                <p>Spacious lockable wardrobes and dedicated safe luggage space.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon-box">🅿️</div>
                            <div class="feature-item-text">
                                <h4>Parking place allocated</h4>
                                <p>Dedicated secure two-wheeler and vehicle parking on the premises.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="everything-actions">
                    <button type="button" class="btn btn-dark" onclick="openEnquiryModal('Facility Booking')">Book now</button>
                    <a href="#rooms" class="more-about-link">More about rooms →</a>
                </div>
            </div>

            <div class="everything-media-wrap">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80" alt="Happy residents at {{ $settings->name }}" class="everything-media-img">
                <div class="media-floating-badge">
                    <div class="media-badge-icon">▶</div>
                    <div>
                        <div class="media-badge-title">{{ $settings->name ?? 'SJ Ladies Hostel' }} · Kochi</div>
                        <div class="media-badge-sub">24/7 Security & Homely Care</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: 4-COLUMN RATINGS & TRUST STRIP (DYNAMIC FROM BACKEND) -->
    <section class="ratings-strip-section">
        <div class="container ratings-strip-grid">
            <div class="rating-col">
                <div class="rating-score">{{ $settings->stat_1_val ?? '4.9 /5' }}</div>
                <div class="rating-notes">{{ $settings->stat_1_sub ?? '240+ verified ratings' }}</div>
                <div class="rating-brand-badge">{{ $settings->stat_1_label ?? 'Google Reviews' }}</div>
            </div>
            <div class="rating-col">
                <div class="rating-score">{{ $settings->stat_2_val ?? '100% Safe' }}</div>
                <div class="rating-notes">{{ $settings->stat_2_sub ?? 'Biometric & CCTV' }}</div>
                <div class="rating-brand-badge">{{ $settings->stat_2_label ?? '24/7 Protection' }}</div>
            </div>
            <div class="rating-col">
                <div class="rating-score">{{ $settings->stat_3_val ?? '3 Meals' }}</div>
                <div class="rating-notes">{{ $settings->stat_3_sub ?? 'Fresh & Homely daily' }}</div>
                <div class="rating-brand-badge">{{ $settings->stat_3_label ?? 'Hygienic Kitchen' }}</div>
            </div>
            <div class="rating-col">
                <div class="rating-score">{{ $settings->stat_4_val ?? '98% Rate' }}</div>
                <div class="rating-notes">{{ $settings->stat_4_sub ?? 'Resident satisfaction' }}</div>
                <div class="rating-brand-badge">{{ $settings->stat_4_label ?? 'Recommended' }}</div>
            </div>
        </div>
    </section>

    <!-- SECTION: "WHAT OUR GUESTS SAY" TESTIMONIALS (DYNAMIC FROM BACKEND) -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="section-header-center">
                <h2>What our guests say</h2>
                <p>Read authentic feedback from working women and students living at {{ $settings->name ?? 'SJ Ladies Hostel' }}.</p>
            </div>

            <div class="testimonial-showcase-grid">
                <div class="testimonial-photo-wrap">
                    <img id="testimonial-avatar" src="{{ $testimonials->first()?->avatar_url ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80' }}" alt="Resident Photo" class="testimonial-photo">
                </div>

                <div class="testimonial-content">
                    <div class="star-row" id="testimonial-stars">★★★★★</div>
                    <div class="stay-date-tag" id="testimonial-date">{{ $testimonials->first()?->stay_date ?: 'Date of stay: October 2026' }}</div>
                    <h3 class="testimonial-quote-title" id="testimonial-headline">{{ $testimonials->first()?->headline ?: 'Very cozy room close to everything, feels just like home!' }}</h3>
                    <p class="testimonial-quote-body" id="testimonial-text">"{{ $testimonials->first()?->quote ?: 'SJ Ladies Hostel is truly a home away from home. The food is hygienic and delicious, attached bathrooms in every room make morning routines effortless, and the warden takes care of everyone like family.' }}"</p>

                    <div class="testimonial-author-row">
                        <div class="author-info">
                            <h4 id="testimonial-name">{{ $testimonials->first()?->name ?: 'Lisa Adams' }}</h4>
                            <p id="testimonial-role">{{ $testimonials->first()?->role ?: 'Software Engineer, Kakkanad' }}</p>
                        </div>

                        <div class="testimonial-nav-arrows">
                            <button type="button" class="nav-arrow-btn" onclick="prevTestimonial()" aria-label="Previous">←</button>
                            <button type="button" class="nav-arrow-btn" onclick="nextTestimonial()" aria-label="Next">→</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: "FIND SUITABLE BUDGET ACCOMMODATION" -->
    <section class="budget-accom-section">
        <div class="container budget-grid">
            <div class="budget-content">
                <h2>Find suitable budget accommodation</h2>
                <p class="budget-intro">We offer flexible sharing options crafted to balance personal comfort, social atmosphere, and affordability.</p>

                <div class="budget-features-stack">
                    <div class="budget-feature-card">
                        <div class="budget-card-icon">🏢</div>
                        <div class="budget-card-text">
                            <h4>Hostel territory & 24/7 Security</h4>
                            <p>Secure gated compound, CCTV cameras, dedicated female warden on site.</p>
                        </div>
                    </div>

                    <div class="budget-feature-card">
                        <div class="budget-card-icon">🛏️</div>
                        <div class="budget-card-text">
                            <h4>Accommodates guests with full comfort</h4>
                            <p>Good ventilation, lockable cupboards, and attached bathrooms in 100% of rooms.</p>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="openAvailabilityModal('all')">Check Room Availability →</button>
            </div>

            <div class="showcase-room-card">
                <div class="floating-review-callout">
                    <p>“This is the perfect hostel for a peaceful stay!”</p>
                    <div style="color:var(--star-gold);font-size:13px">★★★★★ · Esmond Word</div>
                </div>

                <img src="https://images.unsplash.com/photo-1540518614846-7ede433c4550?auto=format&fit=crop&w=800&q=80" alt="Hostel Accommodation" style="width:100%;height:380px;object-fit:cover">
                <div style="padding:22px">
                    <div style="display:flex;align-items:center;justify-content:space-between">
                        <div>
                            <h3 style="font-size:1.2rem;font-weight:700">Four Sharing Room with Attached Bathroom</h3>
                            <p style="color:var(--text-muted);font-size:0.88rem">Ground & First Floor · TOP and DOWN beds available</p>
                        </div>
                        <div style="text-align:right">
                            <strong style="font-size:1.3rem;color:var(--text-heading)">₹6,500</strong>
                            <small style="display:block;color:var(--text-muted)">/ month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: "PHOTOS OF OUR ROOMS" BENTO GALLERY (DYNAMIC FROM BACKEND) -->
    <section class="gallery-section" id="gallery">
        <div class="container">
            <div class="gallery-header-row">
                <h2>Photos of our rooms</h2>
                <button type="button" class="btn btn-outline" onclick="openLightbox('{{ $gallery->first()?->image_url ?: asset('images/building.jpg') }}')">View all photos</button>
            </div>

            <div class="bento-gallery-grid">
                @if($gallery->isNotEmpty())
                    @foreach($gallery as $gItem)
                        <div class="gallery-item {{ $gItem->is_tall ? 'tall' : '' }}" onclick="openLightbox('{{ $gItem->image_url }}')">
                            <img src="{{ $gItem->image_url }}" alt="{{ $gItem->title }}" class="gallery-img">
                            <div class="gallery-overlay-icon">⛶</div>
                            <div class="gallery-caption">{{ $gItem->title }}</div>
                        </div>
                    @endforeach
                @else
                    <!-- DEFAULT BENTO GRID -->
                    <div class="gallery-item tall" onclick="openLightbox('{{ asset('images/building.jpg') }}')">
                        <img src="{{ asset('images/building.jpg') }}" alt="Hostel Building" class="gallery-img">
                        <div class="gallery-overlay-icon">⛶</div>
                        <div class="gallery-caption">Secure Building Exterior & Entrance</div>
                    </div>
                    <div class="gallery-item" onclick="openLightbox('{{ asset('images/hall.jpg') }}')">
                        <img src="{{ asset('images/hall.jpg') }}" alt="Spacious Room" class="gallery-img">
                        <div class="gallery-overlay-icon">⛶</div>
                        <div class="gallery-caption">Cozy Bedroom with Attached Bath</div>
                    </div>
                    <div class="gallery-item" onclick="openLightbox('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=700&q=80')">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=700&q=80" alt="Modern Room Setup" class="gallery-img">
                        <div class="gallery-overlay-icon">⛶</div>
                        <div class="gallery-caption">Comfortable Interior & Wardrobes</div>
                    </div>
                    <div class="gallery-item" onclick="openLightbox('{{ asset('images/kitchen.jpg') }}')">
                        <img src="{{ asset('images/kitchen.jpg') }}" alt="Hygienic Dining" class="gallery-img">
                        <div class="gallery-overlay-icon">⛶</div>
                        <div class="gallery-caption">Hygienic Dining & Kitchen Area</div>
                    </div>
                    <div class="gallery-item" onclick="openLightbox('https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=700&q=80')">
                        <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=700&q=80" alt="Clean Beds" class="gallery-img">
                        <div class="gallery-overlay-icon">⛶</div>
                        <div class="gallery-caption">Naturally Ventilated Bedrooms</div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: "HOSTELLER NEWS" / HOSTEL LIFE (DYNAMIC FROM BACKEND) -->
    <section class="news-section" id="news">
        <div class="container">
            <div class="news-header-row">
                <h2>Hostel Life & Updates</h2>
                <a href="#contacts" class="btn btn-outline">Ask Questions</a>
            </div>

            <div class="news-cards-grid">
                @if($updates->isNotEmpty())
                    @foreach($updates as $uItem)
                        <div class="news-card">
                            <div class="news-card-img-wrap">
                                <img src="{{ $uItem->image_url ?: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80' }}" alt="{{ $uItem->title }}" class="news-card-img">
                                <span class="news-category-tag">{{ $uItem->category }}</span>
                            </div>
                            <div class="news-card-body">
                                <h3 class="news-card-title">{{ $uItem->title }}</h3>
                                <p class="news-card-excerpt">{{ $uItem->excerpt }}</p>
                                <div class="news-card-footer">
                                    <span>{{ $uItem->date_text ?: 'November 2026' }}</span>
                                    <span>👁️ {{ $uItem->views_count }} views</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="news-card">
                        <div class="news-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80" alt="Homely Food" class="news-card-img">
                            <span class="news-category-tag">Food & Health</span>
                        </div>
                        <div class="news-card-body">
                            <h3 class="news-card-title">Fresh Kerala meals prepared with pure hygiene every single day</h3>
                            <p class="news-card-excerpt">Enjoy wholesome breakfast, packed lunch for work/college, hot evening tea with snacks, and light delicious dinner.</p>
                            <div class="news-card-footer">
                                <span>November 2026</span>
                                <span>👁️ 180 views</span>
                            </div>
                        </div>
                    </div>
                    <div class="news-card">
                        <div class="news-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=700&q=80" alt="Study Atmosphere" class="news-card-img">
                            <span class="news-category-tag">Community</span>
                        </div>
                        <div class="news-card-body">
                            <h3 class="news-card-title">A quiet, focused study and work atmosphere for women</h3>
                            <p class="news-card-excerpt">Designed for exam preparation, remote IT work, and peaceful relaxation without noisy interruptions.</p>
                            <div class="news-card-footer">
                                <span>November 2026</span>
                                <span>👁️ 240 views</span>
                            </div>
                        </div>
                    </div>
                    <div class="news-card">
                        <div class="news-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=700&q=80" alt="Safe Living" class="news-card-img">
                            <span class="news-category-tag">Security</span>
                        </div>
                        <div class="news-card-body">
                            <h3 class="news-card-title">24/7 CCTV surveillance and verified biometric safety</h3>
                            <p class="news-card-excerpt">Continuous safety monitoring, power backup, caring residential warden, and strict visitor verification.</p>
                            <div class="news-card-footer">
                                <span>November 2026</span>
                                <span>👁️ 310 views</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: "CONTACTS" & LOCATION (DYNAMIC FROM BACKEND) -->
    <section class="contacts-section" id="contacts">
        <div class="container contacts-grid">
            <div class="contacts-content">
                <h2>Contacts</h2>
                <p class="contacts-intro">Have questions regarding room availability, admission requirements, or visiting hours? We'd love to help you.</p>

                <div class="contacts-2x2-grid">
                    <div class="contact-box">
                        <div class="contact-icon-box">📞</div>
                        <div class="contact-box-text">
                            <h4>Phone</h4>
                            <p><a href="tel:{{ $settings->phone ?? '8590621496' }}">+91 {{ $settings->phone ?? '8590621496' }}</a></p>
                            @if(!empty($settings->alternate_phone))
                                <p><a href="tel:{{ $settings->alternate_phone }}">+91 {{ $settings->alternate_phone }}</a></p>
                            @endif
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="contact-icon-box">✉️</div>
                        <div class="contact-box-text">
                            <h4>Email</h4>
                            <p><a href="mailto:{{ $settings->email ?? 'sjladieshostel07@gmail.com' }}">{{ $settings->email ?? 'sjladieshostel07@gmail.com' }}</a></p>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="contact-icon-box">📍</div>
                        <div class="contact-box-text">
                            <h4>Location</h4>
                            <p>{{ $settings->address ?? 'SJ Ladies Hostel, Ernakulam / Kochi, Kerala' }}</p>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="contact-icon-box">🕒</div>
                        <div class="contact-box-text">
                            <h4>Visiting Hours</h4>
                            <p>{{ $settings->visiting_hours ?? 'Everyday 6:00 AM – 9:30 PM' }}</p>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="openEnquiryModal('Contact Section')">Send an Enquiry →</button>
            </div>

            <!-- GOOGLE MAPS EMBED (DYNAMIC FROM BACKEND) -->
            <div class="map-card-wrap">
                <iframe src="{{ $settings->map_embed_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125745.74838687728!2d76.22329841838634!3d9.98234281358327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d514abec6bf%3A0xbd582caa5844192!2sKochi%2C%20Kerala!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin' }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="{{ $settings->name }} Location Map"></iframe>
            </div>
        </div>
    </section>

    <!-- FOOTER (DYNAMIC FROM BACKEND) -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- COL 1: BRAND -->
                <div class="footer-brand">
                    <h3>
                        {{ $nameParts[0] }} <span>{{ $nameParts[1] ?? '' }}</span>
                    </h3>
                    <p>{{ $settings->notes ?? 'A welcoming, clean, and secure haven for female students and working professionals in Kochi. Complete with delicious home-cooked meals and modern amenities.' }}</p>
                    <div class="footer-social-row">
                        <a href="https://wa.me/91{{ preg_replace('/[^0-9]/','',$settings->whatsapp_number ?? $settings->phone ?? '8590621496') }}" class="social-circle-link" title="WhatsApp" target="_blank" rel="noopener noreferrer">💬</a>
                        @if(!empty($settings->instagram_url))
                            <a href="{{ $settings->instagram_url }}" class="social-circle-link" title="Instagram" target="_blank" rel="noopener noreferrer">📷</a>
                        @endif
                        @if(!empty($settings->facebook_url))
                            <a href="{{ $settings->facebook_url }}" class="social-circle-link" title="Facebook" target="_blank" rel="noopener noreferrer">📘</a>
                        @endif
                        <a href="#contacts" class="social-circle-link" title="Directions">📍</a>
                    </div>
                </div>

                <!-- COL 2: QUICK LINKS -->
                <div class="footer-col">
                    <h4>Quick links</h4>
                    <ul class="footer-links-list">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#rooms">Rooms & Rates</a></li>
                        <li><a href="#facilities">Facilities</a></li>
                        <li><a href="#gallery">Photos</a></li>
                        <li><a href="#news">Hostel Life</a></li>
                    </ul>
                </div>

                <!-- COL 3: CONTACT US -->
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <div class="footer-contact-info">
                        <p>{{ $settings->address ?? 'SJ Ladies Hostel, Kochi, Kerala' }}</p>
                        <p><strong>Phone:</strong> <a href="tel:{{ $settings->phone ?? '8590621496' }}">+91 {{ $settings->phone ?? '8590621496' }}</a></p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $settings->email ?? 'sjladieshostel07@gmail.com' }}">{{ $settings->email ?? 'sjladieshostel07@gmail.com' }}</a></p>
                    </div>
                </div>

                <!-- COL 4: FOLLOW US & ADMIN -->
                <div class="footer-col">
                    <h4>Portal Access</h4>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('login') }}">Staff & Warden Login →</a></li>
                        <li><a href="javascript:void(0)" onclick="openAvailabilityModal('all')">Check Bed Vacancy</a></li>
                        <li><a href="#facilities">View Amenities</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <div>© {{ date('Y') }} {{ $settings->name ?? 'SJ Ladies Hostel' }}. All rights reserved.</div>
                <div>Designed with safety & comfort in Kochi, Kerala.</div>
            </div>
        </div>
    </footer>

    <!-- FLOATING WHATSAPP CTA -->
    <a href="https://wa.me/91{{ preg_replace('/[^0-9]/','',$settings->whatsapp_number ?? $settings->phone ?? '8590621496') }}?text={{ rawurlencode('Hello ' . ($settings->name ?? 'SJ Ladies Hostel') . '! I would like to enquire about room availability and rates.') }}" target="_blank" rel="noopener noreferrer" class="floating-wa-btn" title="Chat on WhatsApp">
        <span style="font-size:18px">💬</span>
        <span>WhatsApp Us</span>
    </a>

    <!-- REAL-TIME ROOM & BED AVAILABILITY MODAL -->
    <dialog id="availabilityModal" class="availability-modal">
        <div class="modal-header">
            <div>
                <div style="font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#93c5fd;margin-bottom:2px">Live Room Vacancy</div>
                <h3 id="availModalTitle" style="color:#ffffff;font-size:1.25rem;font-weight:800;margin:0">Available Room & Bed Slots</h3>
            </div>
            <button type="button" class="modal-close-btn" onclick="document.getElementById('availabilityModal').close()" aria-label="Close">&times;</button>
        </div>

        <div class="avail-stats-bar">
            <div class="avail-stat-badge">
                <span>🟢</span>
                <strong>{{ $availableBeds }} Vacant Beds</strong> Available
            </div>
            <div class="avail-tabs" id="availTabs">
                <button type="button" class="avail-tab-btn active" onclick="filterAvailability('all', this)">All Rooms</button>
                @foreach($floors as $fl)
                    <button type="button" class="avail-tab-btn" onclick="filterAvailability('floor-{{ $fl->id }}', this)">{{ $fl->name }}</button>
                @endforeach
                <button type="button" class="avail-tab-btn" onclick="filterAvailability('vacant-only', this)">Vacant Only</button>
            </div>
        </div>

        <div class="avail-modal-body">
            @php
                $rawPhone = $settings->whatsapp_number ?: ($settings->phone ?: '8590621496');
                $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
                if (strlen($cleanPhone) === 10) { $cleanPhone = '91' . $cleanPhone; }
            @endphp

            @forelse($floors as $floor)
                <div class="floor-group" data-floor="floor-{{ $floor->id }}">
                    <div class="floor-group-header">
                        <span class="floor-badge">🏢 {{ $floor->name }}</span>
                        <span class="floor-stats">{{ $floor->rooms->sum(fn($r) => $r->available) }} of {{ $floor->rooms->sum('capacity') }} beds vacant</span>
                    </div>

                    <div class="rooms-slot-grid">
                        @foreach($floor->rooms as $room)
                            @php
                                $isVacant = $room->available > 0;
                            @endphp
                            <div class="room-slot-card {{ $isVacant ? 'has-vacancy' : 'is-full' }}" 
                                 data-room-number="{{ strtolower($room->number) }}"
                                 data-floor="floor-{{ $floor->id }}"
                                 data-vacant="{{ $isVacant ? '1' : '0' }}">
                                
                                <div class="room-slot-header">
                                    <div>
                                        <div class="room-slot-number">Room {{ $room->number }}</div>
                                        <div class="room-slot-type">{{ $room->sharing_label ?? ($room->capacity . ' Sharing') }} · {{ $floor->name }}</div>
                                    </div>
                                    <div>
                                        @if($isVacant)
                                            <span class="slot-pill vacant">🟢 {{ $room->available }} Bed{{ $room->available > 1 ? 's' : '' }} Vacant</span>
                                        @else
                                            <span class="slot-pill full">🔴 Fully Booked</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="room-slot-pricing">
                                    <div>Without Food: <strong>₹{{ number_format($room->rent_without_food ?? 4200) }}</strong> / mo</div>
                                    <div>With Food: <strong>₹{{ number_format($room->monthly_rent) }}</strong> / mo (3 meals daily)</div>
                                </div>

                                <div class="beds-slot-list">
                                    <div class="beds-list-label">Bed Slots in this room:</div>
                                    <div class="beds-pill-grid">
                                        @foreach($room->beds as $bed)
                                            @php $bAvail = ($bed->effective_status === 'available'); @endphp
                                            <div class="bed-slot-chip {{ $bAvail ? 'available' : 'occupied' }}">
                                                <span class="bed-chip-icon">🛏️</span>
                                                <span class="bed-chip-name">Bed {{ $bed->name }}</span>
                                                @if($bed->tier)
                                                    <span class="bed-chip-tier {{ strtolower($bed->tier) }}">{{ $bed->tier }}</span>
                                                @endif
                                                <span class="bed-chip-status">{{ $bAvail ? 'Vacant' : 'Booked' }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="room-slot-actions">
                                    @if($isVacant)
                                        @php
                                            $waText = "Hello " . ($settings->name ?? 'SJ Ladies Hostel') . ", I saw that Room " . $room->number . " (" . $floor->name . ", " . ($room->sharing_label ?? ($room->capacity . ' Sharing')) . ") has vacant beds available. I would like to book a bed.";
                                            $waLink = "https://wa.me/" . $cleanPhone . "?text=" . rawurlencode($waText);
                                        @endphp
                                        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-whatsapp-slot">
                                            <span>💬</span> Book on WhatsApp
                                        </a>
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone ?? '8590621496') }}" class="btn-call-slot" title="Call Hostel">
                                            📞 Call
                                        </a>
                                    @else
                                        <div class="btn-full-slot">
                                            Fully Occupied (0 Vacancies)
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p style="text-align:center;color:var(--text-muted);padding:30px 0;">No room details available at the moment.</p>
            @endforelse
        </div>

        <div class="avail-modal-footer">
            <div class="footer-help-text">
                Want to book a visit or have special requirements?
            </div>
            <div class="footer-btn-group">
                <button type="button" class="btn btn-outline btn-sm" onclick="document.getElementById('availabilityModal').close()">Close</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('availabilityModal').close(); openEnquiryModal('General Booking');">Fill Enquiry Form →</button>
            </div>
        </div>
    </dialog>

    <!-- BOOKING ENQUIRY MODAL DIALOG -->
    <dialog id="enquiryModal" class="booking-modal">
        <div class="modal-header">
            <h3 id="modalRoomTitle">Book / Enquire Room</h3>
            <button type="button" class="modal-close-btn" onclick="document.getElementById('enquiryModal').close()">&times;</button>
        </div>
        <form action="{{ route('enquiry.store') }}" method="post" class="modal-body">
            @csrf
            <input type="hidden" name="room_number" id="enquiry_room_number" value="">
            <div class="form-group">
                <label for="enquiry_name">Full Name *</label>
                <input type="text" name="name" id="enquiry_name" class="form-control" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="enquiry_phone">Mobile Number *</label>
                <input type="tel" name="phone" id="enquiry_phone" class="form-control" required placeholder="10-digit mobile number">
            </div>

            <div class="form-group">
                <label for="enquiry_sharing">Room Sharing Preference</label>
                <select name="sharing_type" id="enquiry_sharing" class="form-control">
                    <option value="Two Sharing">Two Sharing (₹6,500 / ₹8,600)</option>
                    <option value="Four Sharing" selected>Four Sharing (₹4,200 / ₹6,500)</option>
                    <option value="Five Sharing">Five Sharing (₹4,200 / ₹6,500)</option>
                    <option value="Six Sharing">Six Sharing (₹4,200 / ₹6,500)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="enquiry_food">Food Plan</label>
                <select name="food_preference" id="enquiry_food" class="form-control">
                    <option value="with_food" selected>With Food (3 Homely Meals Daily)</option>
                    <option value="without_food">Without Food</option>
                </select>
            </div>

            <div class="form-group">
                <label for="enquiry_date">Expected Joining Date</label>
                <input type="date" name="joining_date" id="enquiry_date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="enquiry_notes">Additional Requests / Notes</label>
                <textarea name="notes" id="enquiry_notes" class="form-control" rows="2" placeholder="Any specific requirements (TOP/DOWN bed, study desk, etc.)"></textarea>
            </div>

            <div class="modal-form-actions">
                <button type="button" class="btn btn-outline" style="flex:1" onclick="document.getElementById('enquiryModal').close()">Cancel</button>
                <button type="submit" class="btn btn-primary" style="flex:1.4; background:#25d366; border-color:#25d366; color:#fff; display:inline-flex; align-items:center; justify-content:center; gap:8px;">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12.012 2C6.486 2 2 6.486 2 12.012c0 1.956.565 3.784 1.542 5.337L2 22l4.821-1.49c1.493.882 3.23 1.39 5.091 1.39 5.526 0 10.012-4.486 10.012-10.012C21.924 6.486 17.438 2 12.012 2z"/></svg>
                    <span>Send on WhatsApp</span>
                </button>
            </div>
            <p style="margin: 8px 0 0; font-size: 11.5px; color: #64748b; text-align: center;">
                Enquiry will be saved & redirected to WhatsApp to confirm directly with our warden.
            </p>
        </form>
    </dialog>

    <!-- LIGHTBOX MODAL -->
    <div id="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img" src="" alt="Enlarged Photo">
    </div>

    <!-- JAVASCRIPT FOR TESTIMONIAL SLIDER & MODAL -->
    <script>
        // Testimonials data passed dynamically from backend
        const dynamicTestimonials = @json($testimonials);
        const defaultTestimonials = [
            {
                name: "Lisa Adams",
                role: "Software Engineer, Kakkanad",
                stay_date: "Date of stay: October 2026",
                headline: "Very cozy room close to everything, feels just like home!",
                quote: "SJ Ladies Hostel is truly a home away from home. The food is hygienic and delicious, attached bathrooms in every room make morning routines effortless, and the warden takes care of everyone like family. Highly recommended for any woman in Kochi!",
                avatar_url: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80",
                rating: 5
            },
            {
                name: "Betty Randal",
                role: "Postgraduate Student, Rajagiri",
                stay_date: "Date of stay: September 2026",
                headline: "Extremely safe with wonderful food and calm study environment",
                quote: "Being a student, having a quiet atmosphere and high-speed Wi-Fi was essential. The roommates are friendly, the security is strict, and the homely food saves so much time every day. 10/10 stay!",
                avatar_url: "https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=700&q=80",
                rating: 5
            },
            {
                name: "Dr. Gopika Krishnan",
                role: "Healthcare Professional",
                stay_date: "Date of stay: August 2026",
                headline: "Clean attached bathrooms, 24/7 hot water, and flexible rules",
                quote: "Hospital shift duties can be demanding, but SJ Ladies Hostel has been the most comfortable accommodation I have found in Kochi. Clean rooms, supportive staff, and peaceful nights.",
                avatar_url: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=700&q=80",
                rating: 5
            }
        ];

        const testimonials = (dynamicTestimonials && dynamicTestimonials.length > 0) ? dynamicTestimonials : defaultTestimonials;
        let currentTestimonialIdx = 0;

        function updateTestimonial(idx) {
            const t = testimonials[idx];
            if (!t) return;
            document.getElementById('testimonial-avatar').src = t.avatar_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80';
            document.getElementById('testimonial-name').textContent = t.name;
            document.getElementById('testimonial-role').textContent = t.role || '';
            document.getElementById('testimonial-date').textContent = t.stay_date || '';
            document.getElementById('testimonial-headline').textContent = t.headline || '';
            document.getElementById('testimonial-text').textContent = `"${t.quote || ''}"`;
            document.getElementById('testimonial-stars').textContent = '★'.repeat(t.rating || 5);
        }

        function nextTestimonial() {
            currentTestimonialIdx = (currentTestimonialIdx + 1) % testimonials.length;
            updateTestimonial(currentTestimonialIdx);
        }

        function prevTestimonial() {
            currentTestimonialIdx = (currentTestimonialIdx - 1 + testimonials.length) % testimonials.length;
            updateTestimonial(currentTestimonialIdx);
        }

        // Live Room Availability & Vacancy Modal
        function openAvailabilityModal(filterTarget) {
            const modal = document.getElementById('availabilityModal');
            if (!modal) return;

            const allRooms = modal.querySelectorAll('.room-slot-card');
            allRooms.forEach(function(card) {
                card.style.display = 'flex';
                card.classList.remove('highlighted-room');
            });

            const allFloors = modal.querySelectorAll('.floor-group');
            allFloors.forEach(function(f) { f.style.display = 'block'; });

            const tabs = modal.querySelectorAll('.avail-tab-btn');
            tabs.forEach(function(t) { t.classList.remove('active'); });
            if (tabs[0]) tabs[0].classList.add('active');

            if (filterTarget && filterTarget !== 'all' && filterTarget !== 'Budget Accommodation Enquiry') {
                const match = filterTarget.match(/[AB][1-9]/i);
                const targetNum = match ? match[0].toLowerCase() : filterTarget.toLowerCase();

                let found = false;
                allRooms.forEach(function(card) {
                    const rNum = (card.getAttribute('data-room-number') || '').toLowerCase();
                    if (rNum === targetNum || targetNum.includes(rNum)) {
                        card.classList.add('highlighted-room');
                        found = true;
                    }
                });

                if (found) {
                    document.getElementById('availModalTitle').textContent = `Room ${targetNum.toUpperCase()} & Vacant Bed Slots`;
                } else {
                    document.getElementById('availModalTitle').textContent = `Available Room & Bed Slots`;
                }
            } else {
                document.getElementById('availModalTitle').textContent = `Available Room & Bed Slots`;
            }

            modal.showModal();

            const highlighted = modal.querySelector('.highlighted-room');
            if (highlighted) {
                setTimeout(function() {
                    highlighted.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 150);
            }
        }

        function filterAvailability(type, btn) {
            const modal = document.getElementById('availabilityModal');
            if (!modal) return;

            const tabs = modal.querySelectorAll('.avail-tab-btn');
            tabs.forEach(function(t) { t.classList.remove('active'); });
            if (btn) btn.classList.add('active');

            const allRooms = modal.querySelectorAll('.room-slot-card');
            const allFloors = modal.querySelectorAll('.floor-group');

            allFloors.forEach(function(f) { f.style.display = 'block'; });

            if (type === 'all') {
                allRooms.forEach(function(r) { r.style.display = 'flex'; });
            } else if (type === 'vacant-only') {
                allRooms.forEach(function(r) {
                    r.style.display = r.getAttribute('data-vacant') === '1' ? 'flex' : 'none';
                });
            } else if (type.startsWith('floor-')) {
                allFloors.forEach(function(f) {
                    if (f.getAttribute('data-floor') === type) {
                        f.style.display = 'block';
                        f.querySelectorAll('.room-slot-card').forEach(function(r) { r.style.display = 'flex'; });
                    } else {
                        f.style.display = 'none';
                    }
                });
            }
        }

        // Enquiry Modal
        function openEnquiryModal(roomPreference, roomNum) {
            const modal = document.getElementById('enquiryModal');
            const roomInput = document.getElementById('enquiry_room_number');
            if (roomInput) roomInput.value = roomNum || '';
            if (roomPreference) {
                document.getElementById('modalRoomTitle').textContent = `Enquire: ${roomPreference}`;
                if (roomPreference.includes('2-Sharing') || roomPreference.includes('Double')) {
                    document.getElementById('enquiry_sharing').value = 'Two Sharing';
                } else if (roomPreference.includes('6-Sharing')) {
                    document.getElementById('enquiry_sharing').value = 'Six Sharing';
                } else if (roomPreference.includes('5-Sharing')) {
                    document.getElementById('enquiry_sharing').value = 'Five Sharing';
                } else if (roomPreference.includes('4-Sharing')) {
                    document.getElementById('enquiry_sharing').value = 'Four Sharing';
                }
            }
            modal.showModal();
        }

        // Lightbox
        function openLightbox(src) {
            const lb = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lb.style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        function toggleMobileMenu() {
            const nav = document.querySelector('.nav-menu');
            const btn = document.querySelector('.mobile-toggle');
            if (!nav || !btn) return;
            const isOpen = nav.classList.toggle('is-open');
            btn.innerHTML = isOpen ? '&times;' : '☰';
            btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.nav-menu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    const nav = document.querySelector('.nav-menu');
                    const btn = document.querySelector('.mobile-toggle');
                    if (nav && nav.classList.contains('is-open')) {
                        nav.classList.remove('is-open');
                        if (btn) {
                            btn.innerHTML = '☰';
                            btn.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            });
        });
    </script>

    @if (session('success'))
        <div id="toastSuccess" style="position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); z-index: 99999; background: #0b2545; color: #ffffff; padding: 12px 20px; border-radius: 12px; box-shadow: 0 12px 30px rgba(0,0,0,0.25); display: flex; align-items: center; gap: 14px; max-width: 92vw; font-size: 13.5px;">
            <span>✓ {{ session('success') }}</span>
            @if (session('whatsapp_url'))
                <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener noreferrer" style="background: #25d366; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 13px; white-space: nowrap; display: inline-flex; align-items: center; gap: 4px;">
                    Open WhatsApp 💬
                </a>
            @endif
            <button type="button" onclick="document.getElementById('toastSuccess').remove()" style="background:none; border:none; color:#94a3b8; font-size:18px; cursor:pointer; line-height:1; margin-left:4px;">&times;</button>
        </div>
    @endif
</body>
</html>
