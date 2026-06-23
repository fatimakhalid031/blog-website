@extends('layouts.app')

@section('title', 'Edit Escape')

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
    min-height: 100px;
    line-height: 1.7;
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.88rem;
    resize: vertical;
}

.desk-form-error {
    font-size: 0.75rem;
    color: #c65d47;
    display: block;
    margin-top: 4px;
}

/* ── Video preview ── */
.desk-form-preview {
    margin-bottom: 24px;
    border-radius: 12px;
    overflow: hidden;
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(196,137,90,0.06);
    position: relative;
}
.desk-form-preview video {
    width: 100%;
    max-height: 200px;
    object-fit: contain;
    display: block;
}
.desk-form-preview-label {
    position: absolute;
    top: 8px;
    left: 10px;
    font-size: 0.5rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.3);
    font-family: 'Inter', sans-serif;
    background: rgba(0,0,0,0.4);
    padding: 3px 8px;
    border-radius: 4px;
}

/* ── Current file info ── */
.desk-form-fileinfo {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    padding: 12px 16px;
    background: rgba(245,237,224,0.02);
    border-radius: 10px;
    border: 1px solid rgba(196,137,90,0.04);
}
.desk-form-fileinfo-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.72rem;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
}
.desk-form-fileinfo-item svg {
    width: 14px;
    height: 14px;
    opacity: 0.3;
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

@media (max-width: 768px) {
    .desk-form-card {
        padding: 28px 24px 24px;
    }
}
</style>

<div class="desk-form-page">
    <div class="desk-form-header">
        <div class="desk-form-label">revise</div>
        <h1 class="desk-form-title">edit escape</h1>
    </div>

    <div class="desk-form-card">
        <form action="{{ route('admin.escapes.update', $escape) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Video preview --}}
            @if($escape->file_path)
            <div class="desk-form-preview">
                <span class="desk-form-preview-label">Preview</span>
                <video controls preload="metadata" muted>
                    <source src="{{ asset('storage/' . $escape->file_path) }}" type="{{ $escape->mime_type ?: 'video/webm' }}">
                </video>
            </div>
            @endif

            {{-- Current file info --}}
            <div class="desk-form-fileinfo">
                <div class="desk-form-fileinfo-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <span>{{ $escape->original_name ?? pathinfo($escape->file_path, PATHINFO_BASENAME) }}</span>
                </div>
                <div class="desk-form-fileinfo-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span>{{ $escape->formatted_file_size }}</span>
                </div>
                <div class="desk-form-fileinfo-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    <span>{{ $escape->created_at->format('M j, Y') }}</span>
                </div>
            </div>

            <div class="desk-form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="desk-form-control"
                       value="{{ old('title', $escape->title) }}" required>
                @error('title') <span class="desk-form-error">{{ $message }}</span> @enderror
            </div>

            <div class="desk-form-group">
                <label for="description">Description <span style="font-weight: 300; opacity: 0.4;">(optional)</span></label>
                <textarea name="description" id="description" class="desk-form-control" rows="3">{{ old('description', $escape->description) }}</textarea>
                @error('description') <span class="desk-form-error">{{ $message }}</span> @enderror
            </div>

            <div class="desk-form-actions">
                <button type="submit" class="btn" style="min-width: 120px;">Update</button>
                <a href="{{ route('admin.escapes.index') }}" class="desk-form-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
