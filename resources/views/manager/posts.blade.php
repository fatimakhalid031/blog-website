@extends('manager.layout')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('mgr-content')
    <div class="mgr-card">
        <div class="mgr-card-header">
            <h2 class="mgr-card-title">All Posts</h2>
            <a href="{{ route('manager.post-form') }}" class="btn btn-primary btn-sm">+ New Post</a>
        </div>
        @if($posts->count() > 0)
        <div class="mgr-table-wrap">
            <table class="mgr-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td style="font-weight:500;">{{ $post->title }}</td>
                        <td style="color:var(--mgr-text-muted);font-size:0.8rem;">{{ $post->slug ?? '—' }}</td>
                        <td style="color:var(--mgr-text-muted);font-size:0.8rem;">{{ $post->created_at->format('M j, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('manager.post-edit', $post) }}" class="btn btn-sm">Edit</a>
                                {{-- No delete button — managers cannot delete posts --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--mgr-text-muted);font-size:0.9rem;padding:20px 0;">
            No blog posts yet.
            <a href="{{ route('manager.post-form') }}" style="color:var(--mgr-accent);">Write your first post</a>.
        </p>
        @endif
    </div>
@endsection
