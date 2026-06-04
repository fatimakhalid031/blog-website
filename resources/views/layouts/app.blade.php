<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', "failure's dock") — a blog about failing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --rose: #c4786a;
            --rose-light: #e8c8c0;
            --rose-dark: #a05a4e;
            --sage: #8a9a7a;
            --sage-light: #c5d0b8;
            --gold: #c4a882;
            --gold-light: #e0d0b8;
            --clay: #b89080;
            --cream: #f6f1eb;
            --cream-dark: #e8e0d5;
            --ink: #1a1a1a;
            --warm-bg: #f6f1eb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--cream);
            color: var(--ink);
            line-height: 1.7;
            font-weight: 300;
            font-size: 15px;
            position: relative;
        }

        /* Subtle color-wash background */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image:
                radial-gradient(ellipse at 15% 40%, rgba(196, 120, 106, 0.07) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 25%, rgba(138, 154, 122, 0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(196, 168, 130, 0.06) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Grain texture overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            opacity: 0.035;
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
        a:hover { opacity: 0.7; }

        img {
            transition: transform 0.4s ease, filter 0.4s ease;
        }
        img:hover {
            transform: scale(1.01);
        }

        /* Layout */
        .site-wrapper {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 60px;
            min-height: 100vh;
            position: relative;
        }

        /* Navigation */
        .site-header {
            grid-column: 1 / -1;
            padding: 50px 0 40px;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .site-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1;
            transition: opacity 0.3s ease;
            color: var(--ink);
        }
        .site-title:hover { opacity: 0.75; }
        .site-title .brand-accent {
            color: var(--rose);
        }

        .site-title .subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 0.7rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #888;
            display: block;
            margin-top: 6px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-links a {
            font-size: 0.8rem;
            font-weight: 400;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #555;
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--rose);
            opacity: 1;
        }

        .nav-links a.active {
            color: var(--rose);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--rose);
        }

        .nav-links form button:hover {
            color: var(--rose) !important;
        }

        .nav-links a.active {
            color: var(--rose);
        }
        .nav-links a.active::after {
            background: var(--rose);
        }

        .nav-links a:not(.active):hover {
            color: var(--rose);
        }

        /* Main content */
        .main-content {
            padding: 50px 0;
            min-width: 0;
        }

        /* Sidebar */
        .sidebar {
            padding: 50px 0;
            border-left: 1px solid rgba(0,0,0,0.06);
            padding-left: 40px;
        }

        .sidebar-section {
            margin-bottom: 48px;
        }

        .sidebar-section:last-child {
            margin-bottom: 0;
        }

        .sidebar-label {
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--clay);
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sidebar-label::before {
            content: '◈';
            font-size: 0.5rem;
            color: var(--gold);
        }

        .blogger-card {
            text-align: center;
            padding: 32px 20px 28px;
            background: rgba(255,255,255,0.5);
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
            transition: box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .blogger-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--rose-light), var(--gold-light), var(--sage-light));
        }
        .blogger-card:hover {
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        .blogger-avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            margin: 0 auto 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255,255,255,0.6);
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blogger-avatar:hover {
            transform: scale(1.04);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        .blogger-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blogger-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .blogger-tagline {
            font-size: 0.75rem;
            color: var(--clay);
            font-style: italic;
            margin-bottom: 12px;
        }

        .blogger-bio {
            font-size: 0.8rem;
            color: #666;
            line-height: 1.6;
        }

        /* Failure's Dock */
        .failure-item {
            padding: 12px 14px;
            border-radius: 8px;
            transition: background 0.25s ease, transform 0.2s ease;
            margin-bottom: 2px;
            display: flex;
            align-items: baseline;
            gap: 10px;
        }

        .failure-item:last-child {
            margin-bottom: 0;
        }

        .failure-item:hover {
            background: rgba(255,255,255,0.4);
            transform: translateX(3px);
        }

        .failure-item::before {
            content: '·';
            font-size: 1.2rem;
            color: var(--rose-light);
            font-weight: 700;
            line-height: 1;
        }
        .failure-item:nth-child(2)::before { color: var(--sage-light); }
        .failure-item:nth-child(3)::before { color: var(--gold); }
        .failure-item:nth-child(4)::before { color: var(--clay); }

        .failure-item-content {
            flex: 1;
        }

        .failure-title {
            font-size: 0.85rem;
            font-weight: 400;
            margin-bottom: 2px;
        }

        .failure-date {
            font-size: 0.65rem;
            color: #aaa;
            letter-spacing: 0.05em;
        }

        /* Banner image */
        .banner {
            grid-column: 1 / -1;
            width: 100%;
            height: 420px;
            object-fit: cover;
            object-position: center 30%;
            border-radius: 16px;
            margin-bottom: 0;
            display: block;
            filter: saturate(0.8) sepia(0.12) brightness(0.98);
            -webkit-filter: saturate(0.8) sepia(0.12) brightness(0.98);
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        .banner-sm {
            height: 280px;
            object-position: center 40%;
        }

        .banner-wrap {
            grid-column: 1 / -1;
            position: relative;
            margin-bottom: 0;
            line-height: 0;
            overflow: hidden;
            border-radius: 16px;
        }

        .banner-wrap::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, var(--cream) 0%, rgba(246, 241, 235, 0.4) 50%, transparent 100%);
            pointer-events: none;
            border-radius: 0 0 16px 16px;
        }

        .banner-wrap:hover .banner {
            filter: saturate(0.9) sepia(0.08) brightness(1.02);
        }

        /* Blog posts on landing */
        .hero-section {
            margin-bottom: 60px;
            padding-bottom: 40px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 20px;
            max-width: 700px;
        }
        .hero-subtitle {
            font-size: 0.9rem;
            color: #888;
            max-width: 500px;
            font-weight: 300;
            border-left: 2px solid var(--gold-light);
            padding-left: 20px;
        }

        .scroll-hint {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 32px;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--clay);
        }

        .scroll-hint .line {
            width: 30px;
            height: 1px;
            background: #ccc;
            transition: width 0.3s ease, background 0.3s ease;
        }
        .scroll-hint:hover .line {
            width: 50px;
            background: var(--rose);
        }
        .scroll-hint:hover {
            color: var(--rose);
        }

        .section-heading {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 32px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
        }
        .section-heading::before {
            content: '✦';
            font-size: 0.8rem;
            color: var(--gold);
        }
        .section-heading::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(0,0,0,0.08), transparent);
        }

        .post-card {
            padding: 28px 24px;
            margin: 0 -24px;
            border-radius: 12px;
            transition: background 0.3s ease, transform 0.2s ease;
            border-left: 3px solid transparent;
        }

        .post-card:last-child {
            border-bottom: none;
        }

        .post-card:hover {
            background: rgba(255,255,255,0.45);
            transform: translateX(4px);
            border-left-color: var(--rose-light);
        }

        .post-meta {
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #aaa;
            margin-bottom: 6px;
        }

        .post-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--ink);
            transition: color 0.25s ease;
        }
        .post-card:hover .post-title {
            color: var(--rose-dark);
        }

        .post-excerpt {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.7;
            font-weight: 300;
        }

        .post-category {
            display: inline-block;
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 4px 12px;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 20px;
            color: var(--clay);
            margin-top: 10px;
            background: rgba(255,255,255,0.3);
            transition: all 0.25s ease;
        }
        .post-card:hover .post-category {
            background: var(--gold-light);
            border-color: var(--gold);
            color: var(--ink);
        }

        /* Single post */
        .post-header {
            margin-bottom: 40px;
        }

        .post-header .post-meta {
            margin-bottom: 12px;
            color: var(--clay);
        }

        .post-header .post-title {
            font-size: 2.4rem;
            margin-bottom: 16px;
        }
        .post-header .post-category {
            background: var(--gold-light);
            border-color: var(--gold);
            color: var(--ink);
        }

        .post-body {
            font-size: 1rem;
            line-height: 1.9;
            color: #333;
            font-weight: 300;
        }

        .post-body p {
            margin-bottom: 1.5em;
        }

        .post-body h2 {
            font-size: 1.5rem;
            margin-top: 2em;
            margin-bottom: 0.8em;
            color: var(--ink);
            border-bottom: 1px solid var(--rose-light);
            padding-bottom: 6px;
        }

        .post-body h3 {
            font-size: 1.2rem;
            margin-top: 1.5em;
            margin-bottom: 0.6em;
            color: var(--rose-dark);
        }

        .post-body blockquote {
            border-left: 3px solid var(--gold);
            padding: 12px 0 12px 24px;
            margin: 1.5em 0;
            font-style: italic;
            color: #555;
            background: rgba(196, 168, 130, 0.08);
            border-radius: 0 10px 10px 0;
            padding-right: 20px;
        }

        .post-body blockquote p {
            margin-bottom: 0;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
            margin: 1.5em 0;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }

        .post-body a {
            text-decoration: underline;
            text-underline-offset: 2px;
            text-decoration-thickness: 1px;
            transition: color 0.2s ease;
            color: var(--clay);
        }
        .post-body a:hover {
            color: var(--rose);
        }

        /* About page */
        .about-content {
            max-width: 650px;
        }

        .about-content h1 {
            font-size: 2.4rem;
            margin-bottom: 24px;
        }

        .about-content p {
            font-size: 1rem;
            color: #444;
            margin-bottom: 1.2em;
            line-height: 1.9;
        }

        .about-content .signature {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.2rem;
            color: var(--clay);
            margin-top: 40px;
            position: relative;
            padding-top: 20px;
        }
        .about-content .signature::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--gold);
        }

        /* Admin */
        .admin-layout {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .admin-layout h1 {
            font-size: 1.8rem;
            margin-bottom: 24px;
        }

        .admin-layout > div {
            border-radius: 16px;
            overflow: hidden;
        }

        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.85rem;
            border-radius: 12px;
            overflow: hidden;
        }

        .admin-table th {
            text-align: left;
            padding: 14px 12px;
            background: rgba(196, 120, 106, 0.06);
            border-bottom: 1px solid var(--rose-light);
            font-weight: 500;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--rose-dark);
        }

        .admin-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #eee;
            background: rgba(255,255,255,0.15);
            transition: background 0.2s ease;
        }

        .admin-table tr:hover td {
            background: rgba(196, 120, 106, 0.04);
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 24px;
            border: 1px solid var(--ink);
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s ease;
            background: transparent;
            color: var(--ink);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
        }

        .btn:hover {
            background: var(--rose);
            border-color: var(--rose);
            color: white;
            opacity: 1;
            transform: translateY(-1px);
            box-shadow: 0 3px 12px rgba(196, 120, 106, 0.25);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 0.65rem;
        }

        .btn-danger {
            border-color: #c65d47;
            color: #c65d47;
        }
        .btn-danger:hover {
            background: #c65d47;
            border-color: #c65d47;
            color: white;
            box-shadow: 0 3px 12px rgba(198, 93, 71, 0.25);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #888;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            background: rgba(255,255,255,0.6);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: #1a1a1a;
            border-radius: 10px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--rose);
            background: rgba(255,255,255,0.85);
            box-shadow: 0 0 0 3px rgba(196, 120, 106, 0.1);
        }

        textarea.form-control {
            min-height: 400px;
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
        }

        .alert {
            padding: 14px 20px;
            background: rgba(138, 154, 122, 0.08);
            border-left: 3px solid var(--sage);
            font-size: 0.85rem;
            margin-bottom: 24px;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.04);
            color: #3a4a2a;
        }

        .pagination {
            display: flex;
            gap: 6px;
            margin-top: 32px;
            font-size: 0.8rem;
        }

        .pagination a, .pagination span {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: #666;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            border-color: var(--rose);
            color: var(--rose);
            background: rgba(196, 120, 106, 0.06);
            transform: translateY(-1px);
        }

        .pagination .active span {
            background: var(--rose);
            color: white;
            border-color: var(--rose);
        }

        /* Footer */
        .site-footer {
            grid-column: 1 / -1;
            padding: 32px 0;
            border-top: 1px solid rgba(0,0,0,0.06);
            font-size: 0.7rem;
            color: var(--clay);
            letter-spacing: 0.05em;
            display: flex;
            justify-content: space-between;
        }
        .site-footer .footer-heart {
            color: var(--rose-light);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .site-wrapper {
                grid-template-columns: 1fr;
                padding: 0 24px;
            }
            .sidebar {
                border-left: none;
                padding-left: 0;
                border-top: 1px solid rgba(0,0,0,0.06);
                padding-top: 40px;
            }
            .site-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
                padding: 30px 0 24px;
            }
            .hero-title {
                font-size: 2rem;
            }
            .nav-links {
                flex-wrap: wrap;
                gap: 20px;
            }
            .post-header .post-title {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="site-wrapper">
        <header class="site-header">
            <a href="{{ route('home') }}" class="site-title">
                failure<span class="brand-accent">'</span>s dock
                <span class="subtitle">a harbour for things that didn't work out</span>
            </a>
            <nav class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                @auth
                    <a href="{{ route('admin.index') }}">Write</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer; font-family: 'Inter', sans-serif; font-size: 0.8rem; font-weight: 400; letter-spacing: 0.05em; text-transform: uppercase; color: #555; transition: all 0.25s ease; padding: 4px 0;">Sign out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Sign in</a>
                @endauth
            </nav>
        </header>

        <main class="main-content">
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>

        <aside class="sidebar">
            <!-- Meet the Blogger -->
            <div class="sidebar-section">
                <div class="sidebar-label">Meet the Blogger</div>
                <div class="blogger-card">
                    <div class="blogger-avatar">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&q=80&auto=format" alt="Fatima" loading="lazy">
                    </div>
                    <div class="blogger-name">Fatima</div>
                    <div class="blogger-tagline">writing into the void</div>
                    <div class="blogger-bio">
                        A quiet observer documenting the beautiful mess of being human.<br>
                        Words, wanderings, and half-baked thoughts.
                    </div>
                </div>
            </div>

            <!-- Failure's Dock -->
            <div class="sidebar-section">
                <div class="sidebar-label">Failure's Dock</div>
                <div class="dock-illustration">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 80'%3E%3Cpath d='M20 60 L60 20 L100 40 L140 15 L180 35' stroke='%23c4a882' stroke-width='1.5' fill='none' opacity='0.5'/%3E%3Ccircle cx='60' cy='20' r='3' fill='%23d4c4a8' opacity='0.6'/%3E%3Ccircle cx='140' cy='15' r='2' fill='%23d4c4a8' opacity='0.4'/%3E%3C/svg%3E"
                         alt="" style="width: 100%; height: auto; opacity: 0.7; margin-bottom: 4px;">
                </div>
                <div class="failure-item">
                    <div class="failure-item-content">
                        <div class="failure-title">tried to learn guitar</div>
                        <div class="failure-date">May 2026</div>
                    </div>
                </div>
                <div class="failure-item">
                    <div class="failure-item-content">
                        <div class="failure-title">started a newsletter (RIP)</div>
                        <div class="failure-date">March 2026</div>
                    </div>
                </div>
                <div class="failure-item">
                    <div class="failure-item-content">
                        <div class="failure-title">5am mornings — day 1</div>
                        <div class="failure-date">January 2026</div>
                    </div>
                </div>
                <div class="failure-item">
                    <div class="failure-item-content">
                        <div class="failure-title">that sourdough starter</div>
                        <div class="failure-date">December 2025</div>
                    </div>
                </div>
            </div>
        </aside>

        <footer class="site-footer">
            <span>© {{ date('Y') }} failure's dock</span>
            <span>crafted with <span class="footer-heart">♡</span> & patience</span>
        </footer>
    </div>
</body>
</html>
