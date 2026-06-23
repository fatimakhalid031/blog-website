@extends('layouts.admin')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('admin-content')
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">All Posts</h2>
            <a href="{{ route('admin.post-form') }}" class="btn btn-primary btn-sm">+ New Post</a>
        </div>
        @if($posts->count() > 0)
        <div class="admin-table-wrap">
            <table class="admin-table">
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
                        <td style="color:var(--admin-text-muted);font-size:0.8rem;">{{ $post->slug ?? '—' }}</td>
                        <td style="color:var(--admin-text-muted);font-size:0.8rem;">{{ $post->created_at->format('M j, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.post-edit', $post) }}" class="btn btn-sm">Edit</a>
                                <form action="{{ route('admin.post-destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--admin-text-muted);font-size:0.9rem;padding:20px 0;">
            No blog posts yet.
            <a href="{{ route('admin.post-form') }}" style="color:var(--admin-accent);">Write your first post</a>.
        </p>
        @endif
    </div>
@endsection
