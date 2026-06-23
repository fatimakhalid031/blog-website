<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Manager') — failure's dock</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --mgr-bg: #f4f5f7;
            --mgr-surface: #ffffff;
            --mgr-sidebar: #1a2428;
            --mgr-sidebar-hover: #243238;
            --mgr-sidebar-active: #2c3e50;
            --mgr-text: #1a1a2e;
            --mgr-text-muted: #6b7280;
            --mgr-border: #e5e7eb;
            --mgr-accent: #2ecc71;
            --mgr-accent-hover: #40d87e;
            --mgr-danger: #dc2626;
            --mgr-success: #16a34a;
            --mgr-warning: #d97706;
            --mgr-sidebar-width: 240px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--mgr-bg);
            color: var(--mgr-text);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.5;
        }

        .mgr-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--mgr-sidebar-width);
            height: 100vh;
            background: var(--mgr-sidebar);
            display: flex;
            flex-direction: column;
            z-index: 50;
            overflow-y: auto;
        }

        .mgr-sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .mgr-sidebar-brand a {
            font-size: 1rem;
            font-weight: 600;
            color: #f5ede0;
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .mgr-sidebar-brand a span { color: var(--mgr-accent); }

        .mgr-sidebar-label {
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            margin-top: 4px;
            font-weight: 400;
        }

        .mgr-sidebar-nav {
            flex: 1;
            padding: 12px 0;
        }

        .mgr-sidebar-section-title {
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.2);
            padding: 16px 20px 6px;
            font-weight: 500;
        }

        .mgr-sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 400;
            transition: all 0.2s ease;
            border-left: 2px solid transparent;
        }

        .mgr-sidebar-link:hover {
            background: var(--mgr-sidebar-hover);
            color: rgba(255,255,255,0.9);
        }

        .mgr-sidebar-link.active {
            background: var(--mgr-sidebar-hover);
            color: var(--mgr-accent);
            border-left-color: var(--mgr-accent);
        }

        .mgr-sidebar-link svg {
            width: 16px;
            height: 16px;
            opacity: 0.5;
            flex-shrink: 0;
        }

        .mgr-sidebar-link.active svg { opacity: 0.9; }

        .mgr-sidebar-footer {
            padding: 12px 0;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .mgr-sidebar-footer form { display: inline; }

        .mgr-sidebar-footer button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 20px;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            font-size: 0.85rem;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .mgr-sidebar-footer button:hover {
            color: rgba(255,255,255,0.8);
            background: var(--mgr-sidebar-hover);
        }

        .mgr-main {
            flex: 1;
            margin-left: var(--mgr-sidebar-width);
            min-height: 100vh;
            padding: 0;
        }

        .mgr-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            background: var(--mgr-surface);
            border-bottom: 1px solid var(--mgr-border);
        }

        .mgr-topbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--mgr-text);
        }

        .mgr-topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: var(--mgr-text-muted);
        }

        .mgr-topbar-user .role-badge {
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            background: rgba(46, 204, 113, 0.15);
            color: var(--mgr-accent);
        }

        .mgr-content {
            padding: 32px;
        }

        .mgr-card {
            background: var(--mgr-surface);
            border: 1px solid var(--mgr-border);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .mgr-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .mgr-card-title {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .mgr-table-wrap {
            overflow-x: auto;
        }

        .mgr-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .mgr-table th {
            text-align: left;
            padding: 10px 12px;
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--mgr-text-muted);
            border-bottom: 2px solid var(--mgr-border);
        }

        .mgr-table td {
            padding: 12px;
            border-bottom: 1px solid var(--mgr-border);
            vertical-align: middle;
        }

        .mgr-table tr:hover td {
            background: rgba(46, 204, 113, 0.03);
        }

        .mgr-table .actions {
            display: flex;
            gap: 6px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            font-size: 0.8rem;
            font-weight: 500;
            border-radius: 8px;
            border: 1px solid var(--mgr-border);
            background: var(--mgr-surface);
            color: var(--mgr-text);
            cursor: pointer;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background: var(--mgr-bg);
            border-color: #d1d5db;
        }

        .btn-primary {
            background: var(--mgr-accent);
            border-color: var(--mgr-accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--mgr-accent-hover);
            border-color: var(--mgr-accent-hover);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.7rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--mgr-text-muted);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--mgr-border);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: var(--mgr-text);
            background: var(--mgr-surface);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--mgr-accent);
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.1);
        }

        textarea.form-control {
            min-height: 300px;
            line-height: 1.7;
            resize: vertical;
        }

        .mgr-alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mgr-alert.success {
            background: rgba(22, 163, 74, 0.08);
            border: 1px solid rgba(22, 163, 74, 0.15);
            color: var(--mgr-success);
        }

        .mgr-alert.error {
            background: rgba(220, 38, 38, 0.08);
            border: 1px solid rgba(220, 38, 38, 0.15);
            color: var(--mgr-danger);
        }

        .mgr-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .mgr-stat-card {
            background: var(--mgr-surface);
            border: 1px solid var(--mgr-border);
            border-radius: 12px;
            padding: 20px;
        }

        .mgr-stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--mgr-accent);
            line-height: 1;
            margin-bottom: 4px;
        }

        .mgr-stat-label {
            font-size: 0.75rem;
            color: var(--mgr-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .mgr-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .mgr-badge.processing {
            background: rgba(217, 119, 6, 0.1);
            color: var(--mgr-warning);
        }

        .mgr-badge.done {
            background: rgba(22, 163, 74, 0.1);
            color: var(--mgr-success);
        }

        .restricted-notice {
            background: rgba(46, 204, 113, 0.06);
            border: 1px solid rgba(46, 204, 113, 0.12);
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.75rem;
            color: var(--mgr-text-muted);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .mgr-sidebar { display: none; }
            .mgr-main { margin-left: 0; }
            .mgr-content { padding: 20px; }
            .mgr-topbar { padding: 12px 20px; }
            .mgr-stats { grid-template-columns: 1fr 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ═══════════════ Sidebar ═══════════════ --}}
    <aside class="mgr-sidebar">
        <div class="mgr-sidebar-brand">
            <a href="{{ route('manager.dashboard') }}">failure<span>'</span>s dock</a>
            <div class="mgr-sidebar-label">Manager Panel</div>
        </div>

        <nav class="mgr-sidebar-nav">
            <div class="mgr-sidebar-section-title">Content</div>

            <a href="{{ route('manager.dashboard') }}"
               class="mgr-sidebar-link {{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('manager.posts') }}"
               class="mgr-sidebar-link {{ request()->routeIs('manager.posts') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                Blog Posts
            </a>

            <a href="{{ route('manager.post-form') }}"
               class="mgr-sidebar-link {{ request()->routeIs('manager.post-form') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                New Blog Post
            </a>

            <div class="mgr-sidebar-section-title" style="margin-top:8px;">Escapes</div>

            <a href="{{ route('manager.escapes') }}"
               class="mgr-sidebar-link {{ request()->routeIs('manager.escapes') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"/>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                </svg>
                All Escapes
            </a>

            <a href="{{ route('admin.escapes.create') }}"
               class="mgr-sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Upload Escape
            </a>
        </nav>

        <div class="mgr-sidebar-footer">
            <a href="{{ route('escapes.index') }}" target="_blank"
               style="display:flex;align-items:center;gap:10px;padding:10px 20px;color:rgba(255,255,255,0.4);text-decoration:none;font-size:0.85rem;transition:all 0.2s ease;"
               onmouseover="this.style.color='rgba(255,255,255,0.8)';this.style.background='#243238'"
               onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.background='transparent'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                </svg>
                View Site
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ═══════════════ Main Content ═══════════════ --}}
    <main class="mgr-main">
        <div class="mgr-topbar">
            <h1 class="mgr-topbar-title">@yield('page-title', 'Dashboard')</h1>
            <div class="mgr-topbar-user">
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <span class="role-badge">Manager</span>
                @endauth
            </div>
        </div>

        <div class="mgr-content">
            <div class="restricted-notice">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                You are in the <strong>Manager Panel</strong> — you can add and edit content, but cannot delete.
            </div>

            @if (session('success'))
                <div class="mgr-alert success">✓ {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mgr-alert error">✗ {{ session('error') }}</div>
            @endif

            @yield('mgr-content')
        </div>
    </main>

</body>
</html>
