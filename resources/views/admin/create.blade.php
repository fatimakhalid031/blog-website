@extends('layouts.app')

@section('title', 'New Entry')

@section('content')
    <div style="max-width: 700px;">
        <p style="font-size: 0.75rem; color: #b8a890; margin-bottom: 4px; letter-spacing: 0.1em; text-transform: uppercase;">✦ write</p>
        <h1 style="font-size: 1.6rem; margin-bottom: 32px;">new entry</h1>

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title') <span style="font-size: 0.75rem; color: #c65d47;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. musings, poetry, diary">
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt (a short preview)</label>
                <textarea name="excerpt" id="excerpt" class="form-control" rows="3" style="min-height: 80px;">{{ old('excerpt') }}</textarea>
            </div>

            <div class="form-group">
                <label for="featured_image">Featured image URL (optional)</label>
                <input type="url" name="featured_image" id="featured_image" class="form-control" value="{{ old('featured_image') }}">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                <label for="is_published" style="margin: 0; text-transform: none; letter-spacing: normal; color: #1a1a1a; font-size: 0.85rem;">Publish immediately</label>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 32px;">
                <button type="submit" class="btn">Save</button>
                <a href="{{ route('admin.index') }}" style="padding: 8px 20px; font-size: 0.75rem; color: #888;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
