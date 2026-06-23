@extends('manager.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('mgr-content')
    @php
        $postsCount = $posts->count();
        $escapesCount = $escapes->count();
        $recentPosts = $posts->where('created_at', '>=', now()->subWeek())->count();
    @endphp

    <div class="mgr-stats">
        <div class="mgr-stat-card">
            <div class="mgr-stat-number">{{ $postsCount }}</div>
            <div class="mgr-stat-label">Blog Posts</div>
        </div>
        <div class="mgr-stat-card">
            <div class="mgr-stat-number">{{ $escapesCount }}</div>
            <div class="mgr-stat-label">Escapes</div>
        </div>
        <div class="mgr-stat-card">
            <div class="mgr-stat-number">{{ $recentPosts }}</div>
            <div class="mgr-stat-label">Posted This Week</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">
        <a href="{{ route('manager.posts') }}" class="mgr-card" style="text-decoration:none;color:inherit;display:block;transition:border-color 0.2s;"
           onmouseover="this.style.borderColor='var(--mgr-accent)'" onmouseout="this.style.borderColor='var(--mgr-border)'">
            <div style="font-size:0.75rem;color:var(--mgr-text-muted);margin-bottom:4px;">Manage</div>
            <div style="font-weight:600;">Blog Posts →</div>
        </a>
        <a href="{{ route('manager.escapes') }}" class="mgr-card" style="text-decoration:none;color:inherit;display:block;transition:border-color 0.2s;"
           onmouseover="this.style.borderColor='var(--mgr-accent)'" onmouseout="this.style.borderColor='var(--mgr-border)'">
            <div style="font-size:0.75rem;color:var(--mgr-text-muted);margin-bottom:4px;">Manage</div>
            <div style="font-weight:600;">Escapes →</div>
        </a>
    </div>

    <div class="mgr-card">
        <div class="mgr-card-header">
            <h2 class="mgr-card-title">Recent Blog Posts</h2>
            <a href="{{ route('manager.post-form') }}" class="btn btn-primary btn-sm">+ New Post</a>
        </div>
        @if(isset($posts) && $posts->count() > 0)
        <div class="mgr-table-wrap">
            <table class="mgr-table">
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
                        <td style="color:var(--mgr-text-muted);font-size:0.8rem;">{{ $post->created_at->format('M j, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('manager.post-edit', $post) }}" class="btn btn-sm">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--mgr-text-muted);font-size:0.9rem;padding:12px 0;">
            No posts yet.
            <a href="{{ route('manager.post-form') }}" style="color:var(--mgr-accent);">Write your first post</a>.
        </p>
        @endif
    </div>
@endsection
