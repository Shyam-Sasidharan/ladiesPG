<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SJ Ladies Hostel · A Safe & Comfortable Stay for Women in Kochi</title>
    <meta name="description" content="SJ Ladies Hostel offers safe, premium, and homely accommodation for students and working women in Kochi. Attached bathrooms in all rooms, 3 daily home-cooked meals, Wi-Fi, and 24/7 security.">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans (Modern, Clean, Elegant Geometric Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Exact Brand Theme from SJ Ladies Hostel Logo */
            --sj-pine: #133e2b;          /* Deep Pine Green from "S", "LADIES" & Roof */
            --sj-pine-hover: #0d2c1e;
            --sj-pine-light: #ecf5f0;    /* Soft pine mint tint */
            --sj-pine-border: #c8dfd3;

            --sj-rose: #d45b73;          /* Dusty Rose Pink from "J", "HOSTEL" & Heart */
            --sj-rose-hover: #be4a61;
            --sj-rose-light: #fdf2f4;    /* Soft blush rose tint */
            --sj-rose-border: #f8c9d3;

            --wa-green: #25d366;
            --wa-hover: #1ebd5a;

            --bg-page: #f8fbf9;          /* Crisp, fresh canvas with slight warm green tint */
            --surface: #ffffff;
            --surface-subtle: #fbfdfc;

            --text-heading: #0e2017;     /* Deep pine charcoal for crisp headings */
            --text-body: #2e3e35;        /* Natural readable charcoal */
            --text-muted: #60756a;       /* Sage-tinted muted text */
            --text-light: #94a39b;

            --border: #e2ece6;           /* Subtle brand-tinted border */
            --border-light: #edf4f0;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 18px;
            --radius-xl: 24px;
            --radius-pill: 9999px;

            --shadow-xs: 0 1px 2px rgba(19, 62, 43, 0.04);
            --shadow-sm: 0 2px 8px -2px rgba(19, 62, 43, 0.06), 0 1px 3px -1px rgba(19, 62, 43, 0.03);
            --shadow-md: 0 10px 24px -4px rgba(19, 62, 43, 0.08), 0 3px 6px -2px rgba(19, 62, 43, 0.03);
            --shadow-lg: 0 18px 38px -6px rgba(19, 62, 43, 0.11), 0 6px 12px -3px rgba(19, 62, 43, 0.04);
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
            background-color: var(--bg-page);
            color: var(--text-body);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.65;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5 {
            color: var(--text-heading);
            font-weight: 750;
            line-height: 1.22;
            letter-spacing: -0.025em;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Top Bar with Brand Dual Color Tints */
        .top-strip {
            background: #0f271c;
            color: #d6e4dc;
            font-size: 12.5px;
            padding: 9px 0;
            border-bottom: 1px solid rgba(212, 91, 115, 0.2);
        }
        .top-strip-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .live-admission-badge {
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
            animation: pulse-green 2s infinite;
        }
        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
        .top-strip-contacts {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .top-strip-contacts a {
            color: #d6e4dc;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .top-strip-contacts a:hover {
            color: #ffffff;
        }
        .top-admin-link a {
            color: #fce7eb;
            font-weight: 600;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 6px;
            background: rgba(212, 91, 115, 0.2);
            border: 1px solid rgba(212, 91, 115, 0.35);
        }
        .top-admin-link a:hover {
            background: rgba(212, 91, 115, 0.35);
            color: #ffffff;
        }

        /* Modern Sticky Header */
        .header {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.25s ease;
        }
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 82px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .brand-logo-wrap {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: var(--shadow-sm);
            border: 1.5px solid var(--border);
            padding: 2px;
            flex-shrink: 0;
            transition: transform 0.2s;
        }
        .brand:hover .brand-logo-wrap {
            transform: scale(1.03);
            border-color: var(--sj-rose-border);
        }
        .brand-logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .brand-title-box h1 {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--sj-pine);
            line-height: 1.15;
        }
        .brand-title-box h1 span {
            color: var(--sj-rose);
        }
        .brand-title-box p {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--sj-rose);
            letter-spacing: 0.01em;
            margin-top: 1px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
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
            gap: 12px;
        }

        /* Buttons with Brand Colors */
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

        /* Hero Section */
        .hero {
            position: relative;
            padding: 56px 0 64px;
            background: linear-gradient(180deg, #ffffff 0%, #f6faf7 60%, #fbf4f6 100%);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.12fr 0.88fr;
            gap: 46px;
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
            font-size: 12.5px;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .hero-pill-heart {
            color: var(--sj-rose);
            font-size: 13px;
        }

        .hero h2 {
            font-size: 42px;
            letter-spacing: -0.035em;
            color: var(--text-heading);
            margin-bottom: 16px;
            line-height: 1.18;
        }
        .hero h2 .pine-word {
            color: var(--sj-pine);
        }
        .hero h2 .rose-word {
            color: var(--sj-rose);
        }

        .hero-lead {
            font-size: 16.5px;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 26px;
            max-width: 560px;
        }

        .hero-checkmarks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 30px;
        }
        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-heading);
        }
        .check-icon-circle {
            width: 21px;
            height: 21px;
            border-radius: 50%;
            background: var(--sj-pine-light);
            color: var(--sj-pine);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
            flex-shrink: 0;
            border: 1px solid var(--sj-pine-border);
        }

        .hero-cta-row {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .hero-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }
        .stat-capsule {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 10px 14px;
            box-shadow: var(--shadow-xs);
            transition: all 0.2s;
        }
        .stat-capsule:hover {
            border-color: var(--sj-pine-border);
            transform: translateY(-2px);
        }
        .stat-num {
            font-size: 21px;
            font-weight: 800;
            color: var(--sj-pine);
            line-height: 1.1;
        }
        .stat-label {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Hero Image Container with Brand Floating Badges */
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
            height: 450px;
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
            padding: 11px 16px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2;
            transition: transform 0.2s;
        }
        .pill-top {
            top: 20px;
            left: -16px;
            border-left: 3px solid var(--sj-pine);
        }
        .pill-bottom {
            bottom: 20px;
            right: -12px;
            border-left: 3px solid var(--sj-rose);
        }
        .fp-icon {
            font-size: 22px;
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

        /* Value Pillars Strip */
        .pillars-section {
            padding: 32px 0;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
        }
        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }
        .pillar-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            background: var(--bg-page);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            transition: all 0.22s ease;
        }
        .pillar-card:hover {
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            border-color: var(--sj-pine-border);
        }
        .pillar-icon-box {
            width: 40px;
            height: 40px;
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
        .pillar-card.rose-accent .pillar-icon-box {
            background: var(--sj-rose-light);
            color: var(--sj-rose-dark);
            border-color: var(--sj-rose-border);
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

        /* Section Commons */
        section {
            padding: 66px 0;
        }
        .section-header {
            text-align: center;
            max-width: 640px;
            margin: 0 auto 42px;
        }
        .section-tag {
            font-size: 11.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--sj-pine);
            background: var(--sj-pine-light);
            padding: 4px 14px;
            border-radius: var(--radius-pill);
            display: inline-block;
            margin-bottom: 10px;
            border: 1px solid var(--sj-pine-border);
        }
        .section-tag.rose-tag {
            color: var(--sj-rose-dark);
            background: var(--sj-rose-light);
            border-color: var(--sj-rose-border);
        }
        .section-header h2 {
            font-size: 32px;
            letter-spacing: -0.03em;
            margin-bottom: 10px;
            color: var(--text-heading);
        }
        .section-header p {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Real Photos Gallery */
        .photos-section {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
        }
        .photos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .photo-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.28s ease;
            display: flex;
            flex-direction: column;
        }
        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--sj-pine-border);
        }
        .photo-card-img {
            position: relative;
            height: 260px;
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
            top: 14px;
            left: 14px;
            background: rgba(19, 62, 43, 0.88);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 6px;
            backdrop-filter: blur(4px);
        }
        .photo-card-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .photo-card-body h3 {
            font-size: 17px;
            margin-bottom: 6px;
            color: var(--text-heading);
        }
        .photo-card-body p {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 14px;
        }
        .photo-specs-box {
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--sj-pine);
            background: var(--sj-pine-light);
            padding: 7px 12px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--sj-pine-border);
        }

        /* Floor Filter Controls */
        .filter-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 34px;
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
            padding: 9px 20px;
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
            margin-bottom: 48px;
        }
        .floor-title-strip {
            background: #ffffff;
            border: 1px solid var(--border);
            border-left: 4px solid var(--sj-pine);
            border-radius: var(--radius-md);
            padding: 14px 22px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-xs);
        }
        .floor-title-strip.first-floor-strip {
            border-left-color: var(--sj-rose);
        }
        .floor-title-strip h3 {
            font-size: 18.5px;
            color: var(--text-heading);
            margin-bottom: 2px;
        }
        .floor-title-strip p {
            font-size: 12.5px;
            color: var(--text-muted);
        }
        .floor-badge-tag {
            font-size: 12px;
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

        /* Room Cards Grid */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }
        .room-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
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
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .room-title-num {
            font-size: 24px;
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

        .room-sub-floor {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        /* Availability Strip */
        .room-live-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-sm);
            padding: 7px 12px;
            margin-bottom: 16px;
            font-size: 12px;
        }
        .status-dot-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            font-size: 11.5px;
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

        /* Dual Price Container */
        .room-dual-price {
            background: #fafcfb;
            border: 1px solid #edf4f0;
            border-radius: var(--radius-md);
            padding: 12px 14px;
            margin-bottom: 16px;
        }
        .dual-price-line {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 13px;
        }
        .dual-price-line:not(:last-child) {
            border-bottom: 1px dashed var(--border);
            padding-bottom: 7px;
            margin-bottom: 6px;
        }
        .d-price-label {
            color: var(--text-body);
            font-weight: 500;
        }
        .d-price-val {
            font-size: 17px;
            font-weight: 800;
            color: var(--sj-pine);
        }
        .d-price-val.rose-price {
            color: var(--sj-rose-dark);
        }
        .d-price-val small {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Features List */
        .room-features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 18px;
            font-size: 12.5px;
            color: var(--text-body);
        }
        .room-features-list li {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .room-features-list li span {
            color: var(--sj-pine);
            font-weight: 800;
        }
        .room-card.rose-card-hover .room-features-list li span {
            color: var(--sj-rose);
        }

        .room-actions-bar {
            margin-top: auto;
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: 10px;
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
            font-size: 14px;
            text-align: left;
        }
        table.pricing-table-clean th {
            background: var(--sj-pine-light);
            padding: 16px 20px;
            font-weight: 700;
            color: var(--sj-pine);
            border-bottom: 2px solid var(--sj-pine-border);
            font-size: 13px;
        }
        table.pricing-table-clean td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-body);
            vertical-align: middle;
        }
        table.pricing-table-clean tr:hover td {
            background: #fbfdfc;
        }
        .table-rate-pine {
            font-size: 17px;
            font-weight: 800;
            color: var(--sj-pine);
        }
        .table-rate-rose {
            font-size: 17px;
            font-weight: 800;
            color: var(--sj-rose-dark);
        }
        .table-rate-plain {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-muted);
        }

        /* Amenities Section */
        .amenities-section {
            background: var(--bg-page);
        }
        .amenities-grid-8 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }
        .amenity-card-clean {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 22px 20px;
            transition: all 0.22s ease;
            box-shadow: var(--shadow-xs);
        }
        .amenity-card-clean:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--sj-pine-border);
        }
        .amenity-card-clean.rose-tint:hover {
            border-color: var(--sj-rose-border);
        }
        .amenity-icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--sj-pine-light);
            color: var(--sj-pine);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
            border: 1px solid var(--sj-pine-border);
        }
        .amenity-card-clean.rose-tint .amenity-icon-circle {
            background: var(--sj-rose-light);
            color: var(--sj-rose-dark);
            border-color: var(--sj-rose-border);
        }
        .amenity-card-clean h4 {
            font-size: 15.5px;
            margin-bottom: 5px;
            color: var(--text-heading);
        }
        .amenity-card-clean p {
            font-size: 12.5px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Testimonials Section */
        .testimonials-section {
            background: #ffffff;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .testimonials-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }
        .testi-card-box {
            background: var(--bg-page);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .testi-stars-row {
            color: #f59e0b;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .testi-quote-p {
            font-size: 13.5px;
            color: var(--text-body);
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 18px;
        }
        .testi-user-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .testi-avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--sj-pine);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }
        .testi-avatar-circle.rose-avatar {
            background: var(--sj-rose);
        }
        .testi-user-details strong {
            display: block;
            font-size: 13px;
            color: var(--text-heading);
        }
        .testi-user-details span {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* Contact & Location Section */
        .contact-section {
            background: var(--bg-page);
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            align-items: start;
        }
        .contact-info-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 32px;
            box-shadow: var(--shadow-sm);
        }
        .contact-info-card h3 {
            font-size: 22px;
            margin-bottom: 8px;
            color: var(--text-heading);
        }
        .contact-info-card p.intro {
            font-size: 13.5px;
            color: var(--text-muted);
            margin-bottom: 22px;
            line-height: 1.6;
        }

        .contact-links-box {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 22px;
        }
        .contact-link-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--bg-page);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 13px 16px;
            transition: all 0.2s ease;
        }
        .contact-link-card:hover {
            background: #ffffff;
            border-color: var(--sj-pine-border);
            transform: translateX(3px);
        }
        .contact-link-card.rose-border:hover {
            border-color: var(--sj-rose-border);
        }
        .cl-icon-box {
            font-size: 20px;
            width: 40px;
            height: 40px;
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
            font-size: 10.5px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            display: block;
        }
        .cl-details a, .cl-details strong {
            font-size: 14.5px;
            color: var(--text-heading);
            font-weight: 700;
        }

        .map-box-frame {
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border);
            height: 230px;
            background: #f1f5f9;
            margin-top: 18px;
        }
        .map-box-frame iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Enquiry Form Card */
        .enquiry-form-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 32px;
            box-shadow: var(--shadow-md);
        }
        .enquiry-form-card h3 {
            font-size: 21px;
            margin-bottom: 6px;
        }
        .enquiry-form-card p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }
        .form-row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }
        .form-field-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 14px;
        }
        .form-field-group label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-heading);
        }
        .form-field-group input, .form-field-group select, .form-field-group textarea {
            padding: 10px 13px;
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
            min-height: 80px;
            resize: vertical;
        }

        .alert-success-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 14px 16px;
            border-radius: var(--radius-md);
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Clean Modern Footer */
        footer.site-footer {
            background: #0f251a;
            color: #cad8ce;
            padding: 48px 0 28px;
            border-top: 2px solid var(--sj-rose);
            font-size: 13px;
        }
        .footer-cols-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 36px;
            padding-bottom: 36px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 22px;
        }
        .footer-brand-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .footer-brand-title img {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #fff;
            padding: 2px;
        }
        .footer-brand-title strong {
            font-size: 17px;
            color: #ffffff;
            display: block;
        }
        .footer-brand-title span {
            font-size: 11.5px;
            color: var(--sj-rose-border);
        }
        .footer-col h4 {
            font-size: 14px;
            color: #ffffff;
            margin-bottom: 14px;
            font-weight: 700;
        }
        .footer-links-ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
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
            font-size: 12px;
            color: #799182;
        }

        /* Floating WhatsApp Button */
        .floating-wa-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #25d366;
            color: #ffffff !important;
            padding: 12px 20px;
            border-radius: var(--radius-pill);
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 9px;
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
            width: 21px;
            height: 21px;
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
            padding: 10px 16px;
            box-shadow: 0 -4px 14px rgba(0, 0, 0, 0.08);
            z-index: 9998;
            gap: 10px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
            .hero h2 {
                font-size: 34px;
            }
            .hero-photo-frame img {
                height: 380px;
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
            .testimonials-grid-3 {
                grid-template-columns: 1fr;
            }
            .contact-grid {
                grid-template-columns: 1fr;
            }
            .footer-cols-grid {
                grid-template-columns: 1fr;
                gap: 26px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            .header-inner {
                height: 72px;
            }
            .brand-logo-wrap {
                width: 44px;
                height: 44px;
            }
            .brand-title-box h1 {
                font-size: 19px;
            }
            .hero {
                padding: 36px 0 44px;
            }
            .hero h2 {
                font-size: 28px;
            }
            .hero-checkmarks {
                grid-template-columns: 1fr;
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
            .top-strip-inner {
                flex-direction: column;
                align-items: flex-start;
            }
            .floating-wa-btn {
                bottom: 72px;
                right: 18px;
                padding: 10px 16px;
                font-size: 13px;
            }
            .mobile-quick-actions {
                display: flex;
            }
            body {
                padding-bottom: 56px;
            }
        }
    </style>
</head>
<body>

    <!-- Top Announcement Strip -->
    <div class="top-strip">
        <div class="container top-strip-inner">
            <div class="live-admission-badge">
                <span class="live-dot"></span>
                <span>Admissions Open for 2026-2027 · Exclusively for Women & Students</span>
            </div>
            <div class="top-strip-contacts">
                <a href="tel:+918590621496">📞 <strong>+91 85906 21496</strong></a>
                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="color:#bbf7d0;">
                    💬 WhatsApp: <strong>8590621496</strong>
                </a>
                <a href="mailto:sjladieshostel07@gmail.com">✉️ <strong>sjladieshostel07@gmail.com</strong></a>
            </div>
            <div class="top-admin-link">
                @auth
                    <a href="{{ route('dashboard') }}">Admin Dashboard →</a>
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
                <div class="brand-logo-wrap">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo">
                </div>
                <div class="brand-title-box">
                    <h1>SJ <span>Ladies Hostel</span></h1>
                    <p>A Safe & Comfortable Stay for Women 🌸</p>
                </div>
            </a>

            <ul class="nav-menu">
                <li><a href="#photos">Real Photos</a></li>
                <li><a href="#rooms">Rooms & Rates</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#amenities">Amenities</a></li>
                <li><a href="#contact">Location & Visit</a></li>
            </ul>

            <div class="header-actions">
                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="btn btn-wa">
                    <svg viewBox="0 0 24 24" style="width:18px;height:18px;fill:currentColor;"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.399C8.423 21.493 10.15 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                    <span>WhatsApp</span>
                </a>
                <a href="tel:+918590621496" class="btn btn-rose-outline">
                    📞 Call Warden
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section (Clean, Brand-Harmonized First Impression) -->
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <div class="hero-pill">
                    <span class="hero-pill-heart">❤</span>
                    <span>Safe & Comfortable Stay for Women in Kochi</span>
                </div>

                <h2>Experience <span class="pine-word">True Safety</span> & the <span class="rose-word">Warmth of Home</span>.</h2>
                <p class="hero-lead">
                    Thoughtfully organized accommodation across Ground Floor & First Floor. Enjoy attached bathrooms in every room, nutritious 3-times daily home food, high-speed Wi-Fi, and 24/7 CCTV security in a welcoming environment.
                </p>

                <div class="hero-checkmarks">
                    <div class="check-item"><span class="check-icon-circle">✓</span> 3 Nutritious Homely Meals Daily</div>
                    <div class="check-item"><span class="check-icon-circle">✓</span> Attached Bath & Geyser in All Rooms</div>
                    <div class="check-item"><span class="check-icon-circle">✓</span> 2, 4, 5 & 6 Sharing Options</div>
                    <div class="check-item"><span class="check-icon-circle">✓</span> 24/7 CCTV & Resident Warden</div>
                </div>

                <div class="hero-cta-row">
                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20bed%20availability" target="_blank" class="btn btn-wa">
                        💬 Connect on WhatsApp (Instant Reply)
                    </a>
                    <a href="#rooms" class="btn btn-outline">
                        View Available Rooms ↓
                    </a>
                </div>

                <div class="hero-stats-row">
                    <div class="stat-capsule">
                        <div class="stat-num">24</div>
                        <div class="stat-label">Total Beds</div>
                    </div>
                    <div class="stat-capsule">
                        <div class="stat-num">2 Floors</div>
                        <div class="stat-label">Ground & 1st</div>
                    </div>
                    <div class="stat-capsule">
                        <div class="stat-num">3 Meals</div>
                        <div class="stat-label">Daily Home Food</div>
                    </div>
                    <div class="stat-capsule">
                        <div class="stat-num">24/7</div>
                        <div class="stat-label">CCTV Safety</div>
                    </div>
                </div>
            </div>

            <!-- Hero Real Photo Card with Floating Brand Badges -->
            <div class="hero-visual-wrap">
                <div class="floating-pill pill-top">
                    <span class="fp-icon">🛡️</span>
                    <div class="fp-text">
                        <strong>24/7 Safety & Security</strong>
                        <span>CCTV & Female Resident Warden</span>
                    </div>
                </div>

                <div class="hero-photo-frame">
                    <img src="{{ asset('images/building.jpg') }}" alt="SJ Ladies Hostel Exterior Building">
                </div>

                <div class="floating-pill pill-bottom">
                    <span class="fp-icon">🍲</span>
                    <div class="fp-text">
                        <strong>Homely & Tasty Food</strong>
                        <span>Fresh Breakfast, Lunch & Dinner</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Value Pillars -->
    <div class="pillars-section">
        <div class="container pillars-grid">
            <div class="pillar-card">
                <div class="pillar-icon-box">✨</div>
                <div class="pillar-info">
                    <strong>Zero Brokerage</strong>
                    <span>Direct admission with clear rent</span>
                </div>
            </div>
            <div class="pillar-card rose-accent">
                <div class="pillar-icon-box">🚿</div>
                <div class="pillar-info">
                    <strong>Attached Bathrooms</strong>
                    <span>With geyser in all 6 rooms</span>
                </div>
            </div>
            <div class="pillar-card">
                <div class="pillar-icon-box">🍲</div>
                <div class="pillar-info">
                    <strong>With / Without Food</strong>
                    <span>Flexible monthly food choices</span>
                </div>
            </div>
            <div class="pillar-card rose-accent">
                <div class="pillar-icon-box">📍</div>
                <div class="pillar-info">
                    <strong>Prime Location</strong>
                    <span>Quick commute to colleges & offices</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Actual Photos Gallery Showcase -->
    <section id="photos" class="photos-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">ACTUAL HOSTEL PHOTOS</span>
                <h2>Clean, Spacious & Beautifully Kept</h2>
                <p>Take a look at genuine, unedited photos of our independent building, spacious common living hall, and clean modular kitchen.</p>
            </div>

            <div class="photos-grid">
                <!-- Photo 1: Exterior Building -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <span class="photo-tag-pill">EXTERIOR VIEW</span>
                        <img src="{{ asset('images/building.jpg') }}" alt="SJ Ladies Hostel Front View">
                    </div>
                    <div class="photo-card-body">
                        <h3>Hostel Building Exterior</h3>
                        <p>Well-maintained independent building featuring Ground & First Floor rooms, secure balconies, covered rooftop, and a private entrance compound.</p>
                        <div class="photo-specs-box">
                            <span>📍 Two Dedicated Floors</span> · <span>🏢 Total 6 Rooms</span> · <span>🛏️ 24 Beds</span>
                        </div>
                    </div>
                </div>

                <!-- Photo 2: Living Lounge -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <span class="photo-tag-pill" style="background:rgba(212, 91, 115, 0.9);">COMMON AREA</span>
                        <img src="{{ asset('images/hall.jpg') }}" alt="SJ Ladies Hostel Living Hall">
                    </div>
                    <div class="photo-card-body">
                        <h3>Spacious Common Hall & Lounge</h3>
                        <p>Airy and clean living space with comfortable wooden sofa seating, high-speed Wi-Fi, automatic washing machine, and dedicated dining area.</p>
                        <div class="photo-specs-box" style="background:var(--sj-rose-light);color:var(--sj-rose-dark);border-color:var(--sj-rose-border);">
                            <span>🛋️ Wooden Sofas</span> · <span>🧺 Washing Machine</span> · <span>📶 Wi-Fi</span>
                        </div>
                    </div>
                </div>

                <!-- Photo 3: Modular Kitchen -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <span class="photo-tag-pill">HYGIENIC KITCHEN</span>
                        <img src="{{ asset('images/kitchen.jpg') }}" alt="SJ Ladies Hostel Kitchen">
                    </div>
                    <div class="photo-card-body">
                        <h3>Modern Modular Kitchen</h3>
                        <p>Clean and well-ventilated modular kitchen where fresh, delicious, and healthy South & North Indian meals are prepared daily.</p>
                        <div class="photo-specs-box">
                            <span>🍲 3 Daily Meals</span> · <span>💧 RO Filter Water</span> · <span>🥗 Fresh Food</span>
                        </div>
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
                <h2>Ground Floor & First Floor Rooms</h2>
                <p>Choose your room based on floor and sharing preference. All rooms include private attached bathrooms and personal lockable wardrobes.</p>
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
                        <p>Easy access rooms · Peaceful atmosphere · Attached washrooms</p>
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
                                <div class="room-sub-floor">
                                    Ground Floor · Capacity: <strong>{{ $cap }} Members</strong>
                                </div>

                                <div class="room-live-strip">
                                    <span style="color:var(--text-muted);">Availability</span>
                                    <span class="status-dot-wrap {{ $statusClass }}">
                                        <span class="status-circle-dot"></span> {{ $statusText }}
                                    </span>
                                </div>

                                <div class="room-dual-price">
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🍱 With 3 Daily Meals:</span>
                                        <span class="d-price-val {{ $isTwoShare ? 'rose-price' : '' }}">₹{{ number_format($room->monthly_rent) }} <small>/mo</small></span>
                                    </div>
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🏠 Without Food:</span>
                                        <span class="d-price-val" style="color:var(--text-heading);">₹{{ number_format($room->rent_without_food ?? 4200) }} <small>/mo</small></span>
                                    </div>
                                </div>

                                <ul class="room-features-list">
                                    <li><span>✓</span> Attached Bathroom with Geyser</li>
                                    <li><span>✓</span> Personal Lockable Wardrobe with Key</li>
                                    <li><span>✓</span> High-Speed Wi-Fi & Daily Cleaning</li>
                                </ul>

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
                        <p>Well-ventilated sunlit rooms · Balcony breeze · Attached washrooms</p>
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
                                <div class="room-sub-floor">
                                    First Floor · Capacity: <strong>{{ $cap }} Members</strong>
                                </div>

                                <div class="room-live-strip">
                                    <span style="color:var(--text-muted);">Availability</span>
                                    <span class="status-dot-wrap {{ $statusClass }}">
                                        <span class="status-circle-dot"></span> {{ $statusText }}
                                    </span>
                                </div>

                                <div class="room-dual-price">
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🍱 With 3 Daily Meals:</span>
                                        <span class="d-price-val {{ $isTwoShare ? 'rose-price' : '' }}">₹{{ number_format($room->monthly_rent) }} <small>/mo</small></span>
                                    </div>
                                    <div class="dual-price-line">
                                        <span class="d-price-label">🏠 Without Food:</span>
                                        <span class="d-price-val" style="color:var(--text-heading);">₹{{ number_format($room->rent_without_food ?? 4200) }} <small>/mo</small></span>
                                    </div>
                                </div>

                                <ul class="room-features-list">
                                    <li><span>✓</span> Attached Bathroom with Geyser</li>
                                    <li><span>✓</span> Personal Lockable Wardrobe with Key</li>
                                    <li><span>✓</span> Breezy Balcony & Cross Ventilation</li>
                                </ul>

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

    <!-- Transparent Pricing Matrix Table -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">CLEAR & HONEST PRICING</span>
                <h2>Monthly Pricing Matrix</h2>
                <p>Simple and transparent monthly rates. Choose between 3 daily home-cooked meals or room-only plan according to your preference.</p>
            </div>

            <div class="pricing-table-card">
                <table class="pricing-table-clean">
                    <thead>
                        <tr>
                            <th>Sharing Type</th>
                            <th>Allocated Rooms</th>
                            <th>With 3 Meals (Monthly)</th>
                            <th>Without Food (Monthly)</th>
                            <th>Included Amenities</th>
                            <th style="text-align:right;">Book Instantly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Six Sharing</strong></td>
                            <td>Room B1 (First Floor)</td>
                            <td><span class="table-rate-pine">₹6,500</span></td>
                            <td><span class="table-rate-plain">₹4,200</span></td>
                            <td>3 Homely Meals · Attached Bath · Wi-Fi · Housekeeping</td>
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
                            <td>3 Homely Meals · Attached Bath · Wi-Fi · Housekeeping</td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Five%20Sharing%20(Room%20A1%20or%20A2)" target="_blank" class="btn btn-wa btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Four Sharing</strong></td>
                            <td>Room B2 (First Floor)</td>
                            <td><span class="table-rate-pine">₹6,500</span></td>
                            <td><span class="table-rate-plain">₹4,200</span></td>
                            <td>3 Homely Meals · Attached Bath · Wi-Fi · Housekeeping</td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Four%20Sharing%20(Room%20B2)" target="_blank" class="btn btn-wa btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Two Sharing</strong> <span class="room-sharing-tag tag-rose" style="margin-left:6px;">PREMIUM</span></td>
                            <td>Room A3 (Ground Floor), Room B3 (First Floor)</td>
                            <td><span class="table-rate-rose">₹8,600</span></td>
                            <td><span class="table-rate-plain">₹6,500</span></td>
                            <td>Maximum Privacy · Quiet Study Atmosphere · Attached Luxury Bath</td>
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

    <!-- Amenities Grid (8 Clean Cards Harmonized with Pine & Rose) -->
    <section id="amenities" class="amenities-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag rose-tag">EVERYDAY CONVENIENCES</span>
                <h2>Hostel Amenities & Security</h2>
                <p>Carefully managed so you feel completely at home, safe, and free from everyday hassles.</p>
            </div>

            <div class="amenities-grid-8">
                <div class="amenity-card-clean">
                    <div class="amenity-icon-circle">🍲</div>
                    <h4>3 Homely Meals Daily</h4>
                    <p>Nutritious and clean South & North Indian breakfast, lunch, and dinner cooked fresh every day.</p>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-circle">🚿</div>
                    <h4>Attached Bathrooms & Geyser</h4>
                    <p>Private attached washroom in every single room with 24/7 hot and cold water access.</p>
                </div>
                <div class="amenity-card-clean">
                    <div class="amenity-icon-circle">📶</div>
                    <h4>High-Speed Fibre Wi-Fi</h4>
                    <p>Fast, reliable Wi-Fi coverage across all rooms for smooth remote work and online study.</p>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-circle">🧺</div>
                    <h4>Washing Machine & Drying</h4>
                    <p>Dedicated automatic washing machine and open-air drying space for easy laundry.</p>
                </div>
                <div class="amenity-card-clean">
                    <div class="amenity-icon-circle">🛡️</div>
                    <h4>24/7 CCTV & Resident Warden</h4>
                    <p>Round-the-clock camera monitoring and an on-premises caring female warden for complete security.</p>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-circle">🧹</div>
                    <h4>Daily Housekeeping</h4>
                    <p>Daily cleaning and sanitization of rooms, washrooms, and common corridors to maintain top hygiene.</p>
                </div>
                <div class="amenity-card-clean">
                    <div class="amenity-icon-circle">💧</div>
                    <h4>RO Purified Drinking Water</h4>
                    <p>Clean, healthy drinking water available 24/7 through an advanced commercial multi-stage RO filter.</p>
                </div>
                <div class="amenity-card-clean rose-tint">
                    <div class="amenity-icon-circle">🔒</div>
                    <h4>Personal Lockable Wardrobe</h4>
                    <p>Spacious personal steel cupboard with lock and key for your clothes and valuable belongings.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials / Resident Reviews -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">RESIDENT REVIEWS</span>
                <h2>Trusted by Women & Parents</h2>
                <p>Hear what our current residents and their families have to say about their experience at SJ Ladies Hostel.</p>
            </div>

            <div class="testimonials-grid-3">
                <div class="testi-card-box">
                    <div>
                        <div class="testi-stars-row">★ ★ ★ ★ ★</div>
                        <p class="testi-quote-p">
                            "The best part about SJ Ladies Hostel is the homely food and clean atmosphere. Coming from outside Kerala, I felt completely safe and well taken care of by the warden."
                        </p>
                    </div>
                    <div class="testi-user-wrap">
                        <div class="testi-avatar-circle">A</div>
                        <div class="testi-user-details">
                            <strong>Ananya S.</strong>
                            <span>Software Engineer · Infopark</span>
                        </div>
                    </div>
                </div>

                <div class="testi-card-box">
                    <div>
                        <div class="testi-stars-row">★ ★ ★ ★ ★</div>
                        <p class="testi-quote-p">
                            "As a parent, my biggest priority was my daughter's safety and clean food. We visited the hostel before admission, and both the building and the rooms are spotless."
                        </p>
                    </div>
                    <div class="testi-user-wrap">
                        <div class="testi-avatar-circle rose-avatar">M</div>
                        <div class="testi-user-details">
                            <strong>Mathew Thomas</strong>
                            <span>Parent · Kottayam</span>
                        </div>
                    </div>
                </div>

                <div class="testi-card-box">
                    <div>
                        <div class="testi-stars-row">★ ★ ★ ★ ★</div>
                        <p class="testi-quote-p">
                            "Very peaceful study environment with attached bathrooms and super fast Wi-Fi. The Ground Floor rooms are especially convenient and spacious."
                        </p>
                    </div>
                    <div class="testi-user-wrap">
                        <div class="testi-avatar-circle">S</div>
                        <div class="testi-user-details">
                            <strong>Dr. Sneha R.</strong>
                            <span>Postgraduate Medical Student</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Contact / Enquiry Form -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag rose-tag">VISIT & BOOK</span>
                <h2>Location & Direct Enquiry</h2>
                <p>Feel free to reach out directly via WhatsApp, call our warden, or submit the form below to plan a visit.</p>
            </div>

            <div class="contact-grid">
                <!-- Contact Details & Map Card -->
                <div class="contact-info-card">
                    <h3>SJ Ladies Hostel</h3>
                    <p class="intro">Conveniently situated in a peaceful, secure residential area with fast access to bus routes, metro, colleges, and IT parks.</p>

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

                        <div class="contact-link-card rose-border">
                            <span class="cl-icon-box" style="color:var(--sj-rose);">📞</span>
                            <div class="cl-details">
                                <small>Hostel Warden Direct Line</small>
                                <a href="tel:+918590621496">+91 85906 21496</a>
                            </div>
                        </div>

                        <div class="contact-link-card">
                            <span class="cl-icon-box" style="color:var(--sj-pine);">✉️</span>
                            <div class="cl-details">
                                <small>Official Gmail</small>
                                <a href="mailto:sjladieshostel07@gmail.com">sjladieshostel07@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:12px;">
                        <span style="font-size:13px;color:var(--text-muted);">📍 Coordinates: <strong>9.9911476, 76.3189574</strong></span>
                        <a href="https://maps.google.com/maps?q=9.9911476%2C76.3189574&z=17&hl=en" target="_blank" class="btn btn-outline btn-sm">
                            Open in Google Maps App ↗
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
                    <h3>Hostel Admission Enquiry</h3>
                    <p>Fill out the details below and our team will get back to you promptly.</p>

                    @if(session('success'))
                        <div class="alert-success-box">
                            <strong>✓ {{ session('success') }}</strong>
                            @if(session('whatsapp_url'))
                                <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-wa btn-sm" style="align-self:flex-start;">
                                    Open WhatsApp to Confirm Now →
                                </a>
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('enquiry.store') }}" method="POST">
                        @csrf
                        <div class="form-row-grid">
                            <div class="form-field-group">
                                <label for="name">Your Full Name *</label>
                                <input type="text" id="name" name="name" required placeholder="e.g. Ananya Nair" value="{{ old('name') }}">
                            </div>
                            <div class="form-field-group">
                                <label for="phone">Phone / WhatsApp Number *</label>
                                <input type="tel" id="phone" name="phone" required placeholder="10-digit mobile number" value="{{ old('phone') }}">
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
                                    <option value="with_food">With Food (3 Homely Meals)</option>
                                    <option value="without_food">Without Food (Room Only)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field-group">
                            <label for="joining_date">Expected Date of Joining</label>
                            <input type="date" id="joining_date" name="joining_date" value="{{ old('joining_date', today()->toDateString()) }}">
                        </div>

                        <div class="form-field-group">
                            <label for="notes">Additional Requirements or College/Office Info</label>
                            <textarea id="notes" name="notes" placeholder="Tell us if you work shifts, your college or workplace name, or any preferences..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-pine btn-block" style="padding:13px;">
                            Send Booking Enquiry →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Clean Modern Footer with Brand Accents -->
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
                    <p style="color:#8ca395;line-height:1.6;font-size:13px;max-width:340px;">
                        Providing secure, clean, and peaceful living spaces for students and working women across Ground and First Floors.
                    </p>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links-ul">
                        <li><a href="#photos">Real Hostel Photos</a></li>
                        <li><a href="#rooms">Room Availability & Rates</a></li>
                        <li><a href="#pricing">Monthly Pricing Matrix</a></li>
                        <li><a href="#amenities">Hostel Amenities</a></li>
                        <li><a href="#contact">Location & Google Maps</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact & Hours</h4>
                    <ul class="footer-links-ul">
                        <li>Phone: <a href="tel:+918590621496">+91 85906 21496</a></li>
                        <li>WhatsApp: <a href="https://wa.me/918590621496" target="_blank" style="color:#bbf7d0;">8590621496</a></li>
                        <li>Email: <a href="mailto:sjladieshostel07@gmail.com">sjladieshostel07@gmail.com</a></li>
                        <li style="color:#8ca395;margin-top:4px;">Visiting Hours: 8:00 AM – 8:00 PM</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <span>© {{ date('Y') }} SJ Ladies Hostel. All Rights Reserved.</span>
                <span>Coordinates: 9.9911476, 76.3189574</span>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button with Gentle Pulse Ring -->
    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="floating-wa-btn" title="Chat on WhatsApp">
        <svg viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.399C8.423 21.493 10.15 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
        <span>WhatsApp Us</span>
    </a>

    <!-- Mobile Sticky Quick Bar -->
    <div class="mobile-quick-actions">
        <a href="tel:+918590621496" class="btn btn-rose-outline" style="flex:1;">
            📞 Call Warden
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