@extends('layouts.app')

@section('title', "failure's dock")

@section('content')
<style>
/* ── Base ── */
body::before { display: none; }

/* ── HERO ── */
.hero-full {
    position: relative; width: 100%; min-height: 100vh;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    overflow: hidden;
}
.hero-bg { position: absolute; inset: -20px; z-index: 0; }
.hero-bg img { width: 100%; height: 100%; object-fit: cover; display: block; }

.hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(20,30,40,0.2) 0%, rgba(160,110,70,0.12) 40%, transparent 70%);
}

.hero-content {
    position: relative; z-index: 3; text-align: center; padding: 0 24px;
    animation: fadeUp 0.8s ease forwards;
}
.hero-title {
    font-family: 'DM Serif Display', serif;
    font-size: 5.2rem; font-weight: 400; line-height: 1.02;
    color: white; margin-bottom: 12px;
    letter-spacing: -0.02em;
    text-shadow: 0 2px 30px rgba(0,0,0,0.15), 0 0 80px rgba(232,168,124,0.1);
    animation: fadeUp 0.8s ease 0.1s both;
}
.hero-sub {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.25rem; color: rgba(255,255,255,0.88);
    font-weight: 400; font-style: italic;
    margin-bottom: 0;
    text-shadow: 0 2px 30px rgba(0,0,0,0.2);
    letter-spacing: 0.02em;
    animation: fadeUp 0.8s ease 0.2s both;
}
.hero-cta-row {
    margin-top: 40px;
    animation: fadeUp 0.8s ease 0.35s both;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ── CTA BUTTON ── */
.hero-cta-btn {
    display: inline-flex;
    align-items: center; gap: 10px;
    padding: 16px 40px;
    background: rgba(255,255,255,0.08);
    border: 1.5px solid rgba(255,255,255,0.15);
    border-radius: 14px;
    color: white;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    backdrop-filter: blur(12px);
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.hero-cta-btn:hover {
    background: rgba(255,255,255,0.14);
    border-color: rgba(255,255,255,0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}
.hero-cta-btn svg { transition: transform 0.3s ease; }
.hero-cta-btn:hover svg { transform: translateX(4px); }

/* ── COMPASS ── */
.compass-rose {
    position: absolute; top: 80px; left: 36px;
    z-index: 4; width: 60px; height: 60px;
    pointer-events: none;
    filter: drop-shadow(0 2px 12px rgba(0,0,0,0.1));
}
.compass-rose svg { width: 100%; height: auto; }
.compass-needle { transform-origin: 22px 22px; transition: transform 0.12s ease-out; }

/* ── ENVELOPE ── */
.bottle-sand {
    position: absolute; bottom: 28px; right: 40px;
    z-index: 4; cursor: pointer;
    transition: transform 0.5s ease;
}
.bottle-sand:hover { transform: translateY(-6px) rotate(-3deg); }
.bottle-sand .bottle-img {
    width: 90px; height: 70px;
    display: flex; align-items: center; justify-content: center;
    transform: rotate(-3deg);
    transition: all 0.3s ease;
    filter: drop-shadow(0 3px 12px rgba(0,0,0,0.15));
}
.bottle-sand:hover .bottle-img { transform: rotate(-3deg) scale(1.08); filter: drop-shadow(0 5px 18px rgba(0,0,0,0.2)); }
.bottle-sand .bottle-img svg { width: 100%; height: 100%; }

.bottle-sand::after {
    content: '';
    position: absolute; bottom: -2px; left: -12px; right: -8px;
    height: 20px;
    background: radial-gradient(ellipse at 50% 0%, rgba(200,180,160,0.35) 0%, transparent 70%);
    border-radius: 50%;
    transition: all 0.4s ease;
}
.bottle-sand:hover::after { background: radial-gradient(ellipse at 50% 0%, rgba(200,180,160,0.55) 0%, transparent 70%); height: 28px; }
.bottle-sand .bottle-wiggle { transform-origin: bottom center; animation: none; }
.bottle-sand:hover .bottle-wiggle { animation: bottleWiggle 0.6s ease-in-out 3; }
@keyframes bottleWiggle { 0%,100%{transform:rotate(0deg)} 25%{transform:rotate(3deg)} 75%{transform:rotate(-3deg)} }

/* ── BOTTOM LINKS (on hero) ── */
.hero-top-links {
    position: absolute; bottom: 32px; left: 50%;
    transform: translateX(-50%); z-index: 10;
    display: flex; align-items: center; gap: 10px;
}
.hero-link {
    font-size: 0.7rem; letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.5);
    transition: all 0.3s ease;
    font-weight: 400;
    padding: 5px 14px;
    border-radius: 20px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);
}
.hero-link:hover { color: white; background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.15); }
.hero-link-logbook { display: inline-flex; align-items: center; }

/* ── SHORE FOREGROUND ── */
.shore-foreground {
    position: absolute; bottom: 0; left: 0; right: 0; z-index: 2; height: 160px; pointer-events: none;
}
.shore-foreground svg { width: 100%; height: 100%; }

/* ── BOTTLE POPUP ── */
.bottle-popup-overlay {
    position: fixed; inset: 0; z-index: 499;
    background: rgba(0,0,0,0.15); backdrop-filter: blur(4px);
    opacity: 0; visibility: hidden; transition: opacity 0.3s ease;
}
.bottle-popup-overlay.open { opacity: 1; visibility: visible; }
.bottle-popup {
    position: fixed; top: 50%; left: 50%;
    transform: translate(-50%, -50%) scale(0.85);
    z-index: 500; max-width: 380px; width: 90%;
    padding: 40px 36px 28px;
    background: rgba(245,237,224,0.95); backdrop-filter: blur(16px);
    border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    opacity: 0; visibility: hidden;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-align: center; border: 1px solid rgba(255,255,255,0.3);
}
.bottle-popup.open { opacity: 1; visibility: visible; transform: translate(-50%, -50%) scale(1); }
.bottle-popup-close {
    position: absolute; top: 10px; right: 14px;
    border: none; background: none; font-size: 1.2rem; cursor: pointer;
    color: #999; font-family: 'Inter', sans-serif; padding: 4px;
}
.bottle-popup-close:hover { color: #333; }
.bottle-popup-label {
    font-size: 0.55rem; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--driftwood); margin-bottom: 14px;
}
.bottle-popup-text { font-family: 'Caveat', cursive; font-size: 1.4rem; line-height: 1.6; color: var(--navy); margin-bottom: 10px; }
.bottle-popup-author { font-size: 0.7rem; color: var(--driftwood); font-style: italic; }

/* ── CONTENT SECTIONS (below hero) ── */
.home-section {
    padding: 72px 24px;
    position: relative;
}
.home-section-inner {
    max-width: 900px;
    margin: 0 auto;
}

.home-section-dark {
    background: rgba(30,45,50,0.3);
    border-top: 1px solid rgba(200,180,160,0.04);
    border-bottom: 1px solid rgba(200,180,160,0.04);
}

.section-label {
    font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase;
    color: var(--driftwood-light); margin-bottom: 12px;
    display: flex; align-items: center; gap: 8px;
}
.section-label::before {
    content: '';
    width: 20px; height: 1px;
    background: var(--driftwood-light);
}

.section-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2rem; font-weight: 400;
    color: var(--cream); margin-bottom: 12px;
}
.section-sub {
    font-family: 'Libre Baskerville', serif;
    font-size: 0.9rem; font-style: italic;
    color: var(--driftwood-light); margin-bottom: 40px;
    max-width: 600px;
}

/* ── FEATURED CARDS ── */
.featured-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.featured-card {
    background: rgba(30, 45, 50, 0.88);
    backdrop-filter: blur(8px);
    border-radius: 16px;
    padding: 28px 24px 24px;
    border: 1px solid rgba(200,180,160,0.1);
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    display: flex; flex-direction: column;
}
.featured-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 36px rgba(0,0,0,0.08);
    border-color: var(--gold);
}
.featured-card-date {
    font-family: 'Caveat', cursive;
    font-size: 0.85rem; color: var(--clay);
    margin-bottom: 8px;
}
.featured-card-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.05rem; font-weight: 400; line-height: 1.35;
    color: var(--cream); margin-bottom: 10px;
    transition: color 0.25s ease;
}
.featured-card:hover .featured-card-title { color: var(--gold); }
.featured-card-excerpt {
    font-size: 0.8rem; color: #555; line-height: 1.6;
    flex: 1; margin-bottom: 14px;
}
.featured-card-meta {
    display: flex; align-items: center; gap: 12px;
    font-size: 0.65rem; color: var(--clay);
    text-transform: uppercase; letter-spacing: 0.08em;
}

/* ── ABOUT SECTION ── */
.home-about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: start;
}
.home-about-text p {
    font-size: 0.95rem; color: var(--driftwood-light); line-height: 1.8; margin-bottom: 16px;
}
.home-about-visual {
    position: relative;
    display: flex; align-items: center; justify-content: center;
}
.home-about-book {
    width: 140px; height: 170px;
    display: flex; align-items: center; justify-content: center;
}
.home-about-book svg { width: 100%; height: 100%; filter: drop-shadow(0 4px 20px rgba(0,0,0,0.06)); }

/* ── NEWSLETTER ── */
.newsletter-box {
    background: rgba(30, 45, 50, 0.88);
    backdrop-filter: blur(8px);
    border-radius: 20px;
    padding: 48px 40px;
    text-align: center;
    border: 1px solid rgba(200,180,160,0.1);
    box-shadow: 0 2px 16px rgba(0,0,0,0.04);
}
.newsletter-title {
    font-family: 'DM Serif Display', serif;
    font-size: 1.6rem; font-weight: 400;
    color: var(--cream); margin-bottom: 6px;
}
.newsletter-sub {
    font-family: 'Caveat', cursive;
    font-size: 1rem; color: var(--driftwood-light);
    margin-bottom: 24px;
}
.newsletter-form {
    display: flex; gap: 10px; max-width: 440px; margin: 0 auto;
}
.newsletter-input {
    flex: 1; padding: 14px 18px;
    border: 1px solid rgba(160,137,107,0.2);
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    background: rgba(255,255,255,0.6);
    color: var(--ink);
    outline: none;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}
.newsletter-input:focus {
    border-color: var(--ocean);
    box-shadow: 0 0 0 3px rgba(129,191,188,0.1);
}
.newsletter-btn {
    padding: 14px 28px;
    background: var(--ocean);
    border: none; border-radius: 12px;
    color: white; font-family: 'Inter', sans-serif;
    font-size: 0.8rem; font-weight: 500;
    letter-spacing: 0.08em; text-transform: uppercase;
    cursor: pointer; transition: all 0.25s ease;
    white-space: nowrap;
}
.newsletter-btn:hover { background: var(--ocean-dark); transform: translateY(-1px); }

@media (max-width: 768px) {
    .hero-title { font-size: 2.8rem; }
    .hero-sub { font-size: 1rem; }
    .hero-cta-btn { padding: 14px 28px; font-size: 0.75rem; }
    .compass-rose { display: none; }
    .hero-top-links { gap: 6px; bottom: 24px; }
    .hero-link { font-size: 0.55rem; padding: 4px 10px; }
    .featured-grid { grid-template-columns: 1fr; }
    .home-about-grid { grid-template-columns: 1fr; gap: 32px; }
    .home-about-visual { order: -1; }
    .newsletter-form { flex-direction: column; }
    .newsletter-box { padding: 32px 24px; }
    .bottle-sand { display: none; }
}
</style>

@php
$bottleMessages = [
    ['text' => "The ship is safe in the harbour, but that's not what ships are built for.", 'author' => 'John A. Shedd'],
    ['text' => 'Failure is simply the opportunity to begin again, this time more intelligently.', 'author' => 'Henry Ford'],
    ['text' => 'Rock bottom became the solid foundation on which I rebuilt my life.', 'author' => 'J.K. Rowling'],
    ['text' => 'It is impossible to live without failing at something, unless you live so cautiously that you might as well not have lived at all.', 'author' => 'J.K. Rowling'],
    ['text' => 'There is no failure except in no longer trying.', 'author' => 'Elbert Hubbard'],
    ['text' => 'The only real failure in life is not to be true to the best one knows.', 'author' => 'Buddha'],
    ['text' => 'I have not failed. I\'ve just found 10,000 ways that won\'t work.', 'author' => 'Thomas Edison'],
    ['text' => 'Our greatest glory is not in never falling, but in rising every time we fall.', 'author' => 'Confucius'],
    ['text' => 'Told myself I\'d wake up at 5am. My alarm clock has trust issues now.', 'author' => '— From the Dock'],
    ['text' => 'Every master was once a disaster. Some of us are just taking the scenic route.', 'author' => '— From the Dock'],
];
$randomMsg = $bottleMessages[array_rand($bottleMessages)];
$featured = $posts->take(3);
@endphp

<!-- ═══════════════ HERO ═══════════════ -->
<section class="hero-full">
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1475924156734-496f6cac6ec1?w=1600&q=80&auto=format"
             alt="Dark dreamy sea at sunset with moody clouds" loading="eager">
        <div class="hero-overlay"></div>
    </div>

    <!-- Compass -->
    <div class="compass-rose" id="compassRose">
        <svg viewBox="0 0 44 44" fill="none">
            <circle cx="22" cy="22" r="20" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
            <circle cx="22" cy="22" r="14" stroke="rgba(255,255,255,0.1)" stroke-width="0.8"/>
            <polygon points="22,4 24,20 22,22 20,20" fill="rgba(255,230,180,0.4)"/>
            <polygon points="22,40 20,24 22,22 24,24" fill="rgba(255,255,255,0.15)"/>
            <polygon points="4,22 20,20 22,22 20,24" fill="rgba(255,255,255,0.12)"/>
            <polygon points="40,22 24,24 22,22 24,20" fill="rgba(255,255,255,0.12)"/>
            <g class="compass-needle">
                <polygon points="22,6 24,22 22,24 20,22" fill="rgba(255,200,150,0.65)"/>
                <polygon points="22,38 20,22 22,20 24,22" fill="rgba(200,200,200,0.25)"/>
                <circle cx="22" cy="22" r="2.5" fill="rgba(255,230,180,0.55)"/>
                <circle cx="22" cy="22" r="1" fill="rgba(255,230,180,0.8)"/>
            </g>
            <text x="22" y="9" text-anchor="middle" fill="rgba(255,255,255,0.3)" font-size="5" font-family="Inter" font-weight="500">N</text>
            <text x="22" y="37" text-anchor="middle" fill="rgba(255,255,255,0.15)" font-size="4.5" font-family="Inter">S</text>
            <text x="35" y="23.5" text-anchor="middle" fill="rgba(255,255,255,0.15)" font-size="4.5" font-family="Inter">E</text>
            <text x="9" y="23.5" text-anchor="middle" fill="rgba(255,255,255,0.15)" font-size="4.5" font-family="Inter">W</text>
        </svg>
    </div>

    <!-- Envelope -->
    <div class="bottle-sand" onclick="openBottleMsg()" title="Message in a bottle" style="right: auto; left: 36px;">
        <div class="bottle-wiggle">
            <div class="bottle-img">
                <svg viewBox="0 0 72 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Envelope body -->
                    <rect x="6" y="12" width="60" height="38" rx="3" fill="rgba(245,237,224,0.4)" stroke="rgba(245,237,224,0.5)" stroke-width="1.5"/>
                    <!-- Inner glow -->
                    <rect x="8" y="14" width="56" height="34" rx="2" fill="rgba(250,240,230,0.12)"/>
                    <!-- Flap -->
                    <path d="M6 16 L36 36 L66 16" stroke="rgba(245,237,224,0.4)" stroke-width="1.5" fill="rgba(250,240,230,0.2)" stroke-linecap="round" stroke-linejoin="round"/>
                    <!-- Gold wax seal -->
                    <circle cx="36" cy="32" r="9" fill="rgba(200,170,100,0.25)" stroke="rgba(200,170,100,0.4)" stroke-width="1.2"/>
                    <circle cx="36" cy="32" r="6" fill="rgba(200,170,100,0.12)" stroke="rgba(200,170,100,0.2)" stroke-width="0.8"/>
                    <circle cx="36" cy="32" r="3" fill="rgba(200,170,100,0.08)"/>
                    <!-- Anchor emblem on seal -->
                    <path d="M33 32 L36 28 L39 32 L36 35 Z" fill="rgba(200,170,100,0.25)"/>
                    <!-- Letter lines -->
                    <line x1="14" y1="22" x2="28" y2="22" stroke="rgba(200,180,160,0.2)" stroke-width="1.2" stroke-linecap="round"/>
                    <line x1="14" y1="28" x2="26" y2="28" stroke="rgba(200,180,160,0.15)" stroke-width="1.2" stroke-linecap="round"/>
                    <line x1="14" y1="34" x2="24" y2="34" stroke="rgba(200,180,160,0.12)" stroke-width="1.2" stroke-linecap="round"/>
                    <line x1="14" y1="40" x2="22" y2="40" stroke="rgba(200,180,160,0.1)" stroke-width="1.2" stroke-linecap="round"/>
                    <!-- Address side -->
                    <line x1="44" y1="23" x2="58" y2="23" stroke="rgba(200,180,160,0.12)" stroke-width="0.8" stroke-linecap="round"/>
                    <line x1="46" y1="29" x2="56" y2="29" stroke="rgba(200,180,160,0.1)" stroke-width="0.8" stroke-linecap="round"/>
                    <line x1="48" y1="35" x2="54" y2="35" stroke="rgba(200,180,160,0.08)" stroke-width="0.8" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="hero-content">
        <h1 class="hero-title">failure's dock</h1>
        <p class="hero-sub">a harbour for everything that didn't work out</p>

        <div class="hero-cta-row">
            <a href="{{ route('entries') }}" class="hero-cta-btn">
                <span>Read the Logbook</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M6 4L10 8L6 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Shore -->
    <div class="shore-foreground">
        <svg viewBox="0 0 1440 160" preserveAspectRatio="none">
            <path d="M0 70 Q180 50 360 75 Q540 100 720 65 Q900 30 1080 60 Q1260 90 1440 50 L1440 160 L0 160 Z" fill="rgba(30,25,20,0.25)"/>
            <path d="M0 90 Q200 75 400 95 Q600 115 800 85 Q1000 55 1200 80 Q1320 95 1440 75 L1440 160 L0 160 Z" fill="rgba(40,35,28,0.2)"/>
            <path d="M0 115 Q300 100 600 110 Q900 120 1200 100 Q1320 90 1440 105 L1440 160 L0 160 Z" fill="rgba(50,42,32,0.15)"/>
            <g transform="translate(80, 10)" fill="rgba(10,12,8,0.3)">
                <path d="M20 80 Q18 45 22 0" stroke="rgba(10,12,8,0.3)" stroke-width="3" fill="none"/>
                <path d="M22 5 Q0 15 -30 10 Q-10 20 22 15"/><path d="M22 8 Q10 0 25 -25 Q28 -5 22 10"/>
                <path d="M22 5 Q35 10 55 5 Q40 18 22 12"/><path d="M22 6 Q30 -5 40 -20 Q32 0 22 10"/>
                <path d="M22 4 Q15 -10 10 -30 Q20 -8 22 8"/>
            </g>
            <g transform="translate(1300, 5) scale(-1, 1)" fill="rgba(10,12,8,0.25)">
                <path d="M20 80 Q18 45 22 0" stroke="rgba(10,12,8,0.25)" stroke-width="3" fill="none"/>
                <path d="M22 5 Q0 15 -35 12 Q-10 22 22 15"/><path d="M22 8 Q10 0 30 -28 Q30 -5 22 10"/>
                <path d="M22 5 Q38 10 60 5 Q42 18 22 12"/><path d="M22 6 Q32 -5 45 -22 Q35 0 22 10"/>
                <path d="M22 4 Q15 -10 8 -32 Q20 -8 22 8"/>
            </g>
        </svg>
    </div>

    <!-- Bottom links -->
    <div class="hero-top-links">
        <a href="{{ route('about') }}" class="hero-link">About this place</a>
        <a href="{{ route('blogger') }}" class="hero-link">Meet the blogger</a>
        <a href="{{ route('entries') }}" class="hero-link hero-link-logbook">
            <svg viewBox="0 0 16 18" fill="none" width="12" height="14" style="margin-right: 4px;">
                <rect x="1" y="1" width="14" height="16" rx="2" stroke="currentColor" stroke-width="1.2" fill="none"/>
                <line x1="4" y1="5" x2="12" y2="5" stroke="currentColor" stroke-width="0.8"/>
                <line x1="4" y1="8" x2="10" y2="8" stroke="currentColor" stroke-width="0.8"/>
                <line x1="4" y1="11" x2="11" y2="11" stroke="currentColor" stroke-width="0.8"/>
            </svg>
            Logbook
        </a>
    </div>
</section>

<!-- ═══════════════ RECENT DISCOVERIES ═══════════════ -->
@if($featured->count() > 0)
<section class="home-section" id="discoveries">
    <div class="home-section-inner">
        <div class="section-label">Discover</div>
        <h2 class="section-title">Recent Discoveries</h2>
        <p class="section-sub">Fresh entries from the logbook — stories, lessons, and half-baked thoughts.</p>

        <div class="featured-grid">
            @foreach($featured as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="featured-card">
                <div class="featured-card-date">{{ $post->formatted_date }}</div>
                <h3 class="featured-card-title">{{ $post->title }}</h3>
                @if($post->excerpt)
                <p class="featured-card-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}</p>
                @endif
                <div class="featured-card-meta">
                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                    @if($post->category)
                    <span>·</span>
                    <span>{{ $post->category }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ═══════════════ ABOUT THIS PLACE ═══════════════ -->
<section class="home-section home-section-dark" id="about">
    <div class="home-section-inner">
        <div class="home-about-grid">
            <div class="home-about-text">
                <div class="section-label">Philosophy</div>
                <h2 class="section-title">About This Place</h2>
                <p><em>Failure's Dock</em> is a harbour for everything that didn't work out. Failed projects, abandoned ideas, half-baked attempts, and the quiet lessons that only come from falling short.</p>
                <p>We live in a world obsessed with success stories. But I've always been more interested in what happens in the background — the drafts, the near-misses, the things we tried and let go.</p>
                <p>This is a dock where those things can rest. Not as trophies of failure, but as proof that we tried. That we were brave enough to begin, even when we didn't know how things would end.</p>
            </div>
            <div class="home-about-visual">
                <div class="home-about-book">
                    <svg viewBox="0 0 72 84" fill="none">
                        <circle cx="40" cy="42" r="40" fill="rgba(245,237,224,0.06)" filter="blur(8px)"/>
                        <rect x="8" y="10" width="56" height="64" rx="4" fill="rgba(180,155,125,0.6)" stroke="rgba(200,180,160,0.6)" stroke-width="2"/>
                        <rect x="12" y="8" width="52" height="64" rx="3" fill="rgba(255,250,240,0.7)" stroke="rgba(232,213,196,0.4)" stroke-width="1.2"/>
                        <line x1="16" y1="18" x2="60" y2="18" stroke="rgba(160,135,105,0.4)" stroke-width="1.2"/>
                        <line x1="16" y1="24" x2="55" y2="24" stroke="rgba(160,135,105,0.35)" stroke-width="1.2"/>
                        <line x1="16" y1="30" x2="58" y2="30" stroke="rgba(160,135,105,0.35)" stroke-width="1.2"/>
                        <line x1="16" y1="36" x2="52" y2="36" stroke="rgba(160,135,105,0.3)" stroke-width="1.2"/>
                        <line x1="16" y1="42" x2="56" y2="42" stroke="rgba(160,135,105,0.3)" stroke-width="1.2"/>
                        <line x1="16" y1="48" x2="50" y2="48" stroke="rgba(160,135,105,0.25)" stroke-width="1.2"/>
                        <rect x="8" y="10" width="6" height="64" rx="2" fill="rgba(120,95,65,0.6)" stroke="rgba(140,115,85,0.4)" stroke-width="0.8"/>
                        <rect x="7" y="14" width="8" height="3" rx="1" fill="rgba(220,190,120,0.45)"/>
                        <rect x="7" y="67" width="8" height="3" rx="1" fill="rgba(220,190,120,0.45)"/>
                        <path d="M66 12 L66 42 L63 39 L60 42 L60 12" fill="rgba(210,110,85,0.45)" stroke="rgba(210,110,85,0.3)" stroke-width="0.8"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ RECEIVE NEW DISCOVERIES ═══════════════ -->
<section class="home-section" id="connect">
    <div class="home-section-inner">
        <div class="newsletter-box">
            <div class="section-label" style="justify-content: center; justify-content: center;">Stay connected</div>
            <h2 class="newsletter-title">Receive New Discoveries</h2>
            <p class="newsletter-sub">Gentle reminders that failure is just the scenic route.</p>
            <form class="newsletter-form" action="#" onsubmit="event.preventDefault(); alert('Thank you! (Newsletter coming soon)')">
                <input type="email" class="newsletter-input" placeholder="your@email.com" required>
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- Bottle Message Popup -->
<div class="bottle-popup-overlay" id="bottleOverlay" onclick="closeBottleMsg()"></div>
<div class="bottle-popup" id="bottleMsg">
    <button class="bottle-popup-close" onclick="closeBottleMsg()">✕</button>
    <div class="bottle-popup-label">Message in a bottle</div>
    <div class="bottle-popup-text">{{ $randomMsg['text'] }}</div>
    <div class="bottle-popup-author">— {{ $randomMsg['author'] }}</div>
</div>

<script>
const bottleMessages = @json($bottleMessages);
function openBottleMsg() {
    const msg = bottleMessages[Math.floor(Math.random() * bottleMessages.length)];
    document.getElementById('bottleMsg').querySelector('.bottle-popup-text').textContent = msg.text;
    document.getElementById('bottleMsg').querySelector('.bottle-popup-author').textContent = '— ' + msg.author;
    document.getElementById('bottleOverlay').classList.add('open');
    document.getElementById('bottleMsg').classList.add('open');
}
function closeBottleMsg() {
    document.getElementById('bottleOverlay').classList.remove('open');
    document.getElementById('bottleMsg').classList.remove('open');
}

// Compass
document.addEventListener('mousemove', (e) => {
    const compass = document.getElementById('compassRose');
    if (!compass) return;
    const rect = compass.getBoundingClientRect();
    const cx = rect.left + rect.width / 2, cy = rect.top + rect.height / 2;
    const angle = Math.atan2(e.clientY - cy, e.clientX - cx) * (180 / Math.PI);
    const needle = compass.querySelector('.compass-needle');
    if (needle) needle.style.transform = `rotate(${angle + 45}deg)`;
});

document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeBottleMsg(); });
</script>
@endsection
