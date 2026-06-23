@extends('layouts.app')

@section('title', 'New Entry')

@section('content')
<style>
.desk-form-page {
    max-width: 700px;
    margin: 0 auto;
    padding: 100px 24px 80px;
}

.desk-form-header {
    margin-bottom: 36px;
}
.desk-form-label {
    font-size: 0.65rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
    margin-bottom: 4px;
}
.desk-form-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2rem;
    font-weight: 400;
    color: var(--cream);
    line-height: 1.15;
    letter-spacing: -0.02em;
}

.desk-form-card {
    background: rgba(245,237,224,0.03);
    border: 1px solid rgba(196,137,90,0.06);
    border-radius: 16px;
    padding: 40px 40px 36px;
}

.desk-form-group {
    margin-bottom: 24px;
}
.desk-form-group label {
    display: block;
    font-size: 0.7rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    margin-bottom: 6px;
    font-family: 'Inter', sans-serif;
}

.desk-form-control {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid rgba(196,137,90,0.1);
    background: rgba(245,237,224,0.04);
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    color: var(--cream);
    border-radius: 10px;
    transition: all 0.25s ease;
    outline: none;
}
.desk-form-control:focus {
    border-color: var(--gold);
    background: rgba(245,237,224,0.06);
    box-shadow: 0 0 0 3px rgba(196,137,90,0.06);
}
.desk-form-control::placeholder {
    color: var(--driftwood);
    opacity: 0.4;
}
textarea.desk-form-control {
    min-height: 400px;
    line-height: 1.8;
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.88rem;
    resize: vertical;
}
textarea.desk-form-control.sm {
    min-height: 80px;
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
}

.desk-form-error {
    font-size: 0.75rem;
    color: #c65d47;
    display: block;
    margin-top: 4px;
}

.desk-form-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 0;
}
.desk-form-checkbox label {
    margin: 0;
    text-transform: none;
    letter-spacing: normal;
    color: var(--driftwood-light);
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
}
.desk-form-checkbox input {
    width: 16px;
    height: 16px;
    accent-color: var(--gold);
    cursor: pointer;
}

.desk-form-actions {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid rgba(196,137,90,0.04);
}
.desk-form-cancel {
    font-size: 0.75rem;
    color: var(--driftwood-light);
    text-decoration: none;
    transition: color 0.2s ease;
    padding: 8px 12px;
}
.desk-form-cancel:hover {
    color: var(--gold-light);
}
</style>

<div class="desk-form-page">
    <div class="desk-form-header">
        <div class="desk-form-label">write</div>
        <h1 class="desk-form-title">new entry</h1>
    </div>

    <div class="desk-form-card">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="desk-form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="desk-form-control" value="{{ old('title') }}" required placeholder="e.g. On the Quiet Art of Staying">
                @error('title') <span class="desk-form-error">{{ $message }}</span> @enderror
            </div>

            <div class="desk-form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="desk-form-control" value="{{ old('category') }}" placeholder="e.g. musings, poetry, diary">
            </div>

            <div class="desk-form-group">
                <label for="excerpt">Excerpt <span style="font-weight: 300; opacity: 0.4;">(a short preview)</span></label>
                <textarea name="excerpt" id="excerpt" class="desk-form-control sm" rows="3">{{ old('excerpt') }}</textarea>
            </div>

            <div class="desk-form-group">
                <label for="featured_image">Featured image URL <span style="font-weight: 300; opacity: 0.4;">(optional)</span></label>
                <input type="url" name="featured_image" id="featured_image" class="desk-form-control" value="{{ old('featured_image') }}" placeholder="https://images.unsplash.com/...">
            </div>

            <div class="desk-form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="desk-form-control" required>{{ old('content') }}</textarea>
            </div>

            <div class="desk-form-checkbox">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                <label for="is_published">Publish immediately</label>
            </div>

            <div class="desk-form-actions">
                <button type="submit" class="btn">Save</button>
                <a href="{{ route('admin.index') }}" class="desk-form-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
