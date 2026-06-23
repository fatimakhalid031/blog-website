@extends('layouts.app')

@section('title', 'Escapes')

@section('content')
<style>
.escapes-viewer {
    position: fixed;
    inset: 0;
    background: var(--bg-deep);
    z-index: 50;
    display: flex;
    overflow: hidden;
}

/* Navigation zones */
.viewer-nav {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 35%;
    z-index: 10;
    cursor: pointer;
    display: flex;
    align-items: center;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.escapes-viewer:hover .viewer-nav { opacity: 0.5; }
.viewer-nav:hover { opacity: 1 !important; }
.viewer-nav-prev { left: 0; justify-content: flex-start; padding-left: 16px; }
.viewer-nav-next { right: 0; justify-content: flex-end; padding-right: 16px; }

.viewer-nav-arrow {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.04);
    display: flex; align-items: center; justify-content: center;
    backdrop-filter: blur(8px);
    color: rgba(255,255,255,0.2);
    transition: all 0.3s ease;
}
.viewer-nav:hover .viewer-nav-arrow {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.5);
}

/* Slide */
.viewer-slide {
    position: absolute;
    inset: 0;
    display: flex;
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}
.viewer-slide.active {
    opacity: 1;
    pointer-events: all;
}

/* Left: Video */
.viewer-video {
    flex: 1.2;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000;
}
.viewer-video video {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Right: Content */
.viewer-content {
    flex: 0.8;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px 48px;
    max-width: 460px;
}

.viewer-label {
    font-size: 0.55rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
    margin-bottom: 16px;
}

.viewer-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2.2rem;
    font-weight: 400;
    color: var(--cream);
    line-height: 1.08;
    margin-bottom: 18px;
    letter-spacing: -0.02em;
}

.viewer-desc {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.85rem;
    line-height: 1.7;
    color: var(--driftwood-light);
    font-weight: 400;
    margin-bottom: 24px;
}

.viewer-meta {
    display: flex;
    gap: 16px;
    font-size: 0.65rem;
    color: var(--driftwood-light);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-family: 'Inter', sans-serif;
}

/* Progress */
.viewer-progress {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    gap: 4px;
    z-index: 10;
    padding: 12px 16px 0;
    pointer-events: none;
}
.viewer-progress-bar {
    flex: 1;
    height: 2px;
    border-radius: 2px;
    background: rgba(255,255,255,0.08);
    transition: background 0.4s ease;
}
.viewer-progress-bar.active { background: rgba(255,255,255,0.35); }

/* Empty */
.escapes-empty {
    position: fixed; inset: 0;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    background: var(--bg-deep); z-index: 50;
}
.escapes-empty-icon { font-size: 2.4rem; margin-bottom: 12px; opacity: 0.15; }
.escapes-empty-text { font-family: 'Caveat', cursive; font-size: 1.2rem; color: var(--driftwood-light); }

@media (max-width: 768px) {
    .viewer-slide { flex-direction: column; }
    .viewer-video { flex: none; height: 50vh; }
    .viewer-content { flex: none; padding: 32px 24px; max-width: 100%; }
    .viewer-title { font-size: 1.4rem; }
    .viewer-nav { width: 25%; }
    .viewer-nav-arrow { width: 32px; height: 32px; }
}
</style>

@if($escapes->count() > 0)
<div class="escapes-viewer" id="escapesViewer">
    <!-- Progress bars -->
    <div class="viewer-progress">
        @foreach($escapes as $i => $escape)
            <span class="viewer-progress-bar {{ $i === 0 ? 'active' : '' }}"></span>
        @endforeach
    </div>

    <!-- Navigation -->
    <div class="viewer-nav viewer-nav-prev" onclick="prevSlide()">
        <span class="viewer-nav-arrow">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M11 4L6 9L11 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>
    <div class="viewer-nav viewer-nav-next" onclick="nextSlide()">
        <span class="viewer-nav-arrow">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M7 4L12 9L7 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>

    <!-- Slides -->
    @foreach($escapes as $i => $escape)
    <div class="viewer-slide {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">
        <div class="viewer-video">
            <video controls preload="metadata" playsinline {{ $i === 0 ? 'autoplay' : '' }} muted loop>
                <source src="{{ asset('storage/' . $escape->file_path) }}" type="{{ $escape->mime_type ?: 'video/webm' }}">
            </video>
        </div>
        <div class="viewer-content">
            <div class="viewer-label">✦ Escape</div>
            <h1 class="viewer-title">{{ $escape->title }}</h1>
            @if($escape->description)
                <p class="viewer-desc">{{ $escape->description }}</p>
            @endif
            <div class="viewer-meta">
                <span>{{ $escape->formatted_file_size }}</span>
                <span>{{ $escape->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
const slides = document.querySelectorAll('.viewer-slide');
const bars = document.querySelectorAll('.viewer-progress-bar');
const total = slides.length;
let current = 0;
let touchStartX = 0;

function goTo(index) {
    if (index < 0 || index >= total) return;
    slides[current].classList.remove('active');
    bars[current].classList.remove('active');
    slides[current].querySelector('video')?.pause();
    current = index;
    slides[current].classList.add('active');
    bars[current].classList.add('active');
    slides[current].querySelector('video')?.play();
}
function nextSlide() { goTo((current + 1) % total); }
function prevSlide() { goTo((current - 1 + total) % total); }

document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') nextSlide();
    if (e.key === 'ArrowLeft') prevSlide();
    if (e.key === 'Escape') window.location.href = '{{ route("home") }}';
});

document.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; });
document.addEventListener('touchend', (e) => {
    const diff = touchStartX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 50) {
        if (diff > 0) nextSlide();
        else prevSlide();
    }
});
</script>
@else
<div class="escapes-empty">
    <div class="escapes-empty-icon">🌊</div>
    <div class="escapes-empty-text">No escapes yet. The shore is quiet.</div>
</div>
@endif
@endsection
