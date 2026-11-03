<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SJ Ladies Hostel · Safe, Comfortable & Homely Stay for Women</title>
    <meta name="description" content="SJ Ladies Hostel offers safe, premium, and homely accommodation for students and working women. Attached bathrooms, nutritious meals, high-speed Wi-Fi, and 24/7 security.">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2d6a4f;
            --primary-dark: #1b4332;
            --primary-light: #e8f5ed;
            --rose: #d85c74;
            --rose-light: #fef0f3;
            --rose-dark: #b83d54;
            --wa-green: #25d366;
            --wa-dark: #128c7e;
            --bg: #f8f9fa;
            --surface: #ffffff;
            --text-dark: #1a1e24;
            --text-muted: #5e6673;
            --line: #e6e9ee;
            --radius-lg: 16px;
            --radius-md: 10px;
            --shadow-sm: 0 2px 10px rgba(0,0,0,0.04);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg);
            color: var(--text-dark);
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 15px;
            line-height: 1.6;
        }

        h1, h2, h3, h4 {
            font-family: 'Manrope', sans-serif;
            color: var(--text-dark);
            font-weight: 750;
            line-height: 1.25;
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
            padding: 0 20px;
        }

        /* Top Bar */
        .top-bar {
            background: #192720;
            color: #dbe3dd;
            font-size: 13px;
            padding: 8px 0;
        }
        .top-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .top-bar-contacts {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }
        .top-bar-contacts a {
            color: #dbe3dd;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .top-bar-contacts a:hover {
            color: #fff;
        }
        .top-bar-admin a {
            color: #b2d5c3;
            font-weight: 600;
        }
        .top-bar-admin a:hover {
            color: #fff;
        }

        /* Main Header / Navbar */
        .header {
            background: #ffffff;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.03);
        }
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-img {
            height: 58px;
            width: auto;
            border-radius: 8px;
            object-fit: contain;
        }
        .brand-info h1 {
            font-size: 21px;
            letter-spacing: -0.3px;
            color: #1a2e22;
        }
        .brand-info span {
            font-size: 11px;
            font-weight: 600;
            color: var(--rose);
            display: block;
            margin-top: -2px;
            letter-spacing: 0.3px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }
        .nav-menu a {
            font-size: 14px;
            font-weight: 600;
            color: #495057;
        }
        .nav-menu a:hover {
            color: var(--primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Prominent Header WhatsApp Button */
        .btn-header-wa {
            background: #25d366;
            color: #ffffff !important;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 3px 10px rgba(37, 211, 102, 0.3);
            border: 1px solid #1ebd5a;
        }
        .btn-header-wa:hover {
            background: #1ebd5a;
            transform: translateY(-1px);
            box-shadow: 0 5px 14px rgba(37, 211, 102, 0.4);
        }
        .btn-header-wa svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
            flex-shrink: 0;
        }

        .btn-header-call {
            background: var(--primary-light);
            color: var(--primary) !important;
            padding: 9px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #cbe5d5;
        }
        .btn-header-call:hover {
            background: #d8eedf;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }
        .btn-rose {
            background: var(--rose);
            color: #fff;
        }
        .btn-rose:hover {
            background: var(--rose-dark);
            transform: translateY(-1px);
        }
        .btn-wa-action {
            background: var(--wa-green);
            color: #fff;
            border-color: #1ebd5a;
        }
        .btn-wa-action:hover {
            background: #1ebd5a;
        }
        .btn-outline {
            background: #fff;
            border-color: #ced4da;
            color: #495057;
        }
        .btn-outline:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }
        .btn-sm {
            padding: 7px 14px;
            font-size: 12px;
            border-radius: 6px;
        }

        /* Hero Section */
        .hero {
            padding: 45px 0 40px;
            background: #ffffff;
            border-bottom: 1px solid var(--line);
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--rose-light);
            color: var(--rose-dark);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
            margin-bottom: 16px;
            border: 1px solid #f9d3dc;
        }
        .hero-badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--rose);
        }
        .hero h2 {
            font-size: 38px;
            letter-spacing: -0.8px;
            color: #1b281f;
            margin-bottom: 14px;
        }
        .hero p.lead {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 24px;
            line-height: 1.6;
        }
        .hero-highlights {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 28px;
        }
        .highlight-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #2b332c;
        }
        .highlight-item span {
            color: var(--primary);
            font-weight: 800;
        }
        .hero-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* Hero Building Image Frame */
        .hero-image-frame {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--line);
            max-height: 440px;
        }
        .hero-image-frame img {
            width: 100%;
            height: 440px;
            object-fit: cover;
        }
        .hero-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, transparent, rgba(16, 26, 20, 0.88));
            color: #fff;
            padding: 24px 20px 18px;
        }
        .hero-image-overlay strong {
            font-size: 16px;
            display: block;
        }
        .hero-image-overlay span {
            font-size: 12px;
            color: #d1dfd5;
        }

        /* Section Commons */
        section {
            padding: 50px 0;
        }
        .section-header {
            text-align: center;
            max-width: 640px;
            margin: 0 auto 35px;
        }
        .section-tag {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--primary);
            display: block;
            margin-bottom: 6px;
        }
        .section-header h2 {
            font-size: 29px;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }
        .section-header p {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Photo Showcase Section */
        .photos-section {
            background: #ffffff;
            border-bottom: 1px solid var(--line);
        }
        .photos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .photo-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }
        .photo-card-img {
            height: 250px;
            overflow: hidden;
            background: #eef2f0;
        }
        .photo-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .photo-card:hover .photo-card-img img {
            transform: scale(1.03);
        }
        .photo-card-body {
            padding: 18px 20px;
        }
        .photo-card-body h3 {
            font-size: 16px;
            margin-bottom: 4px;
            color: #1a2a1f;
        }
        .photo-card-body p {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Floor Filter Pills */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 30px;
        }
        .filter-btn {
            background: #ffffff;
            border: 1px solid #d5dbdf;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #495057;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        .filter-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 3px 8px rgba(45, 106, 79, 0.2);
        }

        /* Floor Sections */
        .floor-group {
            margin-bottom: 45px;
        }
        .floor-title-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border: 1px solid var(--line);
            border-left: 5px solid var(--primary);
            border-radius: 8px;
            padding: 12px 20px;
            margin-bottom: 20px;
        }
        .floor-title-bar.first-floor {
            border-left-color: var(--rose);
        }
        .floor-title-bar h3 {
            font-size: 18px;
        }
        .floor-title-bar span {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Room Cards Grid */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .room-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 22px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .room-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: #cbd7cf;
        }
        .room-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .room-num {
            font-family: 'Manrope', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #1a2a1f;
        }
        .room-tag {
            font-size: 11px;
            font-weight: 700;
            background: var(--primary-light);
            color: var(--primary);
            padding: 3px 10px;
            border-radius: 6px;
        }
        .room-capacity {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        /* Status & Availability */
        .room-status-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8faf9;
            border: 1px solid #e7ede9;
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 16px;
            font-size: 12px;
        }
        .status-badge {
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-badge.available {
            color: #1b8a5a;
        }
        .status-badge.occupied {
            color: #c97a1d;
        }
        .status-badge.booked {
            color: #c0394b;
        }
        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Pricing Box */
        .room-prices {
            background: #fbfbfc;
            border: 1px solid #ebedf0;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 16px;
        }
        .price-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            padding: 4px 0;
        }
        .price-line:not(:last-child) {
            border-bottom: 1px dashed #e2e5e8;
        }
        .price-line .p-label {
            color: #555b66;
            font-weight: 500;
        }
        .price-line .p-val {
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
            color: #1b2b20;
            font-size: 15px;
        }

        .room-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #505763;
        }
        .room-features li {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .room-features li span {
            color: var(--primary);
            font-weight: 800;
        }

        .room-actions {
            margin-top: auto;
            display: flex;
            gap: 8px;
        }
        .room-actions .btn {
            flex: 1;
        }

        /* Pricing Table Section */
        .pricing-section {
            background: #ffffff;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
        }
        .table-responsive {
            overflow-x: auto;
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }
        table.pricing-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: left;
        }
        table.pricing-table th {
            background: #f4f6f8;
            padding: 14px 18px;
            font-weight: 700;
            color: #3b424d;
            border-bottom: 2px solid #e1e5e9;
        }
        table.pricing-table td {
            padding: 14px 18px;
            border-bottom: 1px solid #edf0f2;
            color: #333940;
        }
        table.pricing-table tr:hover td {
            background: #fafbfc;
        }

        /* Amenities Grid */
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }
        .amenity-item {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 20px 18px;
            text-align: left;
        }
        .amenity-icon {
            font-size: 26px;
            margin-bottom: 10px;
            display: block;
        }
        .amenity-item h4 {
            font-size: 15px;
            margin-bottom: 4px;
        }
        .amenity-item p {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.45;
        }

        /* Contact & Location Section */
        .contact-section {
            background: #fdfdfd;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 30px;
            align-items: start;
        }
        .contact-box {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
        }
        .contact-box h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .contact-box p {
            color: var(--text-muted);
            margin-bottom: 22px;
            font-size: 14px;
        }
        .contact-cards-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 24px;
        }
        .c-item {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #f8f9fa;
            border: 1px solid #eaedf0;
            border-radius: 8px;
            padding: 14px 16px;
        }
        .c-item-icon {
            font-size: 22px;
            flex-shrink: 0;
        }
        .c-item-text small {
            font-size: 11px;
            color: var(--text-muted);
            display: block;
            text-transform: uppercase;
            font-weight: 700;
        }
        .c-item-text a, .c-item-text strong {
            font-size: 15px;
            color: var(--text-dark);
            font-weight: 700;
        }

        /* Map Embed */
        .map-box {
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--line);
            height: 260px;
            margin-top: 20px;
            background: #eef1f3;
        }
        .map-box iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Form Card */
        .form-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
        }
        .form-card h3 {
            font-size: 20px;
            margin-bottom: 6px;
        }
        .form-card p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 14px;
        }
        .field label {
            font-size: 12px;
            font-weight: 700;
            color: #3f4753;
        }
        .field input, .field select, .field textarea {
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 13px;
            font-family: inherit;
            color: #2b303a;
            outline: none;
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.12);
        }
        .field textarea {
            min-height: 80px;
            resize: vertical;
        }

        /* Alert */
        .alert-success {
            background: #e8f7ee;
            border: 1px solid #bfe8ce;
            color: #17653a;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Footer */
        footer {
            background: #192720;
            color: #cedad1;
            padding: 40px 0 25px;
            border-top: 1px solid #23352b;
            font-size: 13px;
        }
        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 20px;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .footer-brand img {
            height: 50px;
            background: #fff;
            padding: 2px;
            border-radius: 6px;
        }
        .footer-contacts a {
            color: #fff;
            font-weight: 700;
        }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #8c9e92;
        }

        /* Floating WhatsApp Button for Mobile & Desktop */
        .floating-wa {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #25d366;
            color: #ffffff !important;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45);
            z-index: 999;
            border: 2px solid #ffffff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .floating-wa:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
        }
        .floating-wa svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }
            .photos-grid {
                grid-template-columns: 1fr;
            }
            .room-grid {
                grid-template-columns: 1fr 1fr;
            }
            .amenities-grid {
                grid-template-columns: 1fr 1fr;
            }
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            .hero h2 {
                font-size: 30px;
            }
            .hero-highlights {
                grid-template-columns: 1fr;
            }
            .room-grid {
                grid-template-columns: 1fr;
            }
            .amenities-grid {
                grid-template-columns: 1fr;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .top-bar-inner {
                flex-direction: column;
                align-items: flex-start;
            }
            .footer-inner, .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    <!-- Top Contact Strip -->
    <div class="top-bar">
        <div class="container top-bar-inner">
            <div class="top-bar-contacts">
                <a href="tel:+918590621496">📞 Call: <strong>+91 85906 21496</strong></a>
                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="color:#6ee7b7;">
                    💬 WhatsApp: <strong>8590621496</strong>
                </a>
                <a href="mailto:sjladieshostel07@gmail.com">✉️ <strong>sjladieshostel07@gmail.com</strong></a>
            </div>
            <div class="top-bar-admin">
                @auth
                    <a href="{{ route('dashboard') }}">🛡️ Go to Admin Dashboard →</a>
                @else
                    <a href="{{ route('login') }}">Staff / Admin Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo" class="brand-img">
                <div class="brand-info">
                    <h1>SJ Ladies Hostel</h1>
                    <span>A Safe & Comfortable Stay for Women</span>
                </div>
            </a>

            <ul class="nav-menu">
                <li><a href="#photos">Actual Photos</a></li>
                <li><a href="#rooms">Rooms & Rates</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#amenities">Amenities</a></li>
                <li><a href="#contact">Location</a></li>
            </ul>

            <div class="header-actions">
                <!-- PROMINENT HEADER WHATSAPP BUTTON -->
                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="btn-header-wa">
                    <svg viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.399C8.423 21.493 10.15 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                    <span>WhatsApp: 8590621496</span>
                </a>
                <a href="tel:+918590621496" class="btn-header-call">
                    📞 Call Now
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section with Building Photo -->
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    Exclusively for Ladies & Working Women
                </div>
                <h2>A Safe, Comfortable & Homely Stay at <strong>SJ Ladies Hostel</strong></h2>
                <p class="lead">
                    Thoughtfully designed accommodation across Ground Floor and First Floor with attached bathrooms, delicious home-cooked meals, high-speed Wi-Fi, and 24/7 security.
                </p>

                <div class="hero-highlights">
                    <div class="highlight-item"><span>✓</span> 3 Nutritious Homely Meals Daily</div>
                    <div class="highlight-item"><span>✓</span> Attached Bathrooms & Geyser</div>
                    <div class="highlight-item"><span>✓</span> 2, 4, 5 & 6 Sharing Options</div>
                    <div class="highlight-item"><span>✓</span> 24/7 CCTV & Resident Warden</div>
                </div>

                <div class="hero-buttons">
                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20bed%20availability" target="_blank" class="btn btn-wa-action">
                        💬 Connect on WhatsApp (8590621496)
                    </a>
                    <a href="#rooms" class="btn btn-outline">
                        View Available Rooms ↓
                    </a>
                </div>
            </div>

            <!-- Building Exterior Photo Card -->
            <div class="hero-image-frame">
                <img src="{{ asset('images/building.jpg') }}" alt="SJ Ladies Hostel Building Exterior">
                <div class="hero-image-overlay">
                    <strong>SJ Ladies Hostel Building</strong>
                    <span>Ground & First Floor · Total 24 Beds · Safe & Clean Environment</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Actual Photos Showcase Section -->
    <section id="photos" class="photos-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">ACTUAL HOSTEL PHOTOS</span>
                <h2>Clean, Spacious & Well-Maintained</h2>
                <p>Take a look at the real photos of our hostel premises, common living area, and hygienic kitchen.</p>
            </div>

            <div class="photos-grid">
                <!-- Photo 1: Building Exterior -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <img src="{{ asset('images/building.jpg') }}" alt="SJ Ladies Hostel Front View">
                    </div>
                    <div class="photo-card-body">
                        <h3>Hostel Building Exterior</h3>
                        <p>Well-constructed independent building with Ground & First Floor rooms, secure balconies, covered rooftop, and a private entrance.</p>
                    </div>
                </div>

                <!-- Photo 2: Living Hall & Lounge -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <img src="{{ asset('images/hall.jpg') }}" alt="SJ Ladies Hostel Living Hall">
                    </div>
                    <div class="photo-card-body">
                        <h3>Spacious Common Hall & Lounge</h3>
                        <p>Airy and clean living space with comfortable wooden sofa seating, high-speed Wi-Fi, automatic washing machine, and dining area.</p>
                    </div>
                </div>

                <!-- Photo 3: Hygienic Kitchen -->
                <div class="photo-card">
                    <div class="photo-card-img">
                        <img src="{{ asset('images/kitchen.jpg') }}" alt="SJ Ladies Hostel Kitchen">
                    </div>
                    <div class="photo-card-body">
                        <h3>Hygienic Modern Kitchen</h3>
                        <p>Clean and well-ventilated modular kitchen where fresh, healthy South & North Indian breakfast, lunch, and dinner are prepared daily.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Room Structure & Live Availability -->
    <section id="rooms">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">HOSTEL ROOM STRUCTURE</span>
                <h2>Ground Floor & First Floor Rooms</h2>
                <p>Select your preferred room. All rooms include attached bathrooms, individual wardrobes, and flexible meal plans.</p>
            </div>

            <!-- Floor Filter Tabs -->
            <div class="filter-tabs">
                <button class="filter-btn active" onclick="showFloor('all', this)">All Rooms (6)</button>
                <button class="filter-btn" onclick="showFloor('ground', this)">Ground Floor (A1, A2, A3)</button>
                <button class="filter-btn" onclick="showFloor('first', this)">First Floor (B1, B2, B3)</button>
            </div>

            <!-- GROUND FLOOR -->
            <div class="floor-group" id="floor-ground">
                <div class="floor-title-bar">
                    <div>
                        <h3>Ground Floor Rooms</h3>
                        <span>Easy access · Quiet rooms · Attached bathrooms</span>
                    </div>
                    <span>Rooms: A1, A2, A3</span>
                </div>

                <div class="room-grid">
                    @if($groundFloor)
                        @foreach($groundFloor->rooms as $room)
                            @php
                                $avail = $room->available;
                                $cap = $room->capacity;
                                $statusClass = $avail === 0 ? 'booked' : ($avail < $cap ? 'occupied' : 'available');
                                $statusText = $avail === 0 ? 'Fully Booked' : ($avail < $cap ? $avail.' Beds Available' : 'Available');
                            @endphp
                            <div class="room-card">
                                <div class="room-card-top">
                                    <div class="room-num">Room {{ $room->number }}</div>
                                    <span class="room-tag">{{ $room->sharing_label }}</span>
                                </div>
                                <div class="room-capacity">Ground Floor · Capacity: <strong>{{ $cap }} Members</strong></div>

                                <div class="room-status-strip">
                                    <span>Status</span>
                                    <span class="status-badge {{ $statusClass }}">
                                        <span class="dot"></span> {{ $statusText }}
                                    </span>
                                </div>

                                <div class="room-prices">
                                    <div class="price-line">
                                        <span class="p-label">🍱 With Food:</span>
                                        <span class="p-val">₹{{ number_format($room->monthly_rent) }} <small style="font-size:11px;font-weight:400;color:#6c757d;">/mo</small></span>
                                    </div>
                                    <div class="price-line">
                                        <span class="p-label">🏠 Without Food:</span>
                                        <span class="p-val">₹{{ number_format($room->rent_without_food ?? 4200) }} <small style="font-size:11px;font-weight:400;color:#6c757d;">/mo</small></span>
                                    </div>
                                </div>

                                <ul class="room-features">
                                    <li><span>✓</span> Attached Bathroom with Geyser</li>
                                    <li><span>✓</span> Personal Lockable Cupboard</li>
                                    <li><span>✓</span> Wi-Fi, Electricity & Cleaning</li>
                                </ul>

                                <div class="room-actions">
                                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20book%20a%20bed%20in%20Room%20{{ $room->number }}%20({{ $room->sharing_label }}%2C%20Ground%20Floor)" target="_blank" class="btn btn-wa-action btn-sm">
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
                <div class="floor-title-bar first-floor">
                    <div>
                        <h3>First Floor Rooms</h3>
                        <span>Bright, ventilated & balcony rooms · Attached bathrooms</span>
                    </div>
                    <span>Rooms: B1, B2, B3</span>
                </div>

                <div class="room-grid">
                    @if($firstFloor)
                        @foreach($firstFloor->rooms as $room)
                            @php
                                $avail = $room->available;
                                $cap = $room->capacity;
                                $statusClass = $avail === 0 ? 'booked' : ($avail < $cap ? 'occupied' : 'available');
                                $statusText = $avail === 0 ? 'Fully Booked' : ($avail < $cap ? $avail.' Beds Available' : 'Available');
                            @endphp
                            <div class="room-card">
                                <div class="room-card-top">
                                    <div class="room-num">Room {{ $room->number }}</div>
                                    <span class="room-tag" style="background:var(--rose-light);color:var(--rose-dark);">{{ $room->sharing_label }}</span>
                                </div>
                                <div class="room-capacity">First Floor · Capacity: <strong>{{ $cap }} Members</strong></div>

                                <div class="room-status-strip">
                                    <span>Status</span>
                                    <span class="status-badge {{ $statusClass }}">
                                        <span class="dot"></span> {{ $statusText }}
                                    </span>
                                </div>

                                <div class="room-prices">
                                    <div class="price-line">
                                        <span class="p-label">🍱 With Food:</span>
                                        <span class="p-val">₹{{ number_format($room->monthly_rent) }} <small style="font-size:11px;font-weight:400;color:#6c757d;">/mo</small></span>
                                    </div>
                                    <div class="price-line">
                                        <span class="p-label">🏠 Without Food:</span>
                                        <span class="p-val">₹{{ number_format($room->rent_without_food ?? 4200) }} <small style="font-size:11px;font-weight:400;color:#6c757d;">/mo</small></span>
                                    </div>
                                </div>

                                <ul class="room-features">
                                    <li><span>✓</span> Attached Bathroom with Geyser</li>
                                    <li><span>✓</span> Personal Lockable Cupboard</li>
                                    <li><span>✓</span> Fresh Air Balcony & Sunlight</li>
                                </ul>

                                <div class="room-actions">
                                    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20book%20a%20bed%20in%20Room%20{{ $room->number }}%20({{ $room->sharing_label }}%2C%20First%20Floor)" target="_blank" class="btn btn-wa-action btn-sm">
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

    <!-- Simple Pricing Table -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">CLEAR & AFFORDABLE RATES</span>
                <h2>Monthly Room Pricing</h2>
                <p>Simple and transparent monthly fee structure. Choose between 3 daily meals or room-only option.</p>
            </div>

            <div class="table-responsive">
                <table class="pricing-table">
                    <thead>
                        <tr>
                            <th>Sharing Type</th>
                            <th>Room Numbers</th>
                            <th>With Food (Monthly)</th>
                            <th>Without Food (Monthly)</th>
                            <th>Included Amenities</th>
                            <th style="text-align:right;">Book Instantly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Six Sharing</strong></td>
                            <td>Room B1 (First Floor)</td>
                            <td><strong style="color:var(--primary);font-size:16px;">₹6,500</strong></td>
                            <td><strong style="color:#495057;font-size:15px;">₹4,200</strong></td>
                            <td>Breakfast, Lunch & Dinner · Attached Bath · Wi-Fi</td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Six%20Sharing%20(Room%20B1)" target="_blank" class="btn btn-wa-action btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Five Sharing</strong></td>
                            <td>Room A1, Room A2 (Ground Floor)</td>
                            <td><strong style="color:var(--primary);font-size:16px;">₹6,500</strong></td>
                            <td><strong style="color:#495057;font-size:15px;">₹4,200</strong></td>
                            <td>Breakfast, Lunch & Dinner · Attached Bath · Wi-Fi</td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Five%20Sharing%20(Room%20A1%20or%20A2)" target="_blank" class="btn btn-wa-action btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Four Sharing</strong></td>
                            <td>Room B2 (First Floor)</td>
                            <td><strong style="color:var(--primary);font-size:16px;">₹6,500</strong></td>
                            <td><strong style="color:#495057;font-size:15px;">₹4,200</strong></td>
                            <td>Breakfast, Lunch & Dinner · Attached Bath · Wi-Fi</td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Four%20Sharing%20(Room%20B2)" target="_blank" class="btn btn-wa-action btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Two Sharing</strong></td>
                            <td>Room A3 (Ground Floor), Room B3 (First Floor)</td>
                            <td><strong style="color:var(--rose-dark);font-size:16px;">₹8,600</strong></td>
                            <td><strong style="color:#495057;font-size:15px;">₹6,500</strong></td>
                            <td>Maximum Privacy · Quiet Study · Attached Bath</td>
                            <td style="text-align:right;">
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20want%20to%20enquire%20about%20Two%20Sharing%20(Room%20A3%20or%20B3)" target="_blank" class="btn btn-wa-action btn-sm">
                                    WhatsApp
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section id="amenities">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">EVERYDAY CONVENIENCES</span>
                <h2>Hostel Amenities & Security</h2>
                <p>Everything taken care of so you feel comfortable, safe, and right at home.</p>
            </div>

            <div class="amenities-grid">
                <div class="amenity-item">
                    <span class="amenity-icon">🍲</span>
                    <h4>3 Homely Meals Daily</h4>
                    <p>Hygienic South & North Indian breakfast, lunch, and dinner prepared fresh in our kitchen.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🚿</span>
                    <h4>Attached Bathrooms & Geyser</h4>
                    <p>Clean private attached washrooms for every room with hot and cold running water.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">📶</span>
                    <h4>High-Speed Wi-Fi</h4>
                    <p>Fast and reliable internet connectivity across all rooms for your study and work needs.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🧺</span>
                    <h4>Washing Machine</h4>
                    <p>Washing machine facility and open-air clothes drying area available for all residents.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🛡️</span>
                    <h4>24/7 CCTV & Security</h4>
                    <p>Complete camera surveillance at gates and corridors with on-premises female warden.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🧹</span>
                    <h4>Daily Housekeeping</h4>
                    <p>Regular daily cleaning of rooms, corridors, and common spaces to maintain top hygiene.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">💧</span>
                    <h4>RO Purified Water</h4>
                    <p>Safe, clean drinking water available 24/7 through commercial multi-stage RO filtration.</p>
                </div>
                <div class="amenity-item">
                    <span class="amenity-icon">🔒</span>
                    <h4>Personal Wardrobe & Key</h4>
                    <p>Dedicated lockable storage cupboard for every resident's clothes and personal belongings.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">GET IN TOUCH & VISIT</span>
                <h2>Contact & Location</h2>
                <p>Reach out directly on WhatsApp or call our warden anytime to schedule a visit.</p>
            </div>

            <div class="contact-grid">
                <!-- Contact Info & Map -->
                <div class="contact-box">
                    <h3>SJ Ladies Hostel</h3>
                    <p>Safe, peaceful and well-connected location for women students and working professionals.</p>

                    <div class="contact-cards-list">
                        <div class="c-item">
                            <span class="c-item-icon">💬</span>
                            <div class="c-item-text">
                                <small>Chat on WhatsApp (Fastest Reply)</small>
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="color:var(--wa-dark);">
                                    +91 85906 21496 (Click to Chat) →
                                </a>
                            </div>
                        </div>

                        <div class="c-item">
                            <span class="c-item-icon">📞</span>
                            <div class="c-item-text">
                                <small>Warden Phone / Direct Call</small>
                                <a href="tel:+918590621496">+91 85906 21496</a>
                            </div>
                        </div>

                        <div class="c-item">
                            <span class="c-item-icon">✉️</span>
                            <div class="c-item-text">
                                <small>Official Gmail</small>
                                <a href="mailto:sjladieshostel07@gmail.com">sjladieshostel07@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                        <span style="font-size:13px;color:var(--text-muted);">📍 Coordinates: <strong>9.9911476, 76.3189574</strong></span>
                        <a href="https://maps.google.com/maps?q=9.9911476%2C76.3189574&z=17&hl=en" target="_blank" class="btn btn-outline btn-sm">
                            Open in Google Maps App ↗
                        </a>
                    </div>

                    <div class="map-box">
                        <iframe
                            src="https://maps.google.com/maps?q=9.9911476,76.3189574&z=17&hl=en&output=embed"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Simple Enquiry Form -->
                <div class="form-card">
                    <h3>Hostel Enquiry Form</h3>
                    <p>Leave your details and we will get back to you promptly.</p>

                    @if(session('success'))
                        <div class="alert-success">
                            <strong>✓ {{ session('success') }}</strong>
                            @if(session('whatsapp_url'))
                                <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-wa-action btn-sm" style="align-self:flex-start;">
                                    Open WhatsApp to Confirm Now →
                                </a>
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('enquiry.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="field">
                                <label for="name">Your Name *</label>
                                <input type="text" id="name" name="name" required placeholder="Full Name" value="{{ old('name') }}">
                            </div>
                            <div class="field">
                                <label for="phone">Phone / WhatsApp *</label>
                                <input type="tel" id="phone" name="phone" required placeholder="10-digit Mobile" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="field">
                                <label for="room_number">Preferred Room</label>
                                <select id="room_number" name="room_number">
                                    <option value="">-- Any Room --</option>
                                    <option value="A1">Room A1 (Five Sharing - Ground)</option>
                                    <option value="A2">Room A2 (Five Sharing - Ground)</option>
                                    <option value="A3">Room A3 (Two Sharing - Ground)</option>
                                    <option value="B1">Room B1 (Six Sharing - First)</option>
                                    <option value="B2">Room B2 (Four Sharing - First)</option>
                                    <option value="B3">Room B3 (Two Sharing - First)</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="food_preference">Meal Preference</label>
                                <select id="food_preference" name="food_preference">
                                    <option value="with_food">With Food (3 Meals)</option>
                                    <option value="without_food">Without Food</option>
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label for="joining_date">Expected Joining Date</label>
                            <input type="date" id="joining_date" name="joining_date" value="{{ old('joining_date', today()->toDateString()) }}">
                        </div>

                        <div class="field">
                            <label for="notes">Notes or Questions</label>
                            <textarea id="notes" name="notes" placeholder="College name, office location, shift timings, etc.">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width:100%;">
                            Submit Enquiry →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-brand">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo">
                    <div>
                        <strong style="font-size:16px;color:#fff;display:block;">SJ Ladies Hostel</strong>
                        <span style="font-size:12px;color:#8ba494;">A Safe & Comfortable Stay for Women</span>
                    </div>
                </div>

                <div class="footer-contacts">
                    <span>Warden: <a href="tel:+918590621496">+91 85906 21496</a></span> ·
                    <span>WhatsApp: <a href="https://wa.me/918590621496" target="_blank" style="color:#6ee7b7;">8590621496</a></span> ·
                    <span>Email: <a href="mailto:sjladieshostel07@gmail.com">sjladieshostel07@gmail.com</a></span>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© {{ date('Y') }} SJ Ladies Hostel. All Rights Reserved.</span>
                <span>Ground & First Floor Accommodation for Women</span>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button (Bottom-Right) -->
    <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" class="floating-wa" title="Chat on WhatsApp">
        <svg viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.399C8.423 21.493 10.15 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
        <span>WhatsApp Us</span>
    </a>

    <script>
        function showFloor(type, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
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

        function selectRoom(roomNumber, sharingType) {
            const rSelect = document.getElementById('room_number');
            if (rSelect) rSelect.value = roomNumber;
            const cSec = document.getElementById('contact');
            if (cSec) cSec.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>
