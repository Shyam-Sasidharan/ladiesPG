<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SJ Ladies Hostel · Safe, Comfortable & Homely Stay for Women</title>
    <meta name="description" content="SJ Ladies Hostel offers safe, premium, and homely accommodation for students and working women in Kochi. Attached bathrooms in all rooms, 3 daily home-cooked meals, Wi-Fi, and 24/7 security.">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* SJ Logo Theme Colors */
            --sj-pine: #133e2b;          /* Deep Pine Green from "S" & "LADIES" */
            --sj-pine-hover: #0d2c1e;
            --sj-pine-light: #ecf5f0;    /* Soft pine mint */
            --sj-pine-border: #c8dfd3;

            --sj-rose: #d45b73;          /* Dusty Rose Pink from "J" & "HOSTEL" */
            --sj-rose-hover: #be4a61;
            --sj-rose-light: #fdf2f4;    /* Soft blush rose */
            --sj-rose-border: #f8c9d3;

            --wa-green: #25d366;
            --wa-hover: #1ebd5a;

            --bg: #fafcfb;
            --surface: #ffffff;

            --text-heading: #0e2017;
            --text-body: #2e3e35;
            --text-muted: #62776c;

            --border: #e2ede7;
            --border-light: #eff5f2;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 18px;
            --radius-xl: 24px;
            --radius-pill: 9999px;

            --shadow-xs: 0 1px 2px rgba(19, 62, 43, 0.04);
            --shadow-sm: 0 2px 8px -2px rgba(19, 62, 43, 0.06);
            --shadow-md: 0 10px 24px -4px rgba(19, 62, 43, 0.08);
            --shadow-lg: 0 18px 38px -6px rgba(19, 62, 43, 0.12);
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
            background-color: var(--bg);
            color: var(--text-body);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 {
            color: var(--text-heading);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.03em;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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

        /* Top Bar */
        .top-bar {
            background: #0f271c;
            color: #d6e4dc;
            font-size: 12.5px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(212, 91, 115, 0.2);
        }
        .top-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .top-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #bbf7d0;
            font-size: 12px;
        }
        .live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
        .top-contacts {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .top-contacts a {
            color: #d6e4dc;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .top-contacts a:hover {
            color: #ffffff;
        }
        .top-login a {
            color: #fce7eb;
            font-weight: 600;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 6px;
            background: rgba(212, 91, 115, 0.2);
            border: 1px solid rgba(212, 91, 115, 0.35);
        }
        .top-login a:hover {
            background: rgba(212, 91, 115, 0.35);
            color: #ffffff;
        }

        /* Modern Sticky Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 78px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }
        .brand-logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: var(--shadow-sm);
            border: 1.5px solid var(--border);
            padding: 2px;
            flex-shrink: 0;
            transition: transform 0.2s;
        }
        .brand:hover .brand-logo {
            transform: scale(1.03);
            border-color: var(--sj-rose-border);
        }
        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .brand-text h1 {
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--sj-pine);
            line-height: 1.15;
        }
        .brand-text h1 span {
            color: var(--sj-rose);
        }
        .brand-text p {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--sj-rose);
            letter-spacing: 0.01em;
            margin-top: 1px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 26px;
            list-style: none;
        }
        .nav-menu a {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-body);
            position: relative;
            padding: 6px 0;
        }
        .nav-menu a:hover {
            color: var(--sj-pine);
        }
        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--sj-pine), var(--sj-rose));
            transition: width 0.25s ease;
            border-radius: 2px;
        }
        .nav-menu a:hover::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }
        .btn-pine {
            background: var(--sj-pine);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(19, 62, 43, 0.22);
        }
        .btn-pine:hover {
            background: var(--sj-pine-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(19, 62, 43, 0.32);
            color: #ffffff;
        }
        .btn-rose-outline {
            background: #ffffff;
            border-color: var(--sj-rose-border);
            color: var(--sj-rose-dark);
            box-shadow: var(--shadow-xs);
        }
        .btn-rose-outline:hover {
            background: var(--sj-rose-light);
            border-color: var(--sj-rose);
            color: var(--sj-rose-dark);
            transform: translateY(-1px);
        }
        .btn-wa {
            background: #25d366;
            color: #ffffff !important;
            border-color: #1ebd5a;
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.32);
        }
        .btn-wa:hover {
            background: #1ebd5a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.45);
        }
        .btn-outline {
            background: #ffffff;
            border-color: var(--border);
            color: var(--text-heading);
            box-shadow: var(--shadow-xs);
        }
        .btn-outline:hover {
            background: var(--sj-pine-light);
            border-color: var(--sj-pine-border);
            color: var(--sj-pine);
            transform: translateY(-1px);
        }
        .btn-sm {
            padding: 8px 14px;
            font-size: 12.5px;
            border-radius: var(--radius-sm);
        }
        .btn-block {
            width: 100%;
        }

        /* Hero Section (Minimal, Punchy & High-Impact) */
        .hero {
            padding: 50px 0 55px;
            background: linear-gradient(180deg, #ffffff 0%, #f6faf7 60%, #fbf4f6 100%);
            border-bottom: 1px solid var(--border);
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 44px;
            align-items: center;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--sj-rose-light);
            border: 1px solid var(--sj-rose-border);
            color: var(--sj-rose-dark);
            padding: 6px 14px;
            border-radius: var(--radius-pill);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hero h2 {
            font-size: 46px;
            letter-spacing: -0.04em;
            color: var(--text-heading);
            margin-bottom: 14px;
            line-height: 1.15;
        }
        .hero h2 .pine-word {
            color: var(--sj-pine);
        }
        .hero h2 .rose-word {
            color: var(--sj-rose);
        }

        .hero-tagline {
            font-size: 17px;
            color: var(--text-muted);
            margin-bottom: 24px;
            max-width: 500px;
            line-height: 1.55;
            font-weight: 500;
        }

        /* Minimal 4-Pill Highlights */
        .hero-quick-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 28px;
        }
        .hero-chip {
            background: #ffffff;
            border: 1px solid var(--border);
            padding: 6px 14px;
            border-radius: var(--radius-pill);
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-heading);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: var(--shadow-xs);
        }

        .hero-cta-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .hero-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        .stat-capsule {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 10px 12px;
            text-align: center;
            box-shadow: var(--shadow-xs);
        }
        .stat-num {
            font-size: 20px;
            font-weight: 800;
            color: var(--sj-pine);
            line-height: 1.1;
        }
        .stat-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* Hero Image with Minimalist Floating Cards */
        .hero-visual-wrap {
            position: relative;
        }
        .hero-photo-frame {
            background: #ffffff;
            border-radius: var(--radius-xl);
            padding: 8px;
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--border);
            overflow: hidden;
            position: relative;
        }
        .hero-photo-frame img {
            width: 100%;
            height: 440px;
            object-fit: cover;
            border-radius: calc(var(--radius-xl) - 8px);
            transition: transform 0.4s ease;
        }
        .hero-photo-frame:hover img {
            transform: scale(1.02);
        }

        .floating-pill {
            position: absolute;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            padding: 10px 16px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2;
        }
        .pill-top {
            top: 18px;
            left: -14px;
            border-left: 3px solid var(--sj-pine);
        }
        .pill-bottom {
            bottom: 18px;
            right: -12px;
            border-left: 3px solid var(--sj-rose);
        }
        .fp-icon {
            font-size: 20px;
            line-height: 1;
        }
        .fp-text strong {
            display: block;
            font-size: 13px;
            color: var(--text-heading);
            font-weight: 700;
        }
        .fp-text span {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Section Commons */
        section {
            padding: 58px 0;
        }
        .section-header {
            text-align: center;
            max-width: 580px;
            margin: 0 auto 36px;
        }
        .section-tag {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--sj-pine);
            background: var(--sj-pine-light);
            padding: 4px 12px;
            border-radius: var(--radius-pill);
            display: inline-block;
            margin-bottom: 8px;
            border: 1px solid var(--sj-pine-border);
        }
        .section-tag.rose-tag {
            color: var(--sj-rose-dark);
            background: var(--sj-rose-light);
            border-color: var(--sj-rose-border);
        }
        .section-header h2 {
            font-size: 30px;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
            color: var(--text-heading);
        }
        .section-header p {
            font-size: 14.5px;
            color: var(--text-muted);
        }

        /* 4-Pillars Strip (Minimal) */
        .pillars-section {
            padding: 26px 0;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
        }
        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .pillar-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: var(--bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }
        .pillar-card:hover {
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            border-color: var(--sj-pine-border);
        }
        .pillar-icon {
            font-size: 22px;
            flex-shrink: 0;
        }
        .pillar-info strong {
            display: block;
            font-size: 13.5px;
            color: var(--text-heading);
            font-weight: 700;
        }
        .pillar-info span {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* Real Photos Gallery (Clean, Minimal Text) */
        .photos-section {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
        }
        .photos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }
        .photo-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
        }
        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--sj-pine-border);
        }
        .photo-card-img {
            position: relative;
            height: 250px;
            overflow: hidden;
            background: #f1f5f9;
        }
        .photo-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .photo-card:hover .photo-card-img img {
            transform: scale(1.04);
        }
        .photo-tag-pill {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(19, 62, 43, 0.88);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            backdrop-filter: blur(4px);
        }
        .photo-card-body {
            padding: 18px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .photo-card-body h3 {
            font-size: 16px;
            color: var(--text-heading);
        }
        .photo-chip {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--sj-pine);
            background: var(--sj-pine-light);
            padding: 4px 10px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--sj-pine-border);
        }

        /* Floor Filter Controls */
        .filter-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
        }
        .filter-capsule {
            display: inline-flex;
            background: #ffffff;
            padding: 4px;
            border-radius: var(--radius-pill);
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-xs);
            gap: 4px;
        }
        .filter-pill-btn {
            background: transparent;
            border: none;
            padding: 8px 18px;
            border-radius: var(--radius-pill);
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .filter-pill-btn:hover {
            color: var(--sj-pine);
        }
        .filter-pill-btn.active {
            background: var(--sj-pine);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(19, 62, 43, 0.25);
        }

        /* Floor Sections */
        .floor-group {
            margin-bottom: 40px;
        }
        .floor-title-strip {
            background: #ffffff;
            border: 1px solid var(--border);
            border-left: 4px solid var(--sj-pine);
            border-radius: var(--radius-md);
            padding: 12px 20px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-xs);
        }
        .floor-title-strip.first-floor-strip {
            border-left-color: var(--sj-rose);
        }
        .floor-title-strip h3 {
            font-size: 17px;
            color: var(--text-heading);
        }
        .floor-badge-tag {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--sj-pine);
            background: var(--sj-pine-light);
            border: 1px solid var(--sj-pine-border);
            padding: 4px 12px;
            border-radius: var(--radius-pill);
        }
        .floor-badge-tag.rose-tag {
            color: var(--sj-rose-dark);
            background: var(--sj-rose-light);
            border-color: var(--sj-rose-border);
        }

        /* Room Cards Grid (Minimal & Scannable) */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .room-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            transition: all 0.22s ease;
            position: relative;
        }
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--sj-pine-border);
        }
        .room-card.rose-card-hover:hover {
            border-color: var(--sj-rose-border);
        }
        .room-card-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .room-title-num {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.02em;
        }
        .room-sharing-tag {
            font-size: 11px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: var(--radius-pill);
            text-transform: uppercase;
        }
        .tag-pine {
            background: var(--sj-pine-light);
            color: var(--sj-pine);
            border: 1px solid var(--sj-pine-border);
        }
        .tag-rose {
            background: var(--sj-rose-light);
            color: var(--sj-rose-dark);
            border: 1px solid var(--sj-rose-border);
        }

        /* Availability Strip */
        .room-live-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-sm);
            padding: 6px 10px;
            margin-bottom: 14px;
            font-size: 11.5px;
        }
        .status-dot-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
        }
        .status-dot-wrap.available {
            color: #16a34a;
        }
        .status-dot-wrap.occupied {
            color: #d97706;
        }
        .status-dot-wrap.booked {
            color: #dc2626;
        }
        .status-circle-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Dual Price Container (Crisp & Clear) */
        .room-dual-price {
            background: #fafcfb;
            border: 1px solid #edf4f0;
            border-radius: var(--radius-md);
            padding: 10px 12px;
            margin-bottom: 14px;
        }
        .dual-price-line {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 12.5px;
        }
        .dual-price-line:not(:last-child) {
            border-bottom: 1px dashed var(--border);
            padding-bottom: 5px;
            margin-bottom: 5px;
        }
        .d-price-label {
            color: var(--text-body);
            font-weight: 500;
        }
        .d-price-val {
            font-size: 16px;
            font-weight: 800;
            color: var(--sj-pine);
        }
        .d-price-val.rose-price {
            color: var(--sj-rose-dark);
        }
        .d-price-val small {
            font-size: 10.5px;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Quick Inclusions Pills */
        .room-micro-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 16px;
        }
        .rm-pill {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 3px 8px;
            border-radius: 4px;
        }

        .room-actions-bar {
            margin-top: auto;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 8px;
        }

        /* Pricing Matrix Section */
        .pricing-section {
            background: #ffffff;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .pricing-table-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        table.pricing-table-clean {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            text-align: left;
        }
        table.pricing-table-clean th {
            background: var(--sj-pine-light);
            padding: 14px 18px;
            font-weight: 700;
            color: var(--sj-pine);
            border-bottom: 2px solid var(--sj-pine-border);
            font-size: 12.5px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        table.pricing-table-clean td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-body);
            vertical-align: middle;
        }
        table.pricing-table-clean tr:hover td {
            background: #fbfdfc;
        }
        .table-rate-pine {
            font-size: 16px;
            font-weight: 800;
            color: var(--sj-pine);
        }
        .table-rate-rose {
            font-size: 16px;
            font-weight: 800;
            color: var(--sj-rose-dark);
        }
        .table-rate-plain {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--text-muted);
        }

        /* Amenities Section (8 Clean Bento Badges) */
        .amenities-section {
            background: var(--bg);
        }
        .amenities-grid-8 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .amenity-card-clean {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 18px;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-xs);
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .amenity-card-clean:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--sj-pine-border);
        }
        .amenity-card-clean.rose-tint:hover {
            border-color: var(--sj-rose-border);
        }
        .amenity-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--sj-pine-light);
            color: var(--sj-pine);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            border: 1px solid var(--sj-pine-border);
        }
        .amenity-card-clean.rose-tint .amenity-icon-box {
            background: var(--sj-rose-light);
            color: var(--sj-rose-dark);
            border-color: var(--sj-rose-border);
        }
        .amenity-text h4 {
            font-size: 14.5px;
            margin-bottom: 2px;
            color: var(--text-heading);
        }
        .amenity-text span {
            font-size: 11.5px;
            color: var(--text-muted);
            display: block;
        }

        /* Contact & Location Section (Clean 2-Column) */
        .contact-section {
            background: var(--bg);
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            align-items: start;
        }
        .contact-info-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 28px;
            box-shadow: var(--shadow-sm);
        }
        .contact-info-card h3 {
            font-size: 20px;
            margin-bottom: 6px;
            color: var(--text-heading);
        }
        .contact-info-card p.intro {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .contact-links-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 18px;
        }
        .contact-link-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 12px 14px;
            transition: all 0.2s ease;
        }
        .contact-link-card:hover {
            background: #ffffff;
            border-color: var(--sj-pine-border);
            transform: translateX(3px);
        }
        .cl-icon-box {
            font-size: 18px;
            width: 36px;
            height: 36px;
            background: #ffffff;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-xs);
            flex-shrink: 0;
            border: 1px solid var(--border-light);
        }
        .cl-details small {
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            display: block;
        }
        .cl-details a, .cl-details strong {
            font-size: 14px;
            color: var(--text-heading);
            font-weight: 700;
        }

        .map-box-frame {
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border);
            height: 220px;
            background: #f1f5f9;
            margin-top: 14px;
        }
        .map-box-frame iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Quick Booking Form Card */
        .enquiry-form-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 28px;
            box-shadow: var(--shadow-md);
        }
        .enquiry-form-card h3 {
            font-size: 20px;
            margin-bottom: 4px;
        }
        .enquiry-form-card p {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }
        .form-row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }
        .form-field-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 12px;
        }
        .form-field-group label {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-heading);
        }
        .form-field-group input, .form-field-group select, .form-field-group textarea {
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-family: inherit;
            color: var(--text-heading);
            background: #ffffff;
            outline: none;
            transition: all 0.2s;
        }
        .form-field-group input:focus, .form-field-group select:focus, .form-field-group textarea:focus {
            border-color: var(--sj-pine);
            box-shadow: 0 0 0 3px rgba(19, 62, 43, 0.12);
        }
        .form-field-group textarea {
            min-height: 70px;
            resize: vertical;
        }

        .alert-success-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 14px;
            border-radius: var(--radius-md);
            font-size: 12.5px;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Clean Modern Footer */
        footer.site-footer {
            background: #0f251a;
            color: #cad8ce;
            padding: 40px 0 24px;
            border-top: 2px solid var(--sj-rose);
            font-size: 12.5px;
        }
        .footer-cols-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 32px;
            padding-bottom: 28px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 18px;
        }
        .footer-brand-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }
        .footer-brand-title img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #fff;
            padding: 2px;
        }
        .footer-brand-title strong {
            font-size: 16px;
            color: #ffffff;
            display: block;
        }
        .footer-brand-title span {
            font-size: 11px;
            color: var(--sj-rose-border);
        }
        .footer-col h4 {
            font-size: 13px;
            color: #ffffff;
            margin-bottom: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .footer-links-ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }
        .footer-links-ul a {
            color: #9cb2a5;
        }
        .footer-links-ul a:hover {
            color: #ffffff;
        }
        .footer-bottom-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 11.5px;
            color: #799182;
        }

        /* Floating WhatsApp Button */
        .floating-wa-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #25d366;
            color: #ffffff !important;
            padding: 11px 18px;
            border-radius: var(--radius-pill);
            font-size: 13.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.42);
            z-index: 9999;
            border: 2px solid #ffffff;
            transition: all 0.22s ease;
            animation: pulse-ring 2.5s infinite;
        }
        .floating-wa-btn:hover {
            transform: scale(1.05) translateY(-2px);
            background: #1ebd5a;
        }
        .floating-wa-btn svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
            flex-shrink: 0;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5); }
            70% { box-shadow: 0 0 0 12px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Mobile Sticky Actions */
        .mobile-quick-actions {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            border-top: 1px solid var(--border);
            padding: 9px 14px;
            box-shadow: 0 -4px 14px rgba(0, 0, 0, 0.08);
            z-index: 9998;
            gap: 10px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .hero h2 {
                font-size: 36px;
            }
            .hero-photo-frame img {
                height: 360px;
            }
            .photos-grid {
                grid-template-columns: 1fr;
            }
            .room-grid {
                grid-template-columns: 1fr 1fr;
            }
            .amenities-grid-8 {
                grid-template-columns: repeat(2, 1fr);
            }
            .pillars-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .contact-grid {
                grid-template-columns: 1fr;
            }
            .footer-cols-grid {
                grid-template-columns: 1fr;
                gap: 22px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            .header-inner {
                height: 70px;
            }
            .brand-logo {
                width: 42px;
                height: 42px;
            }
            .brand-text h1 {
                font-size: 18px;
            }
            .hero {
                padding: 32px 0 38px;
            }
            .hero h2 {
                font-size: 30px;
            }
            .hero-stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
            .room-grid {
                grid-template-columns: 1fr;
            }
            .room-actions-bar {
                grid-template-columns: 1fr;
            }
            .amenities-grid-8 {
                grid-template-columns: 1fr;
            }
            .pillars-grid {
                grid-template-columns: 1fr;
            }
            .form-row-grid {
                grid-template-columns: 1fr;
            }
            .top-bar-inner {
                flex-direction: column;
                align-items: flex-start;
            }
            .floating-wa-btn {
                bottom: 68px;
                right: 16px;
                padding: 9px 15px;
                font-size: 12.5px;
            }
            .mobile-quick-actions {
                display: flex;
            }
            body {
                padding-bottom: 54px;
            }
        }
    </style>
</head>
<body>

    <!-- Top Announcement Strip -->
    <div class="top-bar">
        <div class="container top-bar-inner">
            <div class="top-badge">
                <span class="live-dot"></span>
                <span>Admissions Open for 2026-2027 · Women & Students</span>
            </div>
            <div class="top-contacts">
                <a href="tel:+918590621496">📞 <strong>+91 85906 21496</strong></a>
                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="color:#bbf7d0;">
                    💬 WhatsApp: <strong>8590621496</strong>
                </a>
                <a href="mailto:sjladieshostel07@gmail.com">✉️ <strong>sjladieshostel07@gmail.com</strong></a>
            </div>
            <div class="top-login">
                @auth
                    <a href="{{ route('dashboard') }}">Admin Portal →</a>
                @else
                    <a href="{{ route('login') }}">Staff Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="brand">
                <div class="brand-logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo">
                </div>
                <div class="brand-text">
                    <h1>SJ <span>Ladies Hostel</span></h1>
                    <p>A Safe & Comfortable Stay for Women 🌸</p>
                </div>
            </a>

            <ul class="nav-menu">
                <li><a href="#photos">Photos</a></li>
                <li><a href="#rooms">Rooms & Rates</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#amenities">Amenities</a></li>
                <li><a href="#contact">Location</a></li>
            </ul>

            <div class="header-actions">
                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="btn btn-wa">
                    <svg viewBox="0 0 24 24" style="width:17px;height:17px;fill:currentColor;"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.399C8.423 21.493 10.15 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                    <span>WhatsApp</span>
                </a>
                <a href="tel:+918590621496" class="btn btn-rose-outline">
                    📞 Call
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section (Minimal Text, Maximum Visual Impact) -->
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <div class="hero-pill">
                    <span>❤ Safe & Comfortable Stay for Women in Kochi</span>
                </div>

                <h2>Safe. Homely.<br><span class="rose-word">Comfortable.</span></h2>
                <p class="hero-tagline">
                    Ground Floor & 1st Floor rooms with attached washrooms, 3 fresh daily meals, high-speed Wi-Fi & 24/7 CCTV security.
                </p>

                <div class="hero-quick-chips">
                    <span class="hero-chip">🍲 3 Daily Home Meals</span>
                    <span class="hero-chip">🚿 Attached Bath & Geyser</span>
                    <span class="hero-chip">🛡️ 24/7 CCTV & Warden</span>
                    <span class="hero-chip">📶 High-Speed Wi-Fi</span>
                </div>

                <div class="hero-cta-row">
                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20bed%20availability" target="_blank" class="btn btn-wa">
                        💬 Connect on WhatsApp (Fast Reply)
                    </a>
                    <a href="#rooms" class="btn btn-outline">
                        View Available Rooms ↓
                    </a>
                </div>

                <div class="hero-stats-row">
                    <div class="stat-capsule">
                        <div class="stat-num">24</div>
                        <div class="stat-label">Beds</div>
                    </div>
                    <div class="stat-capsule">
                        <div class="stat-num">2</div>
                        <div class="stat-label">Floors</div>
                    </div>
                    <div class="stat-capsule">
                        <div class="stat-num">3</div>
                        <div class="stat-label">Meals</div>
                    </div>
                    <div class="stat-capsule">
                        <div class="stat-num">24/7</div>
                        <div class="stat-label">CCTV</div>
                    </div>
                </div>
            </div>

            <!-- Hero Real Photo Card -->
            <div class="hero-visual-wrap">
                <div class="floating-pill pill-top">
                    <span class="fp-icon">🛡️</span>
                    <div class="fp-text">
                        <strong>24/7 Safety & CCTV</strong>
                        <span>Resident Female Warden</span>
                    </div>
                </div>

                <div class="hero-photo-frame">
                    <img src="{{ asset('images/building.jpg') }}" alt="SJ Ladies Hostel Exterior Building">
                </div>

                <div class="floating-pill pill-bottom">
                    <span class="fp-icon">🍲</span>
                    <div class="fp-text">
                        <strong>3 Homely Meals Daily</strong>
                        <span>Fresh South & North Indian</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Pillars Strip (Minimal) -->
    <div class="pillars-section">
        <div class="container pillars-grid">
            <div class="pillar-card">
                <span class="pillar-icon">✨</span>
                <div class="pillar-info">
                    <strong>Zero Brokerage</strong>
                    <span>Direct admission with clear rent</span>
                </div>
            </div>
            <div class="pillar-card">
                <span class="pillar-icon">🚿</span>
                <div class="pillar-info">
                    <strong>Attached Bathrooms</strong>
                    <span>With geyser in all 6 rooms</span>
                </div>
            </div>
            <div class="pillar-card">
                <span class="pillar-icon">🍲</span>
                <div class="pillar-info">
                    <strong>Flexible Food Plan</strong>
                    <span>With / without food options</span>
                </div>
            </div>
            <div class="pillar-card">
                <span class="pillar-icon">📍</span>
                <div class="pillar-info">
                    <strong>Prime Location</strong>
                    <span>Close to colleges & offices</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Real Photos Showcase (Visual First) -->
    <section id="photos" class="photos-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">ACTUAL HOSTEL PHOTOS</span>
                <h2>100% Genuine Property Photos</h2>
                <p>Clean, spacious, and well-maintained living spaces.</p>
            </div>

            <div class="photos-grid">
                <!-- Card 1: Building Exterior -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <span class="photo-tag-pill">BUILDING EXTERIOR</span>
                        <img src="{{ asset('images/building.jpg') }}" alt="SJ Ladies Hostel Front View">
                    </div>
                    <div class="photo-card-body">
                        <h3>Hostel Building Exterior</h3>
                        <span class="photo-chip">Ground & 1st Floor · 6 Rooms</span>
                    </div>
                </div>

                <!-- Card 2: Living Lounge -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <span class="photo-tag-pill" style="background:rgba(212, 91, 115, 0.9);">COMMON LOUNGE</span>
                        <img src="{{ asset('images/hall.jpg') }}" alt="SJ Ladies Hostel Living Hall">
                    </div>
                    <div class="photo-card-body">
                        <h3>Spacious Hall & Lounge</h3>
                        <span class="photo-chip" style="background:var(--sj-rose-light);color:var(--sj-rose-dark);border-color:var(--sj-rose-border);">Sofas · Wi-Fi · Laundry</span>
                    </div>
                </div>

                <!-- Card 3: Modular Kitchen -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <span class="photo-tag-pill">HYGIENIC KITCHEN</span>
                        <img src="{{ asset('images/kitchen.jpg') }}" alt="SJ Ladies Hostel Kitchen">
                    </div>
                    <div class="photo-card-body">
                        <h3>Modular Cooking Kitchen</h3>
                        <span class="photo-chip">3 Fresh Meals Daily · RO Water</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Structure & Live Availability -->
    <section id="rooms">
        <div class="container">
            <div class="section-header">
                <span class="section-tag rose-tag">ROOMS & AVAILABILITY</span>
                <h2>Choose Your Room</h2>
                <p>Select Ground Floor or First Floor according to your preference.</p>
            </div>

            <!-- Floor Filter Buttons -->
            <div class="filter-wrapper">
                <div class="filter-capsule">
                    <button class="filter-pill-btn active" onclick="switchFloor('all', this)">All Rooms (6)</button>
                    <button class="filter-pill-btn" onclick="switchFloor('ground', this)">Ground Floor (A1, A2, A3)</button>
                    <button class="filter-pill-btn" onclick="switchFloor('first', this)">First Floor (B1, B2, B3)</button>
                </div>
            </div>

            <!-- GROUND FLOOR -->
            <div class="floor-group" id="floor-ground">
                <div class="floor-title-strip">
                    <div>
                        <h3>Ground Floor Rooms</h3>
                    </div>
                    <span class="floor-badge-tag">Rooms: A1, A2, A3</span>
                </div>

                <div class="room-grid">
                    @if($groundFloor)
                        @foreach($groundFloor->rooms as $room)
                            @php
                                $avail = $room->available;
                                $cap = $room->capacity;
                                $statusClass = $avail === 0 ? 'booked' : ($avail < $cap ? 'occupied' : 'available');
                                $statusText = $avail === 0 ? 'Fully Booked' : ($avail < $cap ? $avail.' Beds Available' : 'Available');
                                $tagClass = $room->sharing_label === 'Two Sharing' ? 'tag-rose' : 'tag-pine';
                                $isTwoShare = $room->sharing_label === 'Two Sharing';
                            @endphp
                            <div class="room-card {{ $isTwoShare ? 'rose-card-hover' : '' }}">
                                <div class="room-card-head">
                                    <span class="room-title-num">Room {{ $room->number }}</span>
                                    <span class="room-sharing-tag {{ $tagClass }}">{{ $room->sharing_label }}</span>
                                </div>

                                <div class="room-live-strip">
                                    <span style="color:var(--text-muted);">Status</span>
                                    <span class="status-dot-wrap {{ $statusClass }}">
                                        <span class="status-circle-dot"></span> {{ $statusText }}
                                    </span>
                                </div>

                                <div class="room-dual-price">
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🍱 With 3 Meals:</span>
                                        <span class="d-price-val {{ $isTwoShare ? 'rose-price' : '' }}">₹{{ number_format($room->monthly_rent) }} <small>/mo</small></span>
                                    </div>
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🏠 Without Food:</span>
                                        <span class="d-price-val" style="color:var(--text-heading);">₹{{ number_format($room->rent_without_food ?? 4200) }} <small>/mo</small></span>
                                    </div>
                                </div>

                                <div class="room-micro-pills">
                                    <span class="rm-pill">✓ Attached Bath</span>
                                    <span class="rm-pill">✓ Geyser</span>
                                    <span class="rm-pill">✓ Wardrobe</span>
                                    <span class="rm-pill">✓ Wi-Fi</span>
                                </div>

                                <div class="room-actions-bar">
                                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20book%20a%20bed%20in%20Room%20{{ $room->number }}%20({{ $room->sharing_label }}%2C%20Ground%20Floor)" target="_blank" class="btn btn-wa btn-sm">
                                        💬 WhatsApp Book
                                    </a>
                                    <a href="#contact" class="btn btn-outline btn-sm" onclick="selectRoom('{{ $room->number }}', '{{ $room->sharing_label }}')">
                                        Enquire
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- FIRST FLOOR -->
            <div class="floor-group" id="floor-first">
                <div class="floor-title-strip first-floor-strip">
                    <div>
                        <h3>First Floor Rooms</h3>
                    </div>
                    <span class="floor-badge-tag rose-tag">Rooms: B1, B2, B3</span>
                </div>

                <div class="room-grid">
                    @if($firstFloor)
                        @foreach($firstFloor->rooms as $room)
                            @php
                                $avail = $room->available;
                                $cap = $room->capacity;
                                $statusClass = $avail === 0 ? 'booked' : ($avail < $cap ? 'occupied' : 'available');
                                $statusText = $avail === 0 ? 'Fully Booked' : ($avail < $cap ? $avail.' Beds Available' : 'Available');
                                $tagClass = $room->sharing_label === 'Two Sharing' ? 'tag-rose' : 'tag-pine';
                                $isTwoShare = $room->sharing_label === 'Two Sharing';
                            @endphp
                            <div class="room-card {{ $isTwoShare ? 'rose-card-hover' : '' }}">
                                <div class="room-card-head">
                                    <span class="room-title-num">Room {{ $room->number }}</span>
                                    <span class="room-sharing-tag {{ $tagClass }}">{{ $room->sharing_label }}</span>
                                </div>

                                <div class="room-live-strip">
                                    <span style="color:var(--text-muted);">Status</span>
                                    <span class="status-dot-wrap {{ $statusClass }}">
                                        <span class="status-circle-dot"></span> {{ $statusText }}
                                    </span>
                                </div>

                                <div class="room-dual-price">
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🍱 With 3 Meals:</span>
                                        <span class="d-price-val {{ $isTwoShare ? 'rose-price' : '' }}">₹{{ number_format($room->monthly_rent) }} <small>/mo</small></span>
                                    </div>
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🏠 Without Food:</span>
                                        <span class="d-price-val" style="color:var(--text-heading);">₹{{ number_format($room->rent_without_food ?? 4200) }} <small>/mo</small></span>
                                    </div>
                                </div>

                                <div class="room-micro-pills">
                                    <span class="rm-pill">✓ Attached Bath</span>
                                    <span class="rm-pill">✓ Geyser</span>
                                    <span class="rm-pill">✓ Balcony</span>
                                    <span class="rm-pill">✓ Wi-Fi</span>
                                </div>

                                <div class="room-actions-bar">
                                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20book%20a%20bed%20in%20Room%20{{ $room->number }}%20({{ $room->sharing_label }}%2C%20First%20Floor)" target="_blank" class="btn btn-wa btn-sm">
                                        💬 WhatsApp Book
                                    </a>
                                    <a href="#contact" class="btn btn-outline btn-sm" onclick="selectRoom('{{ $room->number }}', '{{ $room->sharing_label }}')">
                                        Enquire
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Monthly Pricing Matrix (Clear & Scannable) -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">MONTHLY RATES</span>
                <h2>Clear & Honest Pricing</h2>
                <p>No hidden charges. Choose with or without meals.</p>
            </div>

            <div class="pricing-table-card">
                <table class="pricing-table-clean">
                    <thead>
                        <tr>
                            <th>Sharing Type</th>
                            <th>Allocated Rooms</th>
                            <th>With 3 Meals (Monthly)</th>
                            <th>Without Food (Monthly)</th>
                            <th style="text-align:right;">Book Instantly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Six Sharing</strong></td>
                            <td>Room B1 (1st Floor)</td>
                            <td><span class="table-rate-pine">₹6,500</span></td>
                            <td><span class="table-rate-plain">₹4,200</span></td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Six%20Sharing%20(Room%20B1)" target="_blank" class="btn btn-wa btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Five Sharing</strong></td>
                            <td>Room A1, Room A2 (Ground Floor)</td>
                            <td><span class="table-rate-pine">₹6,500</span></td>
                            <td><span class="table-rate-plain">₹4,200</span></td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Five%20Sharing%20(Room%20A1%20or%20A2)" target="_blank" class="btn btn-wa btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Four Sharing</strong></td>
                            <td>Room B2 (1st Floor)</td>
                            <td><span class="table-rate-pine">₹6,500</span></td>
                            <td><span class="table-rate-plain">₹4,200</span></td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Four%20Sharing%20(Room%20B2)" target="_blank" class="btn btn-wa btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Two Sharing</strong> <span class="room-sharing-tag tag-rose" style="margin-left:4px;">PREMIUM</span></td>
                            <td>Room A3 (Ground), Room B3 (1st)</td>
                            <td><span class="table-rate-rose">₹8,600</span></td>
                            <td><span class="table-rate-plain">₹6,500</span></td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Two%20Sharing%20(Room%20A3%20or%20B3)" target="_blank" class="btn btn-wa btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Amenities Grid (8 Clean Bento Badges) -->
    <section id="amenities" class="amenities-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag rose-tag">AMENITIES</span>
                <h2>Everything You Need</h2>
                <p>Designed for comfort, security, and hassle-free living.</p>
            </div>

            <div class="amenities-grid-8">
                <div class="amenity-card-clean">
                    <div class="amenity-icon-box">🍲</div>
                    <div class="amenity-text">
                        <h4>3 Homely Meals Daily</h4>
                        <span>Fresh South & North Indian</span>
                    </div>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-box">🚿</div>
                    <div class="amenity-text">
                        <h4>Attached Bath & Geyser</h4>
                        <span>In every single room</span>
                    </div>
                </div>
                <div class="amenity-card-clean">
                    <div class="amenity-icon-box">📶</div>
                    <div class="amenity-text">
                        <h4>High-Speed Wi-Fi</h4>
                        <span>Seamless study & work</span>
                    </div>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-box">🧺</div>
                    <div class="amenity-text">
                        <h4>Washing Machine</h4>
                        <span>Laundry & drying space</span>
                    </div>
                </div>
                <div class="amenity-card-clean">
                    <div class="amenity-icon-box">🛡️</div>
                    <div class="amenity-text">
                        <h4>24/7 CCTV & Warden</h4>
                        <span>Complete safety monitoring</span>
                    </div>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-box">🧹</div>
                    <div class="amenity-text">
                        <h4>Daily Housekeeping</h4>
                        <span>Clean rooms & corridors</span>
                    </div>
                </div>
                <div class="amenity-card-clean">
                    <div class="amenity-icon-box">💧</div>
                    <div class="amenity-text">
                        <h4>RO Drinking Water</h4>
                        <span>Multi-stage filtration</span>
                    </div>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-box">🔒</div>
                    <div class="amenity-text">
                        <h4>Lockable Wardrobes</h4>
                        <span>Personal key storage</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Direct Booking -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag rose-tag">VISIT & BOOK</span>
                <h2>Location & Direct Enquiry</h2>
                <p>Reach out on WhatsApp or submit the enquiry form below.</p>
            </div>

            <div class="contact-grid">
                <!-- Contact Details & Map Card -->
                <div class="contact-info-card">
                    <h3>SJ Ladies Hostel</h3>
                    <p class="intro">Located in a peaceful, safe residential area with quick connectivity to metro, bus routes & colleges.</p>

                    <div class="contact-links-box">
                        <div class="contact-link-card">
                            <span class="cl-icon-box" style="color:#25d366;">💬</span>
                            <div class="cl-details">
                                <small>Chat on WhatsApp (Fastest Reply)</small>
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="color:var(--wa-dark);">
                                    +91 85906 21496 (Click to Chat) →
                                </a>
                            </div>
                        </div>

                        <div class="contact-link-card">
                            <span class="cl-icon-box" style="color:var(--sj-rose);">📞</span>
                            <div class="cl-details">
                                <small>Hostel Warden Direct Line</small>
                                <a href="tel:+918590621496">+91 85906 21496</a>
                            </div>
                        </div>

                        <div class="contact-link-card">
                            <span class="cl-icon-box" style="color:var(--sj-pine);">✉️</span>
                            <div class="cl-details">
                                <small>Official Email</small>
                                <a href="mailto:sjladieshostel07@gmail.com">sjladieshostel07@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                        <span style="font-size:12.5px;color:var(--text-muted);">📍 Coordinates: <strong>9.9911476, 76.3189574</strong></span>
                        <a href="https://maps.google.com/maps?q=9.9911476%2C76.3189574&z=17&hl=en" target="_blank" class="btn btn-outline btn-sm">
                            Google Maps App ↗
                        </a>
                    </div>

                    <div class="map-box-frame">
                        <iframe
                            src="https://maps.google.com/maps?q=9.9911476,76.3189574&z=17&hl=en&output=embed"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Modern Enquiry Form Card -->
                <div class="enquiry-form-card">
                    <h3>Direct Admission Enquiry</h3>
                    <p>Enter your details below and our warden will call you promptly.</p>

                    @if(session('success'))
                        <div class="alert-success-box">
                            <strong>✓ {{ session('success') }}</strong>
                            @if(session('whatsapp_url'))
                                <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-wa btn-sm" style="align-self:flex-start;">
                                    Confirm on WhatsApp Now →
                                </a>
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('enquiry.store') }}" method="POST">
                        @csrf
                        <div class="form-row-grid">
                            <div class="form-field-group">
                                <label for="name">Your Name *</label>
                                <input type="text" id="name" name="name" required placeholder="Full Name" value="{{ old('name') }}">
                            </div>
                            <div class="form-field-group">
                                <label for="phone">Phone / WhatsApp *</label>
                                <input type="tel" id="phone" name="phone" required placeholder="10-digit Mobile" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-row-grid">
                            <div class="form-field-group">
                                <label for="room_number">Preferred Room</label>
                                <select id="room_number" name="room_number">
                                    <option value="">-- Any Available Room --</option>
                                    <option value="A1">Room A1 (Five Sharing - Ground)</option>
                                    <option value="A2">Room A2 (Five Sharing - Ground)</option>
                                    <option value="A3">Room A3 (Two Sharing - Ground)</option>
                                    <option value="B1">Room B1 (Six Sharing - First)</option>
                                    <option value="B2">Room B2 (Four Sharing - First)</option>
                                    <option value="B3">Room B3 (Two Sharing - First)</option>
                                </select>
                            </div>
                            <div class="form-field-group">
                                <label for="food_preference">Meal Preference</label>
                                <select id="food_preference" name="food_preference">
                                    <option value="with_food">With Food (3 Daily Meals)</option>
                                    <option value="without_food">Without Food (Room Only)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field-group">
                            <label for="joining_date">Expected Joining Date</label>
                            <input type="date" id="joining_date" name="joining_date" value="{{ old('joining_date', today()->toDateString()) }}">
                        </div>

                        <div class="form-field-group">
                            <label for="notes">College / Workplace / Notes</label>
                            <textarea id="notes" name="notes" placeholder="Shift timings, college name, or any preferences..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-pine btn-block" style="padding:12px;">
                            Send Booking Enquiry →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Clean Modern Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-cols-grid">
                <div>
                    <div class="footer-brand-title">
                        <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo">
                        <div>
                            <strong>SJ Ladies Hostel</strong>
                            <span>A Safe & Comfortable Stay for Women 🌸</span>
                        </div>
                    </div>
                    <p style="color:#8ca395;line-height:1.6;font-size:12.5px;max-width:320px;">
                        Safe, clean, and peaceful living spaces for students and working women across Ground and First Floors.
                    </p>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links-ul">
                        <li><a href="#photos">Real Photos</a></li>
                        <li><a href="#rooms">Room Rates & Beds</a></li>
                        <li><a href="#pricing">Monthly Pricing</a></li>
                        <li><a href="#amenities">Hostel Amenities</a></li>
                        <li><a href="#contact">Location Map</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact Desk</h4>
                    <ul class="footer-links-ul">
                        <li>Phone: <a href="tel:+918590621496">+91 85906 21496</a></li>
                        <li>WhatsApp: <a href="https://wa.me/918590621496" target="_blank" style="color:#bbf7d0;">8590621496</a></li>
                        <li>Email: <a href="mailto:sjladieshostel07@gmail.com">sjladieshostel07@gmail.com</a></li>
                        <li style="color:#8ca395;margin-top:2px;">Visiting: 8:00 AM – 8:00 PM</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <span>© {{ date('Y') }} SJ Ladies Hostel. All Rights Reserved.</span>
                <span>Coordinates: 9.9911476, 76.3189574</span>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="floating-wa-btn" title="Chat on WhatsApp">
        <svg viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.399C8.423 21.493 10.15 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
        <span>WhatsApp</span>
    </a>

    <!-- Mobile Sticky Quick Bar -->
    <div class="mobile-quick-actions">
        <a href="tel:+918590621496" class="btn btn-rose-outline" style="flex:1;">
            📞 Call
        </a>
        <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="btn btn-wa" style="flex:1;">
            💬 WhatsApp
        </a>
    </div>

    <!-- Clean Floor Switcher Script -->
    <script>
        function switchFloor(type, btn) {
            document.querySelectorAll('.filter-pill-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const g = document.getElementById('floor-ground');
            const f = document.getElementById('floor-first');

            if (type === 'all') {
                g.style.display = 'block';
                f.style.display = 'block';
            } else if (type === 'ground') {
                g.style.display = 'block';
                f.style.display = 'none';
            } else if (type === 'first') {
                g.style.display = 'none';
                f.style.display = 'block';
            }
        }

        function selectRoom(roomNum, sharing) {
            const sel = document.getElementById('room_number');
            if (sel) sel.value = roomNum;
            const cSec = document.getElementById('contact');
            if (cSec) cSec.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>