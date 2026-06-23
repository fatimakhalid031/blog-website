<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', "failure's dock") — a blog about failing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@200;300;400;500;600&family=Caveat:wght@400;600;700&family=DM+Serif+Display:ital@0;1&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-deep: #141c20;
            --bg-moody: #1a2428;
            --bg-surface: #1e2d32;
            --navy: #2c3e50;
            --navy-soft: #3a5468;
            --gold: #c4895a;
            --gold-light: #d4a070;
            --gold-glow: rgba(196,137,90,0.08);
            --clay: #b89080;
            --cream: #f5ede0;
            --cream-dark: #e8dcc8;
            --warm-light: rgba(245,237,224,0.9);
            --warm-card: rgba(245,237,224,0.85);
            --driftwood: #8a7a6a;
            --driftwood-light: #a09080;
            --ink: #1a1a1a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-moody);
            color: var(--ink);
            line-height: 1.7;
            font-weight: 300;
            font-size: 15px;
        }

        body::after {
            content: '';
            position: fixed; inset: 0;
            z-index: -1;
            background:
                radial-gradient(ellipse at 25% 20%, rgba(196,137,90,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 75% 75%, rgba(44,62,80,0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            opacity: 0.02;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 256px 256px;
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: -0.02em;
        }

        a { color: inherit; text-decoration: none; }

        /* ── Navigation ── */
        .site-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 14px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(26, 36, 40, 0.75);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(196,137,90,0.06);
            transition: background 0.4s ease;
        }
        .site-nav.scrolled {
            background: rgba(26, 36, 40, 0.92);
            box-shadow: 0 1px 30px rgba(0,0,0,0.15);
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--cream);
            transition: color 0.3s ease;
        }
        .nav-brand:hover { color: var(--gold-light); }
        .nav-brand .brand-accent { color: var(--gold-light); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-links a, .nav-links button {
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(245, 237, 224, 0.7);
            transition: color 0.25s ease;
            position: relative;
            padding: 4px 0;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }
        .nav-links a:hover, .nav-links button:hover { color: var(--gold-light); }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 1px;
            background: var(--gold);
            transition: width 0.3s ease;
        }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }
        .nav-links a.active { color: var(--gold); }
        .nav-divider {
            width: 1px;
            height: 12px;
            background: rgba(160, 137, 107, 0.12);
        }

        .site-wrap { width: 100%; }
        .main-content { padding: 0; min-width: 0; }

        .content-section {
            max-width: 780px;
            margin: 0 auto;
            padding: 120px 24px 80px;
        }

        .content-section .section-heading {
            color: var(--cream);
        }

        /* ── BUTTON ── */
        .btn-dock-3d {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 44px 16px 48px;
            background: linear-gradient(160deg, var(--gold-light) 0%, var(--gold) 60%, #a07040 100%);
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.12);
            border-radius: 18px;
            cursor: pointer;
            position: relative;
            box-shadow: 0 10px 0 #8a6040, 0 16px 40px -8px rgba(160, 100, 60, 0.45), 0 4px 16px rgba(0,0,0,0.1), inset 0 2px 0 rgba(255,255,255,0.2), inset 0 -6px 0 rgba(0,0,0,0.08);
            transition: all 0.15s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-dock-3d::before {
            content: '';
            position: absolute;
            inset: 2px;
            border-radius: 16px;
            background: linear-gradient(160deg, rgba(255,255,255,0.08) 0%, transparent 50%, rgba(0,0,0,0.04) 100%);
            pointer-events: none;
        }
        .btn-dock-3d:hover {
            transform: translateY(-3px);
            box-shadow: 0 13px 0 #8a6040, 0 22px 50px -8px rgba(160, 100, 60, 0.5), 0 6px 20px rgba(0,0,0,0.1), inset 0 2px 0 rgba(255,255,255,0.25), inset 0 -6px 0 rgba(0,0,0,0.08);
        }
        .btn-dock-3d:active {
            transform: translateY(6px);
            box-shadow: 0 4px 0 #8a6040, 0 8px 25px -6px rgba(160, 100, 60, 0.4), inset 0 2px 0 rgba(255,255,255,0.15), inset 0 -3px 0 rgba(0,0,0,0.06);
        }
        .btn-dock-text { position: relative; z-index: 2; }
        .btn-dock-arrow {
            position: relative; z-index: 2;
            transition: transform 0.3s ease;
            width: 20px; height: 20px;
        }
        .btn-dock-3d:hover .btn-dock-arrow { transform: translateX(5px); }
        .btn-dock-shine {
            position: absolute;
            inset: 0;
            border-radius: 18px;
            background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.1) 45%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.1) 55%, transparent 70%);
            transform: translateX(-120%);
            transition: transform 0.5s ease;
        }
        .btn-dock-3d:hover .btn-dock-shine { transform: translateX(120%); }

        /* ── PAGINATION ── */
        .pagination {
            display: flex; gap: 6px;
            margin-top: 40px;
            font-size: 0.8rem;
            justify-content: center;
        }
        .pagination a, .pagination span {
            padding: 6px 12px;
            border: 1px solid rgba(200,180,160,0.15);
            border-radius: 8px;
            color: var(--driftwood-light);
            transition: all 0.2s ease;
        }
        .pagination a:hover {
            border-color: var(--gold);
            color: var(--gold-light);
            transform: translateY(-1px);
        }
        .pagination .active span {
            background: var(--gold);
            color: white;
            border-color: var(--gold);
        }

        /* ── FOOTER ── Harbour's End ── */
        .site-footer {
            position: relative;
            z-index: 2;
            background: linear-gradient(180deg, var(--bg-moody) 0%, var(--bg-deep) 100%);
            padding: 80px 24px 40px;
            margin-top: 60px;
            overflow: hidden;
            text-align: center;
        }

        /* Twilight gradient overlay */
        .site-footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(196,137,90,0.04) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(44,62,80,0.1) 0%, transparent 40%);
            pointer-events: none;
        }

        /* Drifting particles */
        .footer-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            border-radius: 50%;
            background: var(--gold);
            opacity: 0;
            animation: particleDrift 8s ease-in-out infinite;
            pointer-events: none;
        }
        .footer-particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 9s; }
        .footer-particle:nth-child(2) { left: 25%; top: 40%; animation-delay: -2s; animation-duration: 7s; width: 1.5px; height: 1.5px; }
        .footer-particle:nth-child(3) { left: 45%; top: 15%; animation-delay: -4s; animation-duration: 11s; }
        .footer-particle:nth-child(4) { left: 65%; top: 35%; animation-delay: -1s; animation-duration: 8s; width: 1px; height: 1px; }
        .footer-particle:nth-child(5) { left: 80%; top: 25%; animation-delay: -5s; animation-duration: 10s; }
        .footer-particle:nth-child(6) { left: 35%; top: 60%; animation-delay: -3s; animation-duration: 12s; width: 1.5px; height: 1.5px; }
        .footer-particle:nth-child(7) { left: 55%; top: 50%; animation-delay: -6s; animation-duration: 7s; }
        .footer-particle:nth-child(8) { left: 90%; top: 45%; animation-delay: -7s; animation-duration: 9s; width: 1px; height: 1px; }

        @keyframes particleDrift {
            0%, 100% { opacity: 0; transform: translateY(0) translateX(0); }
            10% { opacity: 0.3; }
            50% { opacity: 0.1; transform: translateY(-20px) translateX(10px); }
            90% { opacity: 0.2; }
        }

        .footer-inner {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Compass icon */
        .footer-compass {
            width: 32px;
            height: 32px;
            margin: 0 auto 28px;
            opacity: 0.12;
            animation: compassSpin 20s linear infinite;
        }
        .footer-compass svg { width: 100%; height: 100%; }
        @keyframes compassSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Closing quote */
        .footer-quote {
            font-family: 'Libre Baskerville', Georgia, serif;
            font-size: 1.15rem;
            font-style: italic;
            color: var(--cream);
            line-height: 1.5;
            margin-bottom: 32px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.7;
        }

        .footer-quote::before {
            content: '\201C';
            display: block;
            font-family: 'DM Serif Display', serif;
            font-size: 3rem;
            color: var(--gold);
            opacity: 0.15;
            margin-bottom: -8px;
        }

        /* Message */
        .footer-message {
            font-size: 0.8rem;
            line-height: 1.7;
            color: var(--driftwood-light);
            max-width: 420px;
            margin: 0 auto 36px;
            font-weight: 300;
        }

        /* Divider */
        .footer-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 32px;
            opacity: 0.08;
        }
        .footer-divider-line { width: 32px; height: 1px; background: var(--gold); }
        .footer-divider-dot { width: 3px; height: 3px; border-radius: 50%; background: var(--gold); }

        /* Navigation */
        .footer-nav {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 36px;
            flex-wrap: wrap;
        }
        .footer-nav a {
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--driftwood-light);
            transition: all 0.3s ease;
            position: relative;
        }
        .footer-nav a:hover {
            color: var(--gold-light);
        }
        .footer-nav a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--gold);
            transition: width 0.3s ease;
        }
        .footer-nav a:hover::after { width: 100%; }

        /* Signature */
        .footer-signature {
            margin-bottom: 12px;
        }
        .footer-signature-name {
            font-family: 'Caveat', cursive;
            font-size: 1.5rem;
            color: var(--cream);
            line-height: 1.2;
        }
        .footer-signature-title {
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--driftwood);
            font-family: 'Inter', sans-serif;
            margin-top: 4px;
        }

        /* Closing line */
        .footer-closing {
            font-family: 'Libre Baskerville', Georgia, serif;
            font-size: 0.75rem;
            font-style: italic;
            color: var(--driftwood);
            margin-top: 24px;
            opacity: 0.5;
        }

        /* Lighthouse glow sweep */
        .footer-lighthouse {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 80px;
            background: linear-gradient(to top, transparent, rgba(196,137,90,0.04));
            animation: lighthouseSweep 4s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes lighthouseSweep {
            0%, 100% { opacity: 0; transform: translateX(-50%) rotate(-15deg); }
            25% { opacity: 0.3; transform: translateX(-50%) rotate(5deg); }
            50% { opacity: 0; transform: translateX(-50%) rotate(15deg); }
            75% { opacity: 0.3; transform: translateX(-50%) rotate(-5deg); }
        }

        /* ── BLOGGER PAGE ── */
        .blogger-page { text-align: center; }
        .blogger-page-avatar {
            width: 120px; height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid var(--warm-sand);
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            transition: transform 0.4s ease;
        }
        .blogger-page-avatar:hover { transform: scale(1.03); }
        .blogger-page-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .blogger-page-name {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem; font-weight: 400;
            color: var(--navy); margin-bottom: 4px;
        }
        .blogger-page-tagline {
            font-family: 'Caveat', cursive;
            font-size: 1rem; color: var(--driftwood);
            margin-bottom: 24px;
        }
        .blogger-page-bio {
            font-size: 0.9rem; color: #555;
            line-height: 1.8; max-width: 480px;
            margin: 0 auto 36px;
        }
        .blogger-page-bio p { margin-bottom: 12px; }
        .blogger-page-divider {
            width: 40px; height: 2px;
            background: var(--ocean);
            margin: 0 auto 32px;
            border-radius: 2px;
        }
        .blogger-page-failures-title {
            font-family: 'Inter', sans-serif;
            font-size: 0.7rem; letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--ocean-dark); margin-bottom: 20px;
            font-weight: 500;
        }
        .blogger-failure-list { max-width: 340px; margin: 0 auto; }
        .blogger-failure-item {
            display: flex; align-items: center; gap: 14px;
            padding: 10px 16px; border-radius: 10px;
            transition: background 0.25s ease, transform 0.25s ease;
            text-align: left;
        }
        .blogger-failure-item:hover {
            background: rgba(129, 191, 188, 0.06);
            transform: translateX(4px);
        }
        .bf-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--driftwood);
            flex-shrink: 0;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .blogger-failure-item:hover .bf-dot {
            background: var(--ocean);
            transform: scale(1.3);
        }
        .bf-title { font-size: 0.85rem; font-weight: 400; margin-bottom: 1px; }
        .bf-date { font-size: 0.65rem; color: #aaa; letter-spacing: 0.05em; }

        /* ── ABOUT ── */
        .about-content { max-width: 650px; }
        .about-content h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2.4rem; font-weight: 400;
            margin-bottom: 24px; color: var(--navy);
        }
        .about-content p {
            font-size: 0.95rem; color: #444;
            margin-bottom: 1.2em; line-height: 1.9;
        }
        .about-content .signature {
            font-family: 'Caveat', cursive;
            font-size: 1.3rem; color: var(--clay);
            margin-top: 40px; position: relative;
            padding-top: 20px;
        }
        .about-content .signature::before {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 40px; height: 2px;
            background: var(--gold);
        }

        /* ── BANNER ── */
        .banner {
            width: 100%; height: 380px;
            object-fit: cover; object-position: center 30%;
            border-radius: 16px; display: block;
            filter: saturate(0.8) sepia(0.12) brightness(0.98);
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }
        .banner-sm { height: 240px; object-position: center 40%; }
        .banner-wrap {
            position: relative; margin-bottom: 40px;
            line-height: 0; overflow: hidden; border-radius: 16px;
        }
        .banner-wrap::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 60%;
            background: linear-gradient(to top, var(--cream) 0%, rgba(245, 237, 224, 0.4) 50%, transparent 100%);
            pointer-events: none;
            border-radius: 0 0 16px 16px;
        }

        /* ── ADMIN ── */
        .admin-layout { max-width: 900px; margin: 0 auto; padding: 100px 20px 60px; }
        .admin-layout h1 { font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 400; margin-bottom: 24px; color: var(--cream); }
        .admin-layout > div { border-radius: 16px; overflow: hidden; }
        .admin-layout .btn { border-color: var(--gold); color: var(--gold); }
        .admin-layout .btn:hover { background: var(--gold); color: white; box-shadow: 0 3px 12px rgba(196,137,90,0.3); }
        .admin-layout .btn-danger { border-color: #c65d47; color: #c65d47; }
        .admin-layout .btn-danger:hover { background: #c65d47; border-color: #c65d47; color: white; }
        .admin-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.85rem; border-radius: 12px; overflow: hidden; }
        .admin-table th {
            text-align: left; padding: 14px 12px;
            background: rgba(196, 137, 90, 0.06);
            border-bottom: 1px solid rgba(200,180,160,0.1);
            font-weight: 500; font-size: 0.7rem;
            text-transform: uppercase; letter-spacing: 0.1em;
            color: var(--gold);
        }
        .admin-table td {
            padding: 14px 12px; border-bottom: 1px solid rgba(200,180,160,0.1);
            background: rgba(255,255,255,0.3);
            transition: background 0.2s ease;
        }
        .admin-table tr:hover td { background: rgba(196, 137, 90, 0.04); }
        .admin-table tr:last-child td { border-bottom: none; }

        .btn {
            display: inline-block; padding: 10px 24px;
            border: 1px solid var(--gold);
            font-size: 0.75rem; letter-spacing: 0.1em;
            text-transform: uppercase; cursor: pointer;
            transition: all 0.25s ease;
            background: transparent; color: var(--gold);
            border-radius: 10px; font-family: 'Inter', sans-serif;
        }
        .btn:hover {
            background: var(--gold); border-color: var(--gold);
            color: white; transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(196, 137, 90, 0.3);
        }
        .btn:active { transform: translateY(0); }
        .btn-sm { padding: 6px 14px; font-size: 0.65rem; }
        .btn-danger { border-color: #c65d47; color: #c65d47; }
        .btn-danger:hover { background: #c65d47; border-color: #c65d47; color: white; box-shadow: 0 3px 12px rgba(198, 93, 71, 0.25); }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-size: 0.7rem;
            text-transform: uppercase; letter-spacing: 0.1em;
            color: var(--driftwood-light); margin-bottom: 6px;
        }
        .form-control {
            width: 100%; padding: 12px 14px;
            border: 1px solid rgba(200,180,160,0.15);
            background: rgba(245,237,224,0.7);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem; color: var(--ink);
            border-radius: 10px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .form-control:focus {
            outline: none; border-color: var(--gold);
            background: rgba(245,237,224,0.9);
            box-shadow: 0 0 0 3px rgba(196, 137, 90, 0.1);
        }
        textarea.form-control { min-height: 400px; line-height: 1.8; }

        .alert {
            padding: 14px 20px;
            background: rgba(196, 137, 90, 0.06);
            border-left: 3px solid var(--gold);
            font-size: 0.85rem; margin-bottom: 24px;
            border-radius: 10px; color: #444;
        }

        .diary-back {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.75rem; color: var(--clay);
            margin-top: 40px; transition: color 0.2s ease;
            font-family: 'Inter', sans-serif;
            text-transform: uppercase; letter-spacing: 0.1em;
        }
        .diary-back:hover { color: var(--gold); }

        /* ── DIARY / ENTRIES PAGE ── */
        .logbook-header { text-align: center; margin-bottom: 48px; padding-bottom: 32px; border-bottom: 1px solid var(--driftwood); }
        .logbook-icon { width: 48px; height: 48px; margin: 0 auto 16px; background: rgba(245,237,224,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; }
        .logbook-icon svg { width: 28px; height: 28px; }
        .logbook-title { font-family: 'DM Serif Display', serif; font-size: 2rem; font-weight: 400; color: var(--navy); margin-bottom: 6px; }
        .logbook-sub { font-family: 'Caveat', cursive; font-size: 1.1rem; color: var(--driftwood); }

        .diary-entry {
            background: var(--warm-card);
            border-radius: 16px; padding: 28px 28px 24px;
            margin-bottom: 20px;
            border: 1px solid rgba(196,137,90,0.08);
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }
        .diary-entry:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,0.1), 0 0 0 1px rgba(196,137,90,0.15); }

        .diary-date { font-family: 'Caveat', cursive; font-size: 0.95rem; color: var(--clay); margin-bottom: 6px; }
        .diary-title {
            font-family: 'Libre Baskerville', Georgia, serif;
            font-size: 1.3rem; font-weight: 400; line-height: 1.35;
            color: var(--navy); margin-bottom: 10px;
            transition: color 0.25s ease;
        }
        .diary-entry:hover .diary-title { color: var(--gold); }
        .diary-excerpt {
            font-family: 'Libre Baskerville', Georgia, serif;
            font-size: 0.85rem; color: #555; line-height: 1.7; font-weight: 400;
        }
        .diary-category {
            display: inline-block; font-size: 0.55rem; letter-spacing: 0.12em;
            text-transform: uppercase; padding: 3px 12px;
            border-radius: 20px; color: var(--clay); margin-top: 10px;
            background: rgba(196,137,90,0.06);
            border: 1px solid rgba(196,137,90,0.1);
            font-family: 'Inter', sans-serif;
        }

        /* ── SINGLE POST ── */
        .diary-single {
            background: var(--warm-light);
            backdrop-filter: blur(8px);
            border-radius: 20px; padding: 48px 44px 44px;
            border: 1px solid rgba(196,137,90,0.08);
            box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        }
        .diary-single-header { text-align: center; margin-bottom: 40px; padding-bottom: 32px; border-bottom: 1px solid rgba(196,137,90,0.08); }
        .diary-single-date { font-family: 'Caveat', cursive; font-size: 1rem; color: var(--clay); margin-bottom: 8px; }
        .diary-single-title {
            font-family: 'Libre Baskerville', Georgia, serif;
            font-size: 2rem; font-weight: 400; line-height: 1.25; color: var(--navy);
        }
        .diary-single-body {
            font-family: 'Libre Baskerville', Georgia, serif;
            font-size: 0.9rem; line-height: 1.9; color: #444; font-weight: 400;
        }
        .diary-single-body p { margin-bottom: 1.4em; }
        .diary-single-body h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; margin-top: 2em; margin-bottom: 0.8em;
            color: var(--navy); border-bottom: 1px solid rgba(200,180,160,0.15); padding-bottom: 6px;
        }
        .diary-single-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; margin-top: 1.5em; margin-bottom: 0.6em; color: var(--gold);
        }
        .diary-single-body blockquote {
            border-left: 3px solid var(--gold); padding: 12px 0 12px 24px;
            margin: 1.5em 0; font-style: italic; color: #555;
            background: rgba(196,137,90,0.04); border-radius: 0 10px 10px 0; padding-right: 20px;
        }
        .diary-single-body img {
            max-width: 100%; height: auto; margin: 1.5em 0;
            border-radius: 14px; box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }
        .diary-single-body a {
            text-decoration: underline; text-underline-offset: 2px;
            color: var(--clay); transition: color 0.2s ease;
        }
        .diary-single-body a:hover { color: var(--gold); }

        @media (max-width: 768px) {
            .site-nav { padding: 14px 20px; }
            .nav-links { gap: 14px; }
            .nav-links a, .nav-links button { font-size: 0.6rem; }
            .nav-brand { font-size: 0.95rem; }
            .site-footer { flex-direction: column; gap: 8px; padding: 24px 20px; text-align: center; }
            .content-section { padding: 100px 20px 60px; }
        }
    </style>
</head>
<body>
    <nav class="site-nav" id="siteNav">
        <a href="{{ route('home') }}" class="nav-brand">
            failure<span class="brand-accent">'</span>s dock
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('entries') }}" class="{{ request()->routeIs('entries') ? 'active' : '' }}">Logbook</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            @auth
                <span class="nav-divider"></span>
                <a href="{{ route('admin.index') }}">Write</a>
                <a href="{{ route('admin.escapes.create') }}">Upload</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Sign out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Sign in</a>
            @endauth
            <span class="nav-divider"></span>
            <a href="{{ route('blogger') }}" style="color: var(--gold);">Blogger</a>
            <span class="nav-divider"></span>
            <a href="{{ route('escapes.index') }}">Escapes</a>
        </div>
    </nav>

    <div class="site-wrap">
        <main class="main-content">
            @if (session('success'))
                <div class="alert" style="max-width: 740px; margin: 100px auto 0;">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>

        <footer class="site-footer">
            <!-- Drifting particles -->
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>
            <div class="footer-particle"></div>

            <!-- Lighthouse sweep -->
            <div class="footer-lighthouse"></div>

            <div class="footer-inner">
                <!-- Compass -->
                <div class="footer-compass">
                    <svg viewBox="0 0 32 32" fill="none">
                        <circle cx="16" cy="16" r="14" stroke="rgba(245,237,224,0.15)" stroke-width="1"/>
                        <polygon points="16,4 18,16 16,18 14,16" fill="rgba(196,137,90,0.2)"/>
                        <polygon points="16,28 14,16 16,14 18,16" fill="rgba(245,237,224,0.08)"/>
                        <circle cx="16" cy="16" r="2" fill="rgba(196,137,90,0.15)"/>
                    </svg>
                </div>

                <!-- Quote -->
                <div class="footer-quote">
                    Not every ship reaches its destination. Some discover better shores.
                </div>

                <!-- Message -->
                <div class="footer-message">
                    Failure's Dock is a harbour for unfinished journeys, unexpected detours, and stories still finding their way home.
                </div>

                <div class="footer-divider">
                    <span class="footer-divider-line"></span>
                    <span class="footer-divider-dot"></span>
                    <span class="footer-divider-line"></span>
                </div>

                <!-- Nav -->
                <div class="footer-nav">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('entries') }}">The Logbook</a>
                    <a href="{{ route('entries') }}">Discoveries</a>
                    <a href="{{ route('about') }}">About</a>
                </div>

                <!-- Signature -->
                <div class="footer-signature">
                    <div class="footer-signature-name">— Fatima</div>
                    <div class="footer-signature-title">Keeper of Failure's Dock</div>
                </div>

                <div class="footer-closing">Until the next tide.</div>
            </div>
        </footer>
    </div>

    <script>
        const nav = document.getElementById('siteNav');
        window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 40));

        // ── Register background-upload service worker ──
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').catch(() => {});
        }
    </script>
</body>
</html>
