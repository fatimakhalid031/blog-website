@extends('layouts.admin')

@section('title', $post ? 'Edit Post' : 'New Post')
@section('page-title', $post ? 'Edit Post' : 'New Post')

@section('admin-content')
    <div class="admin-card" style="max-width:720px;">
        <form action="{{ $post ? route('admin.post-update', $post) : route('admin.post-store') }}" method="POST">
            @csrf
            @if($post) @method('PUT') @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title', $post->title ?? '') }}" required>
                @error('title')
                    <div style="color:var(--admin-danger);font-size:0.75rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug <span style="font-weight:400;text-transform:none;letter-spacing:0;">(leave blank to auto-generate)</span></label>
                <input type="text" id="slug" name="slug" class="form-control"
                       value="{{ old('slug', $post->slug ?? '') }}" placeholder="my-post-title">
                @error('slug')
                    <div style="color:var(--admin-danger);font-size:0.75rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt <span style="font-weight:400;text-transform:none;letter-spacing:0;">(optional, shown in listings)</span></label>
                <textarea id="excerpt" name="excerpt" class="form-control" rows="2" style="min-height:60px;">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">Category <span style="font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                <input type="text" id="category" name="category" class="form-control"
                       value="{{ old('category', $post->category ?? '') }}" placeholder="e.g. Reflection">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body" name="body" class="form-control" rows="16" required>{{ old('body', $post->body ?? '') }}</textarea>
                @error('body')
                    <div style="color:var(--admin-danger);font-size:0.75rem;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn btn-primary">
                    {{ $post ? 'Update Post' : 'Publish Post' }}
                </button>
                <a href="{{ route('admin.posts') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
@endsection
