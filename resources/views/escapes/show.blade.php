@extends('layouts.app')

@section('title', $escape->title)

@section('content')
<style>
.escape-show {
    display: flex;
    min-height: 100vh;
    width: 100%;
    background: var(--bg-deep);
}

.escape-show-video {
    flex: 1.2;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000;
    position: relative;
    overflow: hidden;
}
.escape-show-video video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.escape-show-content {
    flex: 0.8;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px 48px;
    max-width: 480px;
}

.escape-show-label {
    font-size: 0.55rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--driftwood);
    font-family: 'Inter', sans-serif;
    margin-bottom: 16px;
}

.escape-show-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2.4rem;
    font-weight: 400;
    color: var(--cream);
    line-height: 1.08;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
}

.escape-show-desc {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.85rem;
    line-height: 1.7;
    color: var(--driftwood-light);
    font-weight: 400;
    margin-bottom: 24px;
}

.escape-show-meta {
    display: flex;
    gap: 16px;
    font-size: 0.65rem;
    color: var(--driftwood);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-family: 'Inter', sans-serif;
}

.escape-show-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 40px;
    font-size: 0.65rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--driftwood);
    font-family: 'Inter', sans-serif;
    transition: color 0.3s ease;
    text-decoration: none;
}
.escape-show-back:hover {
    color: var(--gold-light);
}

@media (max-width: 768px) {
    .escape-show {
        flex-direction: column;
        min-height: auto;
    }
    .escape-show-video {
        flex: none;
        height: 50vh;
    }
    .escape-show-content {
        flex: none;
        padding: 40px 24px;
        max-width: 100%;
    }
    .escape-show-title {
        font-size: 1.6rem;
    }
}
</style>

<div class="escape-show">
    <div class="escape-show-video">
        <video controls autoplay muted loop playsinline>
            <source src="{{ asset('storage/' . $escape->file_path) }}" type="{{ $escape->mime_type ?: 'video/webm' }}">
        </video>
    </div>
    <div class="escape-show-content">
        <div class="escape-show-label">✦ Escape</div>
        <h1 class="escape-show-title">{{ $escape->title }}</h1>
        @if($escape->description)
            <p class="escape-show-desc">{{ $escape->description }}</p>
        @endif
        <div class="escape-show-meta">
            <span>{{ $escape->formatted_file_size }}</span>
            <span>{{ $escape->created_at->diffForHumans() }}</span>
        </div>
        <a href="{{ route('escapes.index') }}" class="escape-show-back">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M8 2L4 6L8 10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            All escapes
        </a>
    </div>
</div>
@endsection
