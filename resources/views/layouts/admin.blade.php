<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — failure's dock</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --admin-bg: #f4f5f7;
            --admin-surface: #ffffff;
            --admin-sidebar: #1a2428;
            --admin-sidebar-hover: #243238;
            --admin-sidebar-active: #2c3e50;
            --admin-text: #1a1a2e;
            --admin-text-muted: #6b7280;
            --admin-border: #e5e7eb;
            --admin-accent: #c4895a;
            --admin-accent-hover: #d4a070;
            --admin-danger: #dc2626;
            --admin-success: #16a34a;
            --admin-warning: #d97706;
            --admin-sidebar-width: 240px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.5;
        }

        /* ── Sidebar ── */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--admin-sidebar-width);
            height: 100vh;
            background: var(--admin-sidebar);
            display: flex;
            flex-direction: column;
            z-index: 50;
            overflow-y: auto;
        }

        .admin-sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .admin-sidebar-brand a {
            font-size: 1rem;
            font-weight: 600;
            color: #f5ede0;
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .admin-sidebar-brand a span { color: var(--admin-accent); }

        .admin-sidebar-label {
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            margin-top: 4px;
            font-weight: 400;
        }

        .admin-sidebar-nav {
            flex: 1;
            padding: 12px 0;
        }

        .admin-sidebar-section-title {
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.2);
            padding: 16px 20px 6px;
            font-weight: 500;
        }

        .admin-sidebar-link {
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

        .admin-sidebar-link:hover {
            background: var(--admin-sidebar-hover);
            color: rgba(255,255,255,0.9);
        }

        .admin-sidebar-link.active {
            background: var(--admin-sidebar-hover);
            color: var(--admin-accent);
            border-left-color: var(--admin-accent);
        }

        .admin-sidebar-link svg {
            width: 16px;
            height: 16px;
            opacity: 0.5;
            flex-shrink: 0;
        }

        .admin-sidebar-link.active svg { opacity: 0.9; }

        .admin-sidebar-footer {
            padding: 12px 0;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .admin-sidebar-footer form { display: inline; }

        .admin-sidebar-footer button {
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

        .admin-sidebar-footer button:hover {
            color: rgba(255,255,255,0.8);
            background: var(--admin-sidebar-hover);
        }

        /* ── Main ── */
        .admin-main {
            flex: 1;
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            padding: 0;
        }

        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            background: var(--admin-surface);
            border-bottom: 1px solid var(--admin-border);
        }

        .admin-topbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--admin-text);
        }

        .admin-topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: var(--admin-text-muted);
        }

        .admin-content {
            padding: 32px;
        }

        /* ── Cards ── */
        .admin-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .admin-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .admin-card-title {
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* ── Table ── */
        .admin-table-wrap {
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .admin-table th {
            text-align: left;
            padding: 10px 12px;
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--admin-text-muted);
            border-bottom: 2px solid var(--admin-border);
        }

        .admin-table td {
            padding: 12px;
            border-bottom: 1px solid var(--admin-border);
            vertical-align: middle;
        }

        .admin-table tr:hover td {
            background: rgba(196, 137, 90, 0.03);
        }

        .admin-table .actions {
            display: flex;
            gap: 6px;
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            font-size: 0.8rem;
            font-weight: 500;
            border-radius: 8px;
            border: 1px solid var(--admin-border);
            background: var(--admin-surface);
            color: var(--admin-text);
            cursor: pointer;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background: var(--admin-bg);
            border-color: #d1d5db;
        }

        .btn-primary {
            background: var(--admin-accent);
            border-color: var(--admin-accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--admin-accent-hover);
            border-color: var(--admin-accent-hover);
        }

        .btn-danger {
            background: var(--admin-danger);
            border-color: var(--admin-danger);
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
            border-color: #b91c1c;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.7rem;
        }

        /* ── Forms ── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--admin-text-muted);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: var(--admin-text);
            background: var(--admin-surface);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 3px rgba(196, 137, 90, 0.1);
        }

        textarea.form-control {
            min-height: 300px;
            line-height: 1.7;
            resize: vertical;
        }

        /* ── Alert ── */
        .admin-alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .admin-alert.success {
            background: rgba(22, 163, 74, 0.08);
            border: 1px solid rgba(22, 163, 74, 0.15);
            color: var(--admin-success);
        }

        .admin-alert.error {
            background: rgba(220, 38, 38, 0.08);
            border: 1px solid rgba(220, 38, 38, 0.15);
            color: var(--admin-danger);
        }

        .admin-alert.info {
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.15);
            color: #2563eb;
        }

        /* ── Stats ── */
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .admin-stat-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 20px;
        }

        .admin-stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--admin-accent);
            line-height: 1;
            margin-bottom: 4px;
        }

        .admin-stat-label {
            font-size: 0.75rem;
            color: var(--admin-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ── Badge ── */
        .admin-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .admin-badge.processing {
            background: rgba(217, 119, 6, 0.1);
            color: var(--admin-warning);
        }

        .admin-badge.done {
            background: rgba(22, 163, 74, 0.1);
            color: var(--admin-success);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .admin-sidebar { display: none; }
            .admin-main { margin-left: 0; }
            .admin-content { padding: 20px; }
            .admin-topbar { padding: 12px 20px; }
            .admin-stats { grid-template-columns: 1fr 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ═══════════════ Sidebar ═══════════════ --}}
    <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">
            <a href="{{ route('admin.index') }}">failure<span>'</span>s dock</a>
            <div class="admin-sidebar-label">Admin Panel</div>
        </div>

        <nav class="admin-sidebar-nav">
            <div class="admin-sidebar-section-title">Content</div>

            <a href="{{ route('admin.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.posts') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.posts') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                Blog Posts
            </a>

            <a href="{{ route('admin.post-form') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.post-form') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                New Blog Post
            </a>

            <div class="admin-sidebar-section-title" style="margin-top:8px;">Escapes</div>

            <a href="{{ route('admin.escapes.manage') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.escapes.manage') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"/>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                </svg>
                All Escapes
            </a>

            <a href="{{ route('admin.escapes.create') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.escapes.create') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Upload Escape
            </a>
        </nav>

        <div class="admin-sidebar-footer">
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
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-topbar-title">@yield('page-title', 'Dashboard')</h1>
            <div class="admin-topbar-user">
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <span class="role-badge" style="padding:3px 10px;border-radius:12px;font-size:11px;font-weight:600;text-transform:uppercase;background:rgba(196,137,90,0.15);color:var(--admin-accent);">Admin</span>
                @endauth
            </div>
        </div>

        <div class="admin-content">
            @if (session('success'))
                <div class="admin-alert success">✓ {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="admin-alert error">✗ {{ session('error') }}</div>
            @endif

            @yield('admin-content')
        </div>
    </main>

</body>
</html>
