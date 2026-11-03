<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SJ Ladies Hostel · Safe, Comfortable & Premium Living for Women</title>
    <meta name="description" content="Welcome to SJ Ladies Hostel. Premium accommodation for students and working women with modern amenities, attached bathrooms, homely food, high security, and flexible sharing options on Ground and First Floors.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Manrope:wght@400..800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #7860ce;
            --primary-dark: #5e46b5;
            --primary-light: #f3f0fc;
            --rose: #d97087;
            --rose-light: #fdf2f4;
            --rose-border: #f8cfd7;
            --bg: #faf9fd;
            --surface: #ffffff;
            --text-main: #23212c;
            --text-muted: #6e6a7c;
            --line: #ebe8f3;
            --green: #2e9f75;
            --green-light: #ecf8f3;
            --amber: #d0902c;
            --amber-light: #fdf7eb;
            --radius-lg: 20px;
            --radius-md: 14px;
            --radius-sm: 8px;
            --shadow-subtle: 0 4px 20px rgba(120, 96, 206, 0.06);
            --shadow-card: 0 10px 30px rgba(70, 50, 110, 0.08);
            --shadow-hover: 0 16px 40px rgba(120, 96, 206, 0.14);
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
            color: var(--text-main);
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 {
            font-family: 'Manrope', sans-serif;
            color: var(--text-main);
            font-weight: 750;
            line-height: 1.25;
        }

        .serif {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 600;
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

        /* Container */
        .container {
            width: 100%;
            max-width: 1220px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        /* Top Announcement Bar */
        .top-notice {
            background: linear-gradient(90deg, #7860ce, #d97087);
            color: #ffffff;
            font-size: 13px;
            font-weight: 500;
            padding: 8px 16px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }
        .top-notice a {
            color: #fff;
            text-decoration: underline;
            font-weight: 600;
        }

        /* Header / Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.2s;
        }
        .nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 78px;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--rose));
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(120, 96, 206, 0.25);
        }
        .brand-text h1 {
            font-size: 20px;
            letter-spacing: -0.4px;
            color: #231f32;
        }
        .brand-text span {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: var(--rose);
            display: block;
            margin-top: -2px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            list-style: none;
        }
        .nav-links a {
            font-size: 14px;
            font-weight: 600;
            color: #555062;
            padding: 6px 0;
            position: relative;
        }
        .nav-links a:hover {
            color: var(--primary);
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(120, 96, 206, 0.25);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 18px rgba(120, 96, 206, 0.35);
            transform: translateY(-1px);
        }
        .btn-rose {
            background: var(--rose);
            color: #fff;
            box-shadow: 0 4px 14px rgba(217, 112, 135, 0.25);
        }
        .btn-rose:hover {
            background: #c75a72;
            transform: translateY(-1px);
        }
        .btn-outline {
            border-color: #d8d4e7;
            background: #fff;
            color: #524d61;
        }
        .btn-outline:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary);
        }
        .btn-sm {
            padding: 7px 15px;
            font-size: 12px;
            border-radius: 6px;
        }
        .btn-lg {
            padding: 14px 28px;
            font-size: 15px;
            border-radius: 10px;
        }

        /* Hero Section */
        .hero {
            padding: 65px 0 55px;
            position: relative;
            overflow: hidden;
        }
        .hero-bg-blobs {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(217, 112, 135, 0.12) 0%, rgba(120, 96, 206, 0.06) 60%, transparent 80%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 40px;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: #fbf2f4;
            border: 1px solid var(--rose-border);
            border-radius: 30px;
            color: var(--rose);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .hero-badge-dot {
            width: 7px;
            height: 7px;
            background: var(--rose);
            border-radius: 50%;
        }
        .hero h2 {
            font-size: 46px;
            line-height: 1.15;
            letter-spacing: -1.2px;
            margin-bottom: 18px;
            color: #1e192c;
        }
        .hero h2 span.gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--rose) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p.lead {
            font-size: 17px;
            color: var(--text-muted);
            margin-bottom: 30px;
            line-height: 1.65;
            max-width: 540px;
        }
        .hero-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 38px;
            flex-wrap: wrap;
        }
        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }
        .hero-stat-card strong {
            font-family: 'Manrope', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
            display: block;
        }
        .hero-stat-card span {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Hero Visual Card */
        .hero-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-card);
            position: relative;
        }
        .hero-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--line);
        }
        .hero-card-header h3 {
            font-size: 17px;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
        }
        .status-pill.available {
            background: var(--green-light);
            color: var(--green);
        }
        .status-pill.occupied {
            background: var(--amber-light);
            color: var(--amber);
        }
        .status-pill.booked {
            background: var(--rose-light);
            color: var(--rose);
        }
        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .hero-floor-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 22px;
        }
        .floor-box {
            background: #fbfbfe;
            border: 1px solid #e9e6f3;
            border-radius: var(--radius-md);
            padding: 16px;
        }
        .floor-box h4 {
            font-size: 13px;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .floor-box p {
            font-size: 12px;
            color: var(--text-muted);
        }
        .floor-box strong {
            font-size: 18px;
            color: var(--text-main);
            display: block;
            margin-top: 4px;
        }

        .highlight-features {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 18px;
        }
        .highlight-features li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #4a4557;
            font-weight: 500;
        }
        .highlight-features li i {
            color: var(--green);
            font-style: normal;
            font-weight: 700;
        }

        /* Section Headings */
        .section-header {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 45px;
        }
        .section-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--rose);
            text-transform: uppercase;
            display: block;
            margin-bottom: 8px;
        }
        .section-header h2 {
            font-size: 32px;
            letter-spacing: -0.6px;
            margin-bottom: 12px;
        }
        .section-header p {
            font-size: 15px;
            color: var(--text-muted);
        }

        /* Section Layouts */
        section {
            padding: 60px 0;
        }
        .section-light {
            background: #ffffff;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
        }

        /* Floor Navigation Tabs */
        .floor-nav-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
        }
        .floor-tabs {
            background: #f0eef8;
            padding: 5px;
            border-radius: 12px;
            display: inline-flex;
            gap: 6px;
        }
        .floor-tab-btn {
            background: transparent;
            border: none;
            padding: 10px 22px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            color: #656075;
            cursor: pointer;
            transition: all 0.2s;
        }
        .floor-tab-btn:hover {
            color: var(--primary);
        }
        .floor-tab-btn.active {
            background: #ffffff;
            color: var(--primary);
            box-shadow: 0 4px 12px rgba(120, 96, 206, 0.12);
        }

        /* Floor Sections */
        .floor-block {
            margin-bottom: 50px;
        }
        .floor-badge-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #f7f4fc, #fef4f6);
            border: 1px solid #eae5f5;
            border-radius: var(--radius-md);
            padding: 16px 24px;
            margin-bottom: 24px;
        }
        .floor-badge-header h3 {
            font-size: 19px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .floor-tag {
            background: var(--primary);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }
        .floor-stat-badge {
            font-size: 13px;
            color: #5d576c;
            font-weight: 600;
        }

        /* Room Cards Grid */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .room-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-subtle);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: #d6ccf2;
        }

        .room-card-head {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #f2eff8;
            background: linear-gradient(180deg, #ffffff, #faf9fe);
            position: relative;
        }
        .room-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .room-number-badge {
            font-family: 'Manrope', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #211c2e;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .room-number-badge span {
            color: var(--primary);
        }
        .room-sharing-pill {
            font-size: 11px;
            font-weight: 700;
            color: var(--primary);
            background: var(--primary-light);
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .room-card-head p.room-floor-subtitle {
            font-size: 12px;
            color: var(--text-muted);
        }

        .room-card-body {
            padding: 22px 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Availability Bar */
        .room-availability-block {
            background: #fdfdfe;
            border: 1px solid #ece8f5;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }
        .availability-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 600;
        }
        .bed-counter {
            color: var(--primary);
        }
        .progress-track {
            height: 7px;
            background: #eeebf6;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--rose));
            border-radius: 10px;
            transition: width 0.3s;
        }

        /* Visual Bed Badges */
        .beds-layout-preview {
            display: flex;
            gap: 6px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .bed-badge-item {
            width: 34px;
            height: 38px;
            border-radius: 6px;
            border: 1.5px solid #dfd8ed;
            background: #fbfafd;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: #6a637a;
            position: relative;
        }
        .bed-badge-item.available {
            border-color: #8ed3b7;
            background: #f1fbf6;
            color: var(--green);
        }
        .bed-badge-item.occupied {
            border-color: #f1b3c1;
            background: #fff4f6;
            color: var(--rose);
        }
        .bed-badge-item small {
            font-size: 7px;
            text-transform: uppercase;
            line-height: 1;
            margin-top: 1px;
        }

        /* Pricing Block */
        .room-pricing-box {
            background: linear-gradient(135deg, #fbfafd, #fefbfc);
            border: 1px solid #ebe5f5;
            border-radius: var(--radius-md);
            padding: 16px;
            margin-bottom: 20px;
        }
        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 0;
        }
        .price-row:not(:last-child) {
            border-bottom: 1px dashed #e6e0f2;
        }
        .price-label {
            font-size: 12px;
            font-weight: 500;
            color: #555064;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .price-label i {
            color: var(--primary);
            font-style: normal;
        }
        .price-amount {
            font-family: 'Manrope', sans-serif;
            font-size: 17px;
            font-weight: 800;
            color: #241e30;
        }
        .price-amount small {
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Room Specs / Features */
        .room-features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 12px;
            color: #5a5468;
        }
        .room-features-list li {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .room-features-list li span.check-icon {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #edf7f2;
            color: var(--green);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .room-card-actions {
            margin-top: auto;
            display: flex;
            gap: 10px;
        }
        .room-card-actions .btn {
            flex: 1;
        }

        /* Pricing Section */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }
        .pricing-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 30px 24px;
            box-shadow: var(--shadow-subtle);
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.25s;
        }
        .pricing-card.featured {
            border-color: var(--rose);
            box-shadow: 0 12px 35px rgba(217, 112, 135, 0.16);
            transform: scale(1.02);
        }
        .featured-tag {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--rose);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 12px rgba(217, 112, 135, 0.35);
        }
        .pricing-card h3 {
            font-size: 20px;
            margin-bottom: 6px;
        }
        .pricing-card p.tier-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 22px;
            min-height: 38px;
        }
        .price-highlight {
            background: #fbf9fe;
            border: 1px solid #eae5f5;
            border-radius: var(--radius-md);
            padding: 16px;
            margin-bottom: 24px;
        }
        .price-highlight .option {
            margin-bottom: 10px;
        }
        .price-highlight .option:last-child {
            margin-bottom: 0;
            padding-top: 10px;
            border-top: 1px dashed #e4dfef;
        }
        .price-highlight .label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #726b80;
            font-weight: 700;
        }
        .price-highlight .value {
            font-family: 'Manrope', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
        }
        .price-highlight .value.without-food {
            font-size: 20px;
            color: #4a4558;
        }
        .price-highlight .value small {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
        }

        .pricing-perks {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 26px;
            flex: 1;
            font-size: 12px;
            color: #4e495a;
        }
        .pricing-perks li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
        }
        .pricing-perks li i {
            color: var(--green);
            font-style: normal;
            font-weight: 700;
            margin-top: 2px;
        }

        /* Facilities & Safety Section */
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }
        .amenity-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 24px 20px;
            text-align: left;
            transition: all 0.2s;
        }
        .amenity-card:hover {
            border-color: #d8cff3;
            transform: translateY(-3px);
            box-shadow: var(--shadow-subtle);
        }
        .amenity-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f6f2fc, #faeef1);
            color: var(--primary);
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .amenity-card h4 {
            font-size: 16px;
            margin-bottom: 6px;
        }
        .amenity-card p {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Safety Highlights Strip */
        .safety-banner {
            background: linear-gradient(135deg, #2a2240, #382436);
            color: #fff;
            border-radius: var(--radius-lg);
            padding: 40px;
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 30px;
            align-items: center;
        }
        .safety-banner h3 {
            color: #fff;
            font-size: 26px;
            margin-bottom: 10px;
        }
        .safety-banner p {
            color: #cbbede;
            font-size: 14px;
        }
        .safety-badges-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .safety-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            padding: 12px 16px;
        }
        .safety-item-icon {
            font-size: 20px;
            color: #f7a6b7;
        }
        .safety-item-text strong {
            display: block;
            font-size: 13px;
        }
        .safety-item-text small {
            font-size: 11px;
            color: #b7a9cb;
        }

        /* Booking / Enquiry Form Section */
        .booking-section {
            background: linear-gradient(180deg, #fbfaff, #f6f3fb);
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
        }
        .booking-grid {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 40px;
            align-items: start;
        }
        .booking-info h3 {
            font-size: 28px;
            margin-bottom: 12px;
        }
        .booking-info p {
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 30px;
        }
        .contact-pill-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 30px;
        }
        .contact-pill {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 16px 20px;
            box-shadow: var(--shadow-subtle);
        }
        .contact-pill-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .contact-pill-text small {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            display: block;
        }
        .contact-pill-text strong {
            font-size: 15px;
            color: var(--text-main);
        }

        /* The Form Card */
        .form-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 36px;
            box-shadow: var(--shadow-card);
        }
        .form-card h4 {
            font-size: 20px;
            margin-bottom: 6px;
        }
        .form-card p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .form-group-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }
        .form-field.full {
            grid-column: 1 / -1;
        }
        .form-field label {
            font-size: 12px;
            font-weight: 600;
            color: #4a4557;
        }
        .form-field input, .form-field select, .form-field textarea {
            padding: 11px 14px;
            border: 1px solid #dcd7e8;
            border-radius: 8px;
            font-size: 13px;
            color: #2b2738;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
            background: #fdfdfd;
        }
        .form-field input:focus, .form-field select:focus, .form-field textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(120, 96, 206, 0.12);
            background: #fff;
        }
        .form-field textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* Success Alert */
        .alert-success {
            background: #eef9f4;
            border: 1px solid #cceade;
            color: #247554;
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Location / Map Section */
        .location-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 30px;
            align-items: center;
        }
        .map-frame-box {
            background: #e9e5f4;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--line);
            height: 380px;
            position: relative;
        }
        .map-frame-box iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
        .location-details {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 34px;
            box-shadow: var(--shadow-subtle);
        }
        .location-details h3 {
            font-size: 22px;
            margin-bottom: 12px;
        }
        .location-details p {
            color: var(--text-muted);
            margin-bottom: 24px;
        }
        .landmarks-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            font-size: 13px;
        }
        .landmarks-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #4b4657;
        }
        .landmarks-list li i {
            color: var(--rose);
            font-style: normal;
            font-size: 16px;
        }

        /* FAQ Section */
        .faq-grid {
            max-width: 840px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .faq-item {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .faq-item:hover {
            border-color: #d7ceef;
        }
        .faq-question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15px;
            font-weight: 700;
            color: #2b253b;
        }
        .faq-question span.toggle-icon {
            font-size: 18px;
            color: var(--primary);
            transition: transform 0.2s;
        }
        .faq-answer {
            margin-top: 10px;
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.6;
            display: none;
        }
        .faq-item.open .faq-answer {
            display: block;
        }
        .faq-item.open .faq-question span.toggle-icon {
            transform: rotate(45deg);
        }

        /* Footer */
        footer {
            background: #1d182b;
            color: #e2dceb;
            padding: 60px 0 30px;
            border-top: 1px solid #2e2642;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
            gap: 40px;
            margin-bottom: 45px;
        }
        .footer-col h4 {
            color: #ffffff;
            font-size: 15px;
            margin-bottom: 18px;
            letter-spacing: 0.5px;
        }
        .footer-col p {
            font-size: 13px;
            color: #a79cb7;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .footer-links a {
            font-size: 13px;
            color: #a79cb7;
        }
        .footer-links a:hover {
            color: #ffffff;
            padding-left: 4px;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: #8c809e;
        }

        /* Modal Dialog */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(22, 16, 36, 0.65);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 520px;
            padding: 32px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        }
        .modal-close-btn {
            position: absolute;
            top: 18px;
            right: 20px;
            background: #f4f1fa;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 16px;
            color: #555066;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Admin bar if logged in */
        .admin-topbar {
            background: #1e192c;
            color: #ffffff;
            padding: 8px 24px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-topbar a {
            color: #e4c278;
            font-weight: 700;
            margin-left: 12px;
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }
            .room-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .pricing-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .amenities-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .booking-grid {
                grid-template-columns: 1fr;
            }
            .location-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .hero h2 {
                font-size: 32px;
            }
            .room-grid {
                grid-template-columns: 1fr;
            }
            .pricing-grid {
                grid-template-columns: 1fr;
            }
            .amenities-grid {
                grid-template-columns: 1fr;
            }
            .safety-banner {
                grid-template-columns: 1fr;
                padding: 24px;
            }
            .safety-badges-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .form-group-grid {
                grid-template-columns: 1fr;
            }
            .footer-bottom {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    @auth
        <div class="admin-topbar">
            <span>🛡️ Logged in as <strong>{{ auth()->user()->name }}</strong> (Administrator)</span>
            <div>
                <a href="{{ route('dashboard') }}">Go to Admin Dashboard →</a>
                <a href="{{ route('rooms.index') }}" style="margin-left:14px;color:#d5c5fd;">Manage Rooms</a>
            </div>
        </div>
    @endauth

    <!-- Announcement Bar -->
    <div class="top-notice">
        <span>✨ Welcome to <strong>SJ Ladies Hostel</strong> · Bookings open for 2026 academic & corporate admissions!</span>
        <a href="#rooms">View Rooms & Pricing</a>
    </div>

    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="container nav-content">
            <a href="{{ route('home') }}" class="brand-logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo" class="brand-logo-img" style="height:56px;width:auto;border-radius:10px;object-fit:contain;background:#ffffff;padding:2px;box-shadow:0 3px 10px rgba(0,0,0,0.06);border:1px solid #f0edf7;">
                <div class="brand-text">
                    <h1>SJ Ladies Hostel</h1>
                    <span>A Safe & Comfortable Stay for Women</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#rooms">Room Details</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#facilities">Hostel Amenities</a></li>
                <li><a href="#booking">Book Now</a></li>
                <li><a href="#location">Location</a></li>
            </ul>

            <div class="nav-actions">
                <a href="#booking" class="btn btn-rose btn-sm">Enquire Now</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Admin Login</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg-blobs"></div>
        <div class="container hero-grid">
            <div class="hero-text-col">
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    Exclusively for Ladies & Working Women
                </div>
                <h2>A Safe, Elegant & Warm Home at <span class="gradient-text">SJ Ladies Hostel</span></h2>
                <p class="lead">
                    Thoughtfully designed rooms across Ground and First Floors with modern attached bathrooms, high-speed Wi-Fi, 3 nutritious home-cooked meals, and round-the-clock security.
                </p>

                <div class="hero-actions">
                    <a href="#rooms" class="btn btn-primary btn-lg">Explore Available Beds →</a>
                    <a href="#booking" class="btn btn-outline btn-lg">Book a Visit / Enquire</a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat-card">
                        <strong>2 Floors</strong>
                        <span>Ground & First Floor</span>
                    </div>
                    <div class="hero-stat-card">
                        <strong>6 Rooms</strong>
                        <span>2, 4, 5 & 6 Sharing</span>
                    </div>
                    <div class="hero-stat-card">
                        <strong>{{ $availableBeds }} Beds Free</strong>
                        <span>Out of {{ $totalBeds }} total spaces</span>
                    </div>
                </div>
            </div>

            <!-- Quick Live Availability Card -->
            <div class="hero-card">
                <div class="hero-card-header">
                    <div>
                        <h3>Live Hostel Occupancy</h3>
                        <p style="font-size:12px;color:var(--text-muted);">Real-time floor & bed status</p>
                    </div>
                    <span class="status-pill available">
                        <span class="pulse-dot"></span> Available for Booking
                    </span>
                </div>

                <div class="hero-floor-summary">
                    <div class="floor-box">
                        <h4>Ground Floor</h4>
                        <p>Rooms A1, A2, A3</p>
                        <strong>{{ $groundFloor?->rooms->sum('available') ?? 0 }} Beds Open</strong>
                    </div>
                    <div class="floor-box">
                        <h4>First Floor</h4>
                        <p>Rooms B1, B2, B3</p>
                        <strong>{{ $firstFloor?->rooms->sum('available') ?? 0 }} Beds Open</strong>
                    </div>
                </div>

                <div style="font-size:13px;font-weight:700;margin-bottom:8px;">Included with every stay:</div>
                <ul class="highlight-features">
                    <li><i>✓</i> 3 Homely Meals Daily</li>
                    <li><i>✓</i> Attached Bathrooms</li>
                    <li><i>✓</i> 24/7 CCTV & Security</li>
                    <li><i>✓</i> Daily Room Cleaning</li>
                    <li><i>✓</i> High-Speed Wi-Fi</li>
                    <li><i>✓</i> RO Purified Water</li>
                </ul>

                <div style="margin-top:24px;">
                    <a href="#rooms" class="btn btn-primary btn-sm" style="width:100%;">View Room Structure & Pricing ↓</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms & Availability Section -->
    <section id="rooms" class="section-light">
        <div class="container">
            <div class="section-header">
                <span class="section-eyebrow">ROOM STRUCTURE & AVAILABILITY</span>
                <h2>Floor-wise Room Options</h2>
                <p>Choose between Ground Floor and First Floor. Every room is designed for comfort, quiet study, and restful living.</p>
            </div>

            <!-- Floor Selector Pills -->
            <div class="floor-nav-wrapper">
                <div class="floor-tabs">
                    <button class="floor-tab-btn active" onclick="filterFloors('all', this)">All Rooms (6)</button>
                    <button class="floor-tab-btn" onclick="filterFloors('ground', this)">Ground Floor (A1, A2, A3)</button>
                    <button class="floor-tab-btn" onclick="filterFloors('first', this)">First Floor (B1, B2, B3)</button>
                </div>
            </div>

            <!-- ================= GROUND FLOOR ================= -->
            <div class="floor-block" id="floor-section-ground">
                <div class="floor-badge-header">
                    <div>
                        <h3>
                            <span class="floor-tag">FLOOR 0</span>
                            Ground Floor Rooms
                        </h3>
                        <p style="font-size:12px;color:var(--text-muted);margin-top:3px;">Easy ground-level access, quiet atmosphere, and close to dining area.</p>
                    </div>
                    <div class="floor-stat-badge">
                        <span>Total Rooms: <strong>3</strong> · Rooms A1, A2, A3</span>
                    </div>
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
                            <article class="room-card">
                                <div class="room-card-head">
                                    <div class="room-header-top">
                                        <div class="room-number-badge">
                                            Room <span>{{ $room->number }}</span>
                                        </div>
                                        <span class="room-sharing-pill">{{ $room->sharing_label }}</span>
                                    </div>
                                    <p class="room-floor-subtitle">Ground Floor · Capacity: <strong>{{ $cap }} Members</strong></p>
                                </div>

                                <div class="room-card-body">
                                    <!-- Availability Bar -->
                                    <div class="room-availability-block">
                                        <div class="availability-row">
                                            <span>Availability Status</span>
                                            <span class="status-pill {{ $statusClass }}">
                                                <span class="pulse-dot"></span> {{ $statusText }}
                                            </span>
                                        </div>
                                        <div class="progress-track">
                                            <div class="progress-bar-fill" style="width: {{ $cap ? round(($room->occupied / $cap) * 100) : 0 }}%;"></div>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--text-muted);margin-top:6px;">
                                            <span>{{ $room->occupied }} Occupied</span>
                                            <strong class="bed-counter">{{ $avail }} Available Beds</strong>
                                        </div>
                                    </div>

                                    <!-- Visual Bed Icons -->
                                    <div style="font-size:11px;font-weight:600;color:#6b6479;margin-bottom:6px;">Bed Layout ({{ $cap }} Beds):</div>
                                    <div class="beds-layout-preview">
                                        @foreach($room->beds as $bed)
                                            <div class="bed-badge-item {{ $bed->effective_status }}" title="Bed {{ $bed->name }}: {{ ucfirst($bed->effective_status) }}">
                                                <span>{{ $bed->name }}</span>
                                                <small>{{ substr($bed->effective_status, 0, 3) }}</small>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pricing Box -->
                                    <div class="room-pricing-box">
                                        <div class="price-row">
                                            <span class="price-label"><i>🍱</i> Monthly Rent (With Food):</span>
                                            <span class="price-amount">₹{{ number_format($room->monthly_rent) }} <small>/mo</small></span>
                                        </div>
                                        <div class="price-row">
                                            <span class="price-label"><i>🏠</i> Monthly Rent (Without Food):</span>
                                            <span class="price-amount">₹{{ number_format($room->rent_without_food ?? 4200) }} <small>/mo</small></span>
                                        </div>
                                    </div>

                                    <!-- Features List -->
                                    <ul class="room-features-list">
                                        <li><span class="check-icon">✓</span> Attached Modern Bathroom & Geyser</li>
                                        <li><span class="check-icon">✓</span> Individual Lockable Wardrobe & Storage</li>
                                        <li><span class="check-icon">✓</span> Quality Mattress, Bed & Study Table</li>
                                        <li><span class="check-icon">✓</span> High-Speed Wi-Fi & Daily Housekeeping</li>
                                    </ul>

                                    <div class="room-card-actions">
                                        @if($avail > 0)
                                            <button class="btn btn-rose btn-sm" onclick="openBookingModal('{{ $room->number }}', '{{ $room->sharing_label }}', 'Ground Floor')">
                                                Book Bed in {{ $room->number }} →
                                            </button>
                                        @else
                                            <button class="btn btn-outline btn-sm" onclick="openBookingModal('{{ $room->number }}', '{{ $room->sharing_label }}', 'Ground Floor')">
                                                Enquire for Next Vacancy
                                            </button>
                                        @endif
                                        <a href="#booking" class="btn btn-outline btn-sm" onclick="prefillBooking('{{ $room->number }}', '{{ $room->sharing_label }}')">Enquire</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- ================= FIRST FLOOR ================= -->
            <div class="floor-block" id="floor-section-first">
                <div class="floor-badge-header">
                    <div>
                        <h3>
                            <span class="floor-tag" style="background:var(--rose);">FLOOR 1</span>
                            First Floor Rooms
                        </h3>
                        <p style="font-size:12px;color:var(--text-muted);margin-top:3px;">Bright, well-ventilated rooms with private balconies and excellent cross ventilation.</p>
                    </div>
                    <div class="floor-stat-badge">
                        <span>Total Rooms: <strong>3</strong> · Rooms B1, B2, B3</span>
                    </div>
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
                            <article class="room-card">
                                <div class="room-card-head">
                                    <div class="room-header-top">
                                        <div class="room-number-badge">
                                            Room <span>{{ $room->number }}</span>
                                        </div>
                                        <span class="room-sharing-pill">{{ $room->sharing_label }}</span>
                                    </div>
                                    <p class="room-floor-subtitle">First Floor · Capacity: <strong>{{ $cap }} Members</strong></p>
                                </div>

                                <div class="room-card-body">
                                    <!-- Availability Bar -->
                                    <div class="room-availability-block">
                                        <div class="availability-row">
                                            <span>Availability Status</span>
                                            <span class="status-pill {{ $statusClass }}">
                                                <span class="pulse-dot"></span> {{ $statusText }}
                                            </span>
                                        </div>
                                        <div class="progress-track">
                                            <div class="progress-bar-fill" style="width: {{ $cap ? round(($room->occupied / $cap) * 100) : 0 }}%;"></div>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--text-muted);margin-top:6px;">
                                            <span>{{ $room->occupied }} Occupied</span>
                                            <strong class="bed-counter">{{ $avail }} Available Beds</strong>
                                        </div>
                                    </div>

                                    <!-- Visual Bed Icons -->
                                    <div style="font-size:11px;font-weight:600;color:#6b6479;margin-bottom:6px;">Bed Layout ({{ $cap }} Beds):</div>
                                    <div class="beds-layout-preview">
                                        @foreach($room->beds as $bed)
                                            <div class="bed-badge-item {{ $bed->effective_status }}" title="Bed {{ $bed->name }}: {{ ucfirst($bed->effective_status) }}">
                                                <span>{{ $bed->name }}</span>
                                                <small>{{ substr($bed->effective_status, 0, 3) }}</small>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pricing Box -->
                                    <div class="room-pricing-box">
                                        <div class="price-row">
                                            <span class="price-label"><i>🍱</i> Monthly Rent (With Food):</span>
                                            <span class="price-amount">₹{{ number_format($room->monthly_rent) }} <small>/mo</small></span>
                                        </div>
                                        <div class="price-row">
                                            <span class="price-label"><i>🏠</i> Monthly Rent (Without Food):</span>
                                            <span class="price-amount">₹{{ number_format($room->rent_without_food ?? 4200) }} <small>/mo</small></span>
                                        </div>
                                    </div>

                                    <!-- Features List -->
                                    <ul class="room-features-list">
                                        <li><span class="check-icon">✓</span> Attached Modern Bathroom & Geyser</li>
                                        <li><span class="check-icon">✓</span> Individual Lockable Wardrobe & Storage</li>
                                        <li><span class="check-icon">✓</span> Sunny Balcony & Fresh Air Ventilation</li>
                                        <li><span class="check-icon">✓</span> High-Speed Wi-Fi & Daily Housekeeping</li>
                                    </ul>

                                    <div class="room-card-actions">
                                        @if($avail > 0)
                                            <button class="btn btn-rose btn-sm" onclick="openBookingModal('{{ $room->number }}', '{{ $room->sharing_label }}', 'First Floor')">
                                                Book Bed in {{ $room->number }} →
                                            </button>
                                        @else
                                            <button class="btn btn-outline btn-sm" onclick="openBookingModal('{{ $room->number }}', '{{ $room->sharing_label }}', 'First Floor')">
                                                Enquire for Next Vacancy
                                            </button>
                                        @endif
                                        <a href="#booking" class="btn btn-outline btn-sm" onclick="prefillBooking('{{ $room->number }}', '{{ $room->sharing_label }}')">Enquire</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Transparent Pricing Section -->
    <section id="pricing">
        <div class="container">
            <div class="section-header">
                <span class="section-eyebrow">TRANSPARENT & AFFORDABLE RATES</span>
                <h2>Monthly Room Pricing</h2>
                <p>Simple, honest rates with zero hidden charges. Choose either our complete package with delicious food or the room-only option.</p>
            </div>

            <div class="pricing-grid">
                @foreach($pricingTiers as $tier)
                    <div class="pricing-card {{ $tier['sharing'] === 'Five Sharing' ? 'featured' : '' }}">
                        @if($tier['sharing'] === 'Five Sharing')
                            <div class="featured-tag">Most Popular</div>
                        @endif
                        <h3>{{ $tier['sharing'] }}</h3>
                        <p class="tier-desc">{{ $tier['description'] }}</p>

                        <div class="price-highlight">
                            <div class="option">
                                <div class="label">With Food (3 Meals)</div>
                                <div class="value">₹{{ number_format($tier['with_food']) }} <small>/month</small></div>
                            </div>
                            <div class="option">
                                <div class="label">Without Food</div>
                                <div class="value without-food">₹{{ number_format($tier['without_food']) }} <small>/month</small></div>
                            </div>
                        </div>

                        <div style="font-size:11px;font-weight:700;color:#6b6478;margin-bottom:8px;text-transform:uppercase;">Included Features:</div>
                        <ul class="pricing-perks">
                            @foreach($tier['features'] as $feature)
                                <li><i>✓</i> <span>{{ $feature }}</span></li>
                            @endforeach
                        </ul>

                        <button class="btn {{ $tier['sharing'] === 'Five Sharing' ? 'btn-rose' : 'btn-primary' }}" onclick="prefillBooking('', '{{ $tier['sharing'] }}')">
                            Choose {{ $tier['sharing'] }} →
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Pricing Comparison Table for Visitors -->
            <div style="margin-top:45px;background:#ffffff;border:1px solid var(--line);border-radius:var(--radius-lg);padding:28px;box-shadow:var(--shadow-subtle);">
                <h3 style="font-size:18px;margin-bottom:14px;color:#282338;">Quick Pricing Comparison Table</h3>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:13px;text-align:left;">
                        <thead>
                            <tr style="background:#f6f3fb;border-bottom:2px solid #e7e0f4;color:#5c5470;">
                                <th style="padding:12px 16px;">Sharing Type</th>
                                <th style="padding:12px 16px;">Room Numbers</th>
                                <th style="padding:12px 16px;">With Food (Monthly)</th>
                                <th style="padding:12px 16px;">Without Food (Monthly)</th>
                                <th style="padding:12px 16px;">Food Details</th>
                                <th style="padding:12px 16px;text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid #f0ecf6;">
                                <td style="padding:14px 16px;font-weight:700;color:var(--primary);">Six Sharing</td>
                                <td style="padding:14px 16px;">Room B1 (First Floor)</td>
                                <td style="padding:14px 16px;font-weight:700;color:#231f32;">₹6,500</td>
                                <td style="padding:14px 16px;font-weight:700;color:#595267;">₹4,200</td>
                                <td style="padding:14px 16px;color:var(--text-muted);">Breakfast, Lunch & Dinner included</td>
                                <td style="padding:14px 16px;text-align:right;">
                                    <button class="btn btn-outline btn-sm" onclick="prefillBooking('B1', 'Six Sharing')">Book Now</button>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid #f0ecf6;background:#fdfcfd;">
                                <td style="padding:14px 16px;font-weight:700;color:var(--rose);">Five Sharing</td>
                                <td style="padding:14px 16px;">Room A1, Room A2 (Ground Floor)</td>
                                <td style="padding:14px 16px;font-weight:700;color:#231f32;">₹6,500</td>
                                <td style="padding:14px 16px;font-weight:700;color:#595267;">₹4,200</td>
                                <td style="padding:14px 16px;color:var(--text-muted);">Breakfast, Lunch & Dinner included</td>
                                <td style="padding:14px 16px;text-align:right;">
                                    <button class="btn btn-outline btn-sm" onclick="prefillBooking('A1', 'Five Sharing')">Book Now</button>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid #f0ecf6;">
                                <td style="padding:14px 16px;font-weight:700;color:var(--primary);">Four Sharing</td>
                                <td style="padding:14px 16px;">Room B2 (First Floor)</td>
                                <td style="padding:14px 16px;font-weight:700;color:#231f32;">₹6,500</td>
                                <td style="padding:14px 16px;font-weight:700;color:#595267;">₹4,200</td>
                                <td style="padding:14px 16px;color:var(--text-muted);">Breakfast, Lunch & Dinner included</td>
                                <td style="padding:14px 16px;text-align:right;">
                                    <button class="btn btn-outline btn-sm" onclick="prefillBooking('B2', 'Four Sharing')">Book Now</button>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid #f0ecf6;background:#fdfcfd;">
                                <td style="padding:14px 16px;font-weight:700;color:#9b425b;">Two Sharing</td>
                                <td style="padding:14px 16px;">Room A3 (Ground Floor), Room B3 (First Floor)</td>
                                <td style="padding:14px 16px;font-weight:700;color:#231f32;">₹8,600</td>
                                <td style="padding:14px 16px;font-weight:700;color:#595267;">₹6,500</td>
                                <td style="padding:14px 16px;color:var(--text-muted);">Breakfast, Lunch & Dinner included</td>
                                <td style="padding:14px 16px;text-align:right;">
                                    <button class="btn btn-outline btn-sm" onclick="prefillBooking('A3', 'Two Sharing')">Book Now</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities & Amenities Section -->
    <section id="facilities" class="section-light">
        <div class="container">
            <div class="section-header">
                <span class="section-eyebrow">DESIGNED FOR WOMEN'S COMFORT</span>
                <h2>Hostel Amenities & Conveniences</h2>
                <p>Everything you need to focus on your studies and career while we take care of all housekeeping, meals, and safety.</p>
            </div>

            <div class="amenities-grid">
                <div class="amenity-card">
                    <div class="amenity-icon">🍲</div>
                    <h4>Nutritious Homely Food</h4>
                    <p>Hygienic 3 times daily meals prepared with high-grade ingredients. South & North Indian varieties with tea/coffee.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">🚿</div>
                    <h4>Attached Bathrooms & Geyser</h4>
                    <p>Clean private attached washrooms for every room with 24/7 hot and cold running water.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">📶</div>
                    <h4>High-Speed Optical Wi-Fi</h4>
                    <p>Dedicated high-bandwidth internet connectivity throughout Ground and First Floors for online classes and work-from-home.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">🧹</div>
                    <h4>Daily Housekeeping</h4>
                    <p>Professional daily room cleaning, corridor sanitization, and regular trash disposal by trained female staff.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">💧</div>
                    <h4>RO Purified Drinking Water</h4>
                    <p>Multi-stage commercial RO filtration plant providing pure, safe drinking water 24/7.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">🧺</div>
                    <h4>Washing Machine & Drying</h4>
                    <p>Automatic washing machines available for residents with open-air terrace clothes drying area.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">⚡</div>
                    <h4>24/7 Power Backup</h4>
                    <p>Uninterrupted power supply for lighting, Wi-Fi, and study areas during local power outages.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon">🔒</div>
                    <h4>Individual Wardrobes</h4>
                    <p>Spacious personal lockers with safety keys for clothes, laptops, valuables, and luggage storage.</p>
                </div>
            </div>

            <!-- Safety Banner -->
            <div class="safety-banner">
                <div>
                    <h3>Your Safety is Our Highest Priority</h3>
                    <p>SJ Ladies Hostel provides a strictly monitored, secure sanctuary where parents can rest assured of their daughters' well-being.</p>
                </div>
                <div class="safety-badges-grid">
                    <div class="safety-item">
                        <span class="safety-item-icon">📹</span>
                        <div class="safety-item-text">
                            <strong>24/7 CCTV Surveillance</strong>
                            <small>Full gate & corridor coverage</small>
                        </div>
                    </div>
                    <div class="safety-item">
                        <span class="safety-item-icon">👩‍💼</span>
                        <div class="safety-item-text">
                            <strong>Resident Female Warden</strong>
                            <small>Always available on-premises</small>
                        </div>
                    </div>
                    <div class="safety-item">
                        <span class="safety-item-icon">🛡️</span>
                        <div class="safety-item-text">
                            <strong>Biometric / Secure Entry</strong>
                            <small>Strict visitor verification</small>
                        </div>
                    </div>
                    <div class="safety-item">
                        <span class="safety-item-icon">🚨</span>
                        <div class="safety-item-text">
                            <strong>Emergency Support</strong>
                            <small>Doctor on call & first aid</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking & Enquiry Section -->
    <section id="booking" class="booking-section">
        <div class="container">
            <div class="booking-grid">
                <div class="booking-info">
                    <span class="section-eyebrow">RESERVE YOUR SPACE</span>
                    <h3>Book Your Bed or Enquire Today</h3>
                    <p>Fill out the simple enquiry form, or reach out to our hostel warden directly via phone or WhatsApp. We will help you pick the best room suited for you.</p>

                    <div class="contact-pill-list">
                        <div class="contact-pill">
                            <div class="contact-pill-icon">📞</div>
                            <div class="contact-pill-text">
                                <small>Call Direct / Warden Contact</small>
                                <a href="tel:+918590621496" style="color:var(--text-main);font-weight:700;">+91 85906 21496</a>
                            </div>
                        </div>
                        <div class="contact-pill">
                            <div class="contact-pill-icon" style="background:#eaf8f0;color:#25d366;">💬</div>
                            <div class="contact-pill-text">
                                <small>WhatsApp Support</small>
                                <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="color:var(--primary);font-weight:700;">
                                    Chat on WhatsApp (+91 85906 21496) →
                                </a>
                            </div>
                        </div>
                        <div class="contact-pill">
                            <div class="contact-pill-icon">✉️</div>
                            <div class="contact-pill-text">
                                <small>Official Gmail</small>
                                <a href="mailto:sjladieshostel07@gmail.com" style="color:var(--text-main);font-weight:700;">sjladieshostel07@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div style="background:#ffffff;border:1px solid var(--line);border-radius:var(--radius-md);padding:20px;">
                        <h4 style="font-size:14px;margin-bottom:6px;">Visiting Hours for Parents & Students:</h4>
                        <p style="font-size:12px;color:var(--text-muted);margin-bottom:0;">Monday to Sunday: <strong>9:00 AM – 7:30 PM</strong>. Please carry a valid photo ID card for gate entry.</p>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="form-card">
                    <h4>Hostel Room Enquiry Form</h4>
                    <p>Select your preferred room & meal plan. Our team will verify live availability and confirm your booking.</p>

                    @if(session('success'))
                        <div class="alert-success">
                            <strong>✓ {{ session('success') }}</strong>
                            @if(session('whatsapp_url'))
                                <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-rose btn-sm" style="align-self:flex-start;">
                                    Open in WhatsApp to Speed Up Booking →
                                </a>
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('enquiry.store') }}" method="POST" id="enquiry-form">
                        @csrf
                        <div class="form-group-grid">
                            <div class="form-field">
                                <label for="form_name">Full Name *</label>
                                <input type="text" id="form_name" name="name" required placeholder="e.g. Priya Sharma" value="{{ old('name') }}">
                            </div>
                            <div class="form-field">
                                <label for="form_phone">Mobile / WhatsApp Number *</label>
                                <input type="tel" id="form_phone" name="phone" required placeholder="e.g. 9876543210" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-group-grid">
                            <div class="form-field">
                                <label for="form_email">Email Address (Optional)</label>
                                <input type="email" id="form_email" name="email" placeholder="e.g. priya@gmail.com" value="{{ old('email') }}">
                            </div>
                            <div class="form-field">
                                <label for="form_date">Expected Joining Date</label>
                                <input type="date" id="form_date" name="joining_date" value="{{ old('joining_date', today()->toDateString()) }}">
                            </div>
                        </div>

                        <div class="form-group-grid">
                            <div class="form-field">
                                <label for="form_room">Preferred Room</label>
                                <select id="form_room" name="room_number" onchange="syncSharingFromRoom(this.value)">
                                    <option value="">-- Select Room (Optional) --</option>
                                    <optgroup label="Ground Floor">
                                        <option value="A1" @selected(old('room_number')==='A1')>Room A1 (Five Sharing)</option>
                                        <option value="A2" @selected(old('room_number')==='A2')>Room A2 (Five Sharing)</option>
                                        <option value="A3" @selected(old('room_number')==='A3')>Room A3 (Two Sharing)</option>
                                    </optgroup>
                                    <optgroup label="First Floor">
                                        <option value="B1" @selected(old('room_number')==='B1')>Room B1 (Six Sharing)</option>
                                        <option value="B2" @selected(old('room_number')==='B2')>Room B2 (Four Sharing)</option>
                                        <option value="B3" @selected(old('room_number')==='B3')>Room B3 (Two Sharing)</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="form_sharing">Sharing Preference</label>
                                <select id="form_sharing" name="sharing_type">
                                    <option value="">-- Select Sharing --</option>
                                    <option value="Two Sharing">Two Sharing (₹8,600 / ₹6,500)</option>
                                    <option value="Four Sharing">Four Sharing (₹6,500 / ₹4,200)</option>
                                    <option value="Five Sharing">Five Sharing (₹6,500 / ₹4,200)</option>
                                    <option value="Six Sharing">Six Sharing (₹6,500 / ₹4,200)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="form_food">Meal Plan</label>
                            <select id="form_food" name="food_preference">
                                <option value="with_food" @selected(old('food_preference')==='with_food')>With Food (3 Nutritious Meals Daily)</option>
                                <option value="without_food" @selected(old('food_preference')==='without_food')>Without Food (Room Only)</option>
                            </select>
                        </div>

                        <div class="form-field full">
                            <label for="form_notes">Any Message or Special Requests</label>
                            <textarea id="form_notes" name="notes" placeholder="e.g. College name, working shifts, or preferred bed position...">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-rose btn-lg" style="width:100%;">
                            Submit Booking Enquiry →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Landmarks Section -->
    <section id="location">
        <div class="container">
            <div class="section-header">
                <span class="section-eyebrow">CONVENIENT & CENTRAL</span>
                <h2>Hostel Location & Access</h2>
                <p>Located in a safe, prime neighborhood with immediate proximity to major IT tech parks, universities, and metro transit stations.</p>
            </div>

            <div class="location-grid">
                <div class="map-frame-box">
                    <iframe
                        src="https://maps.google.com/maps?q=9.9911476,76.3189574&z=17&hl=en&output=embed"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="location-details">
                    <h3>SJ Ladies Hostel</h3>
                    <p style="font-size:14px;color:var(--text-main);margin-bottom:12px;"><strong>Google Maps Coordinates:</strong> 9.9911476, 76.3189574</p>

                    <h4 style="font-size:14px;margin-bottom:12px;color:var(--primary);">Contact & Visiting Details:</h4>
                    <ul class="landmarks-list">
                        <li><i>📞</i> Phone: <a href="tel:+918590621496" style="font-weight:700;color:var(--primary);">+91 85906 21496</a></li>
                        <li><i>✉️</i> Email: <a href="mailto:sjladieshostel07@gmail.com" style="font-weight:700;color:var(--primary);">sjladieshostel07@gmail.com</a></li>
                        <li><i>💬</i> WhatsApp: <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20I%20would%20like%20to%20enquire%20about%20room%20availability" target="_blank" style="font-weight:700;color:var(--green);">+91 85906 21496</a></li>
                        <li><i>📍</i> Safe, peaceful and well-lit residential street</li>
                    </ul>

                    <div style="margin-top:24px;display:flex;gap:12px;flex-wrap:wrap;">
                        <a href="https://maps.google.com/maps?q=9.9911476%2C76.3189574&z=17&hl=en" target="_blank" class="btn btn-primary btn-sm">Open in Google Maps ↗</a>
                        <a href="https://wa.me/918590621496?text=Hi%20SJ%20Ladies%20Hostel%2C%20can%20you%20please%20share%20directions%20to%20the%20hostel%3F" target="_blank" class="btn btn-outline btn-sm">Ask Directions on WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Frequently Asked Questions -->
    <section class="section-light">
        <div class="container">
            <div class="section-header">
                <span class="section-eyebrow">HELP & CLARIFICATIONS</span>
                <h2>Frequently Asked Questions</h2>
                <p>Common questions asked by prospective residents and parents.</p>
            </div>

            <div class="faq-grid">
                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>What are the food timings and menu at SJ Ladies Hostel?</span>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        We serve breakfast (7:30 AM – 9:30 AM), lunch (12:30 PM – 2:30 PM, with lunch box packing option for students and working women), and dinner (7:30 PM – 9:30 PM). Food is freshly prepared daily with seasonal vegetables, quality spices, and varied North and South Indian menus.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Can I choose the "Without Food" option?</span>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Yes! We offer a clear "Without Food" pricing tier: ₹4,200/month for Six, Five, and Four Sharing, and ₹6,500/month for Two Sharing.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>What is the hostel gate closing time?</span>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Normal gate closing time is 10:00 PM. For working professionals with late shifts or students attending late classes, late entry is permitted with prior notice to the warden and parent consent.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>What documents are required for check-in?</span>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Residents need to provide a government ID proof (Aadhaar Card, Passport, or Voter ID), college/company ID card, two passport-sized photographs, and parent/guardian contact details.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Is there a security deposit?</span>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        A nominal refundable security deposit is collected at check-in. It is refunded at the time of checkout in accordance with the hostel agreement terms.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-col">
                <div class="brand-logo" style="margin-bottom:16px;">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SJ Ladies Hostel Logo" style="height:60px;width:auto;border-radius:10px;background:#ffffff;padding:3px;box-shadow:0 4px 12px rgba(0,0,0,0.2);">
                    <div class="brand-text">
                        <h1 style="color:#fff;">SJ Ladies Hostel</h1>
                        <span style="color:#f29aa9;">A Safe & Comfortable Stay for Women</span>
                    </div>
                </div>
                <p>A safe, comfortable, and modern home for students and working professionals. Thoughtfully operated with care, cleanliness, and security.</p>
                <div style="font-size:12px;color:#a598b7;line-height:1.8;">
                    Warden Phone: <a href="tel:+918590621496" style="color:#fff;font-weight:700;">+91 85906 21496</a><br>
                    Email: <a href="mailto:sjladieshostel07@gmail.com" style="color:#f29aa9;font-weight:600;">sjladieshostel07@gmail.com</a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#rooms">Room Details & Beds</a></li>
                    <li><a href="#pricing">Monthly Pricing</a></li>
                    <li><a href="#facilities">Hostel Amenities</a></li>
                    <li><a href="#booking">Book Now / Enquire</a></li>
                    <li><a href="#location">Location & Directions</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Room Sharing Options</h4>
                <ul class="footer-links">
                    <li><a href="#rooms">Two Sharing (A3, B3)</a></li>
                    <li><a href="#rooms">Four Sharing (B2)</a></li>
                    <li><a href="#rooms">Five Sharing (A1, A2)</a></li>
                    <li><a href="#rooms">Six Sharing (B1)</a></li>
                    <li><a href="#rooms">Ground & First Floor</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Management Portal</h4>
                <p>Authorized staff and administrators can access the hostel dashboard to manage bed allocations, rents, receipts, and residents.</p>
                <a href="{{ route('login') }}" class="btn btn-outline btn-sm" style="background:rgba(255,255,255,0.08);border-color:rgba(255,255,255,0.18);color:#fff;">
                    Admin Portal Login →
                </a>
            </div>
        </div>

        <div class="container footer-bottom">
            <span>© {{ date('Y') }} <strong>SJ Ladies Hostel</strong>. All Rights Reserved.</span>
            <span>Designed for safety, comfort, and peace of mind.</span>
        </div>
    </footer>

    <!-- Interactive Booking Modal -->
    <div class="modal-overlay" id="booking-modal" onclick="handleModalBackdropClick(event)">
        <div class="modal-card">
            <button class="modal-close-btn" onclick="closeBookingModal()">✕</button>
            <div style="margin-bottom:18px;">
                <span class="section-eyebrow">QUICK RESERVATION</span>
                <h3 id="modal-room-title">Book Bed in Room</h3>
                <p style="font-size:12px;color:var(--text-muted);" id="modal-room-subtitle">Ground Floor</p>
            </div>

            <form action="{{ route('enquiry.store') }}" method="POST">
                @csrf
                <input type="hidden" id="modal_room_number" name="room_number" value="">
                <input type="hidden" id="modal_sharing_type" name="sharing_type" value="">

                <div class="form-field">
                    <label>Your Full Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Ananya Rao">
                </div>

                <div class="form-field">
                    <label>Mobile Number (WhatsApp) *</label>
                    <input type="tel" name="phone" required placeholder="e.g. 9876543210">
                </div>

                <div class="form-field">
                    <label>Meal Plan *</label>
                    <select name="food_preference" required>
                        <option value="with_food">With Food (3 Meals Included)</option>
                        <option value="without_food">Without Food (Room Only)</option>
                    </select>
                </div>

                <div class="form-field">
                    <label>Expected Joining Date</label>
                    <input type="date" name="joining_date" value="{{ today()->toDateString() }}">
                </div>

                <div class="form-field">
                    <label>Notes / Requirements</label>
                    <textarea name="notes" placeholder="Any specific requirements..."></textarea>
                </div>

                <button type="submit" class="btn btn-rose btn-lg" style="width:100%;margin-top:10px;">
                    Confirm & Submit Booking Enquiry →
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript for Floor Filtering and Modals -->
    <script>
        function filterFloors(type, btn) {
            document.querySelectorAll('.floor-tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const gf = document.getElementById('floor-section-ground');
            const ff = document.getElementById('floor-section-first');

            if (type === 'all') {
                gf.style.display = 'block';
                ff.style.display = 'block';
            } else if (type === 'ground') {
                gf.style.display = 'block';
                ff.style.display = 'none';
            } else if (type === 'first') {
                gf.style.display = 'none';
                ff.style.display = 'block';
            }
        }

        function openBookingModal(roomNumber, sharingType, floorName) {
            document.getElementById('modal-room-title').innerText = 'Book Bed in Room ' + roomNumber;
            document.getElementById('modal-room-subtitle').innerText = floorName + ' · ' + sharingType;
            document.getElementById('modal_room_number').value = roomNumber;
            document.getElementById('modal_sharing_type').value = sharingType;
            document.getElementById('booking-modal').classList.add('active');
        }

        function closeBookingModal() {
            document.getElementById('booking-modal').classList.remove('active');
        }

        function handleModalBackdropClick(event) {
            if (event.target.id === 'booking-modal') {
                closeBookingModal();
            }
        }

        function prefillBooking(roomNumber, sharingType) {
            if (roomNumber) {
                const roomSelect = document.getElementById('form_room');
                if (roomSelect) roomSelect.value = roomNumber;
            }
            if (sharingType) {
                const sharingSelect = document.getElementById('form_sharing');
                if (sharingSelect) sharingSelect.value = sharingType;
            }
            const bookingSec = document.getElementById('booking');
            if (bookingSec) {
                bookingSec.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function syncSharingFromRoom(roomNumber) {
            const map = {
                'A1': 'Five Sharing',
                'A2': 'Five Sharing',
                'A3': 'Two Sharing',
                'B1': 'Six Sharing',
                'B2': 'Four Sharing',
                'B3': 'Two Sharing'
            };
            if (map[roomNumber]) {
                document.getElementById('form_sharing').value = map[roomNumber];
            }
        }

        function toggleFaq(item) {
            item.classList.toggle('open');
        }
    </script>
</body>
</html>
