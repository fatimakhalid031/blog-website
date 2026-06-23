@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('admin-content')
    @php
        $postsCount = $posts->count();
        $escapesCount = $escapes->count();
        $recentPosts = $posts->where('created_at', '>=', now()->subWeek())->count();
    @endphp
    {{-- Stats --}}
    <div class="admin-stats">
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $postsCount }}</div>
            <div class="admin-stat-label">Blog Posts</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $escapesCount }}</div>
            <div class="admin-stat-label">Escapes</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $recentPosts }}</div>
            <div class="admin-stat-label">Posted This Week</div>
        </div>
    </div>

    {{-- Quick links --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">
        <a href="{{ route('admin.posts') }}" class="admin-card" style="text-decoration:none;color:inherit;display:block;transition:border-color 0.2s;"
           onmouseover="this.style.borderColor='var(--admin-accent)'" onmouseout="this.style.borderColor='var(--admin-border)'">
            <div style="font-size:0.75rem;color:var(--admin-text-muted);margin-bottom:4px;">Manage</div>
            <div style="font-weight:600;">Blog Posts →</div>
        </a>
        <a href="{{ route('admin.escapes.manage') }}" class="admin-card" style="text-decoration:none;color:inherit;display:block;transition:border-color 0.2s;"
           onmouseover="this.style.borderColor='var(--admin-accent)'" onmouseout="this.style.borderColor='var(--admin-border)'">
            <div style="font-size:0.75rem;color:var(--admin-text-muted);margin-bottom:4px;">Manage</div>
            <div style="font-weight:600;">Escapes →</div>
        </a>
    </div>

    {{-- Recent posts --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Recent Blog Posts</h2>
            <a href="{{ route('admin.post-form') }}" class="btn btn-primary btn-sm">+ New Post</a>
        </div>
        @if(isset($posts) && $posts->count() > 0)
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts->take(5) as $post)
                    <tr>
                        <td style="font-weight:500;">{{ $post->title }}</td>
                        <td style="color:var(--admin-text-muted);font-size:0.8rem;">{{ $post->created_at->format('M j, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.post-edit', $post) }}" class="btn btn-sm">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--admin-text-muted);font-size:0.9rem;padding:12px 0;">
            No posts yet.
            <a href="{{ route('admin.post-form') }}" style="color:var(--admin-accent);">Write your first post</a>.
        </p>
        @endif
    </div>
@endsection
