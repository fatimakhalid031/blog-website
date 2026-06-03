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
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f6f1eb;
            color: #1a1a1a;
            line-height: 1.7;
            font-weight: 300;
            font-size: 15px;
            position: relative;
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
            color: #1a1a1a;
            opacity: 1;
        }

        .nav-links a.active {
            color: #1a1a1a;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 1px;
            background: #1a1a1a;
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
            color: #aaa;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        .blogger-card {
            text-align: center;
            padding: 32px 20px;
            background: rgba(255,255,255,0.5);
            border-radius: 4px;
        }

        .blogger-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ddd;
            margin: 0 auto 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #999;
        }

        .blogger-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .blogger-tagline {
            font-size: 0.75rem;
            color: #888;
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
            padding: 12px 0;
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }

        .failure-item:last-child {
            border-bottom: none;
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
            border-radius: 2px;
            margin-bottom: 0;
            display: block;
            filter: saturate(0.85) sepia(0.15);
            -webkit-filter: saturate(0.85) sepia(0.15);
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
        }

        .banner-wrap::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, #f6f1eb 0%, transparent 100%);
            pointer-events: none;
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
        }

        .scroll-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #bbb;
        }

        .scroll-hint .line {
            width: 30px;
            height: 1px;
            background: #ccc;
        }

        .section-heading {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 32px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0,0,0,0.08);
        }

        .post-card {
            padding: 28px 0;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            transition: opacity 0.2s;
        }

        .post-card:last-child {
            border-bottom: none;
        }

        .post-card:hover {
            opacity: 0.8;
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
            color: #1a1a1a;
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
            padding: 3px 10px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 2px;
            color: #888;
            margin-top: 10px;
        }

        /* Single post */
        .post-header {
            margin-bottom: 40px;
        }

        .post-header .post-meta {
            margin-bottom: 12px;
        }

        .post-header .post-title {
            font-size: 2.4rem;
            margin-bottom: 16px;
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
        }

        .post-body h3 {
            font-size: 1.2rem;
            margin-top: 1.5em;
            margin-bottom: 0.6em;
        }

        .post-body blockquote {
            border-left: 2px solid #ddd;
            padding-left: 20px;
            margin: 1.5em 0;
            font-style: italic;
            color: #666;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
            margin: 1.5em 0;
            border-radius: 2px;
        }

        .post-body a {
            text-decoration: underline;
            text-underline-offset: 2px;
            text-decoration-thickness: 1px;
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
            color: #888;
            margin-top: 40px;
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

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .admin-table th {
            text-align: left;
            padding: 12px 8px;
            border-bottom: 1px solid #ddd;
            font-weight: 500;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #888;
        }

        .admin-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #eee;
        }

        .btn {
            display: inline-block;
            padding: 8px 20px;
            border: 1px solid #1a1a1a;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            background: transparent;
            color: #1a1a1a;
            border-radius: 2px;
            font-family: 'Inter', sans-serif;
        }

        .btn:hover {
            background: #1a1a1a;
            color: #f6f1eb;
            opacity: 1;
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 0.65rem;
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
            padding: 10px 12px;
            border: 1px solid #ddd;
            background: rgba(255,255,255,0.6);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: #1a1a1a;
            border-radius: 2px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #1a1a1a;
        }

        textarea.form-control {
            min-height: 400px;
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
        }

        .alert {
            padding: 12px 16px;
            background: rgba(0,0,0,0.04);
            border-left: 2px solid #1a1a1a;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            margin-top: 32px;
            font-size: 0.8rem;
        }

        .pagination a, .pagination span {
            padding: 4px 10px;
            border: 1px solid #ddd;
            border-radius: 2px;
            color: #666;
        }

        .pagination a:hover {
            border-color: #1a1a1a;
            color: #1a1a1a;
        }

        .pagination .active span {
            background: #1a1a1a;
            color: #f6f1eb;
            border-color: #1a1a1a;
        }

        /* Footer */
        .site-footer {
            grid-column: 1 / -1;
            padding: 32px 0;
            border-top: 1px solid rgba(0,0,0,0.06);
            font-size: 0.7rem;
            color: #bbb;
            letter-spacing: 0.05em;
            display: flex;
            justify-content: space-between;
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
                failure's dock
                <span class="subtitle">a harbour for things that didn't work out</span>
            </a>
            <nav class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('admin.index') }}">Write</a>
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
                    <div class="blogger-avatar">✧</div>
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
                <div class="failure-item">
                    <div class="failure-title">tried to learn guitar</div>
                    <div class="failure-date">May 2026</div>
                </div>
                <div class="failure-item">
                    <div class="failure-title">started a newsletter (RIP)</div>
                    <div class="failure-date">March 2026</div>
                </div>
                <div class="failure-item">
                    <div class="failure-title">5am mornings — day 1</div>
                    <div class="failure-date">January 2026</div>
                </div>
                <div class="failure-item">
                    <div class="failure-title">that sourdough starter</div>
                    <div class="failure-date">December 2025</div>
                </div>
            </div>
        </aside>

        <footer class="site-footer">
            <span>© {{ date('Y') }} failure's dock</span>
            <span>crafted with patience</span>
        </footer>
    </div>
</body>
</html>
