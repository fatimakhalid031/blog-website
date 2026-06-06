@extends('layouts.app')

@section('title', 'Upload Escape')

@section('content')
<style>
.upload-page {
    padding: 120px 24px 80px;
    max-width: 600px;
    margin: 0 auto;
}
.upload-title {
    font-family: 'DM Serif Display', serif;
    font-size: 1.8rem;
    font-weight: 400;
    color: var(--cream);
    margin-bottom: 8px;
}
.upload-sub {
    font-size: 0.85rem;
    color: var(--driftwood-light);
    margin-bottom: 36px;
}
.upload-form .form-group { margin-bottom: 24px; }
.upload-form label {
    display: block;
    font-size: 0.7rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    margin-bottom: 6px;
    font-family: 'Inter', sans-serif;
}
.upload-form .form-control {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid rgba(196,137,90,0.1);
    background: rgba(245,237,224,0.04);
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    color: var(--cream);
    border-radius: 10px;
    transition: all 0.25s ease;
}
.upload-form .form-control:focus {
    outline: none;
    border-color: var(--gold);
    background: rgba(245,237,224,0.06);
    box-shadow: 0 0 0 3px rgba(196,137,90,0.06);
}
.upload-form .form-control::placeholder {
    color: var(--driftwood);
    opacity: 0.5;
}

.upload-form input[type="file"]::file-selector-button {
    padding: 8px 16px;
    border: 1px solid rgba(196,137,90,0.15);
    border-radius: 8px;
    background: rgba(196,137,90,0.06);
    color: var(--gold-light);
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    cursor: pointer;
    margin-right: 12px;
    transition: all 0.25s ease;
}
.upload-form input[type="file"]::file-selector-button:hover {
    background: rgba(196,137,90,0.1);
}

.upload-hint {
    font-size: 0.7rem;
    color: var(--driftwood);
    margin-top: 4px;
}

.upload-btn {
    padding: 14px 36px;
    background: var(--gold);
    border: none;
    border-radius: 12px;
    color: white;
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.25s ease;
}
.upload-btn:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(196,137,90,0.2);
}
.upload-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

#uploadProgress {
    display: none;
    margin-top: 16px;
}
.progress-bar {
    width: 100%;
    height: 4px;
    background: rgba(196,137,90,0.06);
    border-radius: 4px;
    overflow: hidden;
    margin-top: 8px;
}
.progress-fill {
    height: 100%;
    background: var(--gold);
    border-radius: 4px;
    width: 0%;
    transition: width 0.3s ease;
}
.progress-text {
    font-size: 0.75rem;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
}
</style>

<div class="upload-page">
    <h1 class="upload-title">Upload Escape</h1>
    <p class="upload-sub">Share a quiet moment — WebM video up to 10 MB.</p>

    <form class="upload-form" method="POST" action="{{ route('admin.escapes.store') }}" enctype="multipart/form-data" id="uploadForm">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g. Sunset at the harbour">
            @error('title') <span style="font-size:0.75rem;color:#c65d47;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="description">Description <span style="font-weight:300;opacity:0.5;">(optional)</span></label>
            <textarea name="description" id="description" class="form-control" rows="3" placeholder="A quiet moment...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="video">Video (WebM only, max 10 MB)</label>
            <input type="file" name="video" id="video" class="form-control" accept=".webm,video/webm" required>
            @error('video') <span style="font-size:0.75rem;color:#c65d47;">{{ $message }}</span> @enderror
            <div class="upload-hint">⏻ WebM format recommended for best playback</div>
        </div>

        <div id="uploadProgress">
            <div class="progress-text">Uploading... <span id="progressPercent">0</span>%</div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>

        <button type="submit" class="upload-btn" id="submitBtn">Upload Escape</button>
    </form>
</div>

<script>
document.getElementById('uploadForm')?.addEventListener('submit', function(e) {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Uploading...';

    document.getElementById('uploadProgress').style.display = 'block';

    // Simulated progress (actual progress would need axios with onUploadProgress)
    let p = 0;
    const interval = setInterval(() => {
        p += Math.random() * 15;
        if (p > 90) p = 90;
        document.getElementById('progressFill').style.width = p + '%';
        document.getElementById('progressPercent').textContent = Math.round(p);
    }, 300);

    // Let the form submit naturally — progress stops on page redirect
    setTimeout(() => clearInterval(interval), 30000);
});
</script>
@endsection
