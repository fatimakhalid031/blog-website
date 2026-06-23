@extends('layouts.app')

@section('title', 'About — Failure\'s Dock')

@section('content')
<style>
/* ── About: Cinematic Narrative ── */

.about-page {
    position: relative;
    width: 100%;
}

/* Hero Banner */
.about-banner {
    position: relative;
    width: 100%;
    height: 60vh;
    min-height: 420px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.about-banner img {
    position: absolute;
    inset: -20px;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: saturate(0.7) brightness(0.6) contrast(1.1);
}
.about-banner-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(to top, var(--bg-moody) 0%, transparent 40%),
        linear-gradient(to bottom, rgba(20,28,32,0.6) 0%, transparent 30%),
        linear-gradient(135deg, rgba(20,28,32,0.3) 0%, rgba(44,62,80,0.1) 100%);
}
.about-banner-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 0 24px;
    max-width: 640px;
}
.about-banner-label {
    font-size: 0.6rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    margin-bottom: 16px;
    font-family: 'Inter', sans-serif;
}
.about-banner-title {
    font-family: 'DM Serif Display', serif;
    font-size: 3.6rem;
    font-weight: 400;
    color: white;
    line-height: 1.05;
    letter-spacing: -0.02em;
    text-shadow: 0 2px 40px rgba(0,0,0,0.15);
}
.about-banner-sub {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.1rem;
    font-style: italic;
    color: rgba(255,255,255,0.55);
    margin-top: 16px;
}

/* ── Content Container ── */
.about-narrative {
    max-width: 700px;
    margin: 0 auto;
    padding: 60px 24px 80px;
}

/* Pull Quote */
.pull-quote {
    text-align: center;
    padding: 48px 24px;
    margin: 0 0 48px;
    position: relative;
}
.pull-quote::before {
    content: '\201C';
    font-family: 'DM Serif Display', serif;
    font-size: 6rem;
    color: var(--gold);
    opacity: 0.12;
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    line-height: 1;
}
.pull-quote-text {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.6rem;
    font-style: italic;
    color: var(--cream);
    line-height: 1.4;
    max-width: 540px;
    margin: 0 auto;
}
.pull-quote-source {
    font-family: 'Caveat', cursive;
    font-size: 1rem;
    color: var(--driftwood-light);
    margin-top: 12px;
}

/* Narrative Text */
.narrative-block {
    margin-bottom: 48px;
}
.narrative-block:last-child {
    margin-bottom: 0;
}

.narrative-block p {
    font-size: 0.95rem;
    line-height: 1.85;
    color: var(--driftwood-light);
    margin-bottom: 16px;
}
.narrative-block p strong {
    color: var(--cream);
    font-weight: 500;
}
.narrative-block p em {
    color: var(--gold-light);
    font-style: italic;
}

.narrative-heading {
    font-family: 'DM Serif Display', serif;
    font-size: 1.5rem;
    font-weight: 400;
    color: var(--cream);
    margin-bottom: 16px;
    margin-top: 48px;
}

/* Divider */
.narrative-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin: 48px 0;
    opacity: 0.15;
}
.narrative-divider-line { width: 40px; height: 1px; background: var(--gold); }
.narrative-divider-dot { width: 3px; height: 3px; border-radius: 50%; background: var(--gold); }

/* Visual Break */
.visual-break {
    width: 100%;
    height: 200px;
    border-radius: 16px;
    overflow: hidden;
    margin: 40px 0;
    position: relative;
}
.visual-break img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: saturate(0.6) sepia(0.15) brightness(0.65) contrast(1.1);
}
.visual-break::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, var(--bg-moody) 0%, transparent 20%, transparent 80%, var(--bg-moody) 100%);
    pointer-events: none;
}

/* Topics Grid */
.topics-grid-about {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 20px;
}
.topic-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: rgba(245,237,224,0.04);
    border-radius: 12px;
    border: 1px solid rgba(196,137,90,0.06);
    transition: all 0.3s ease;
}
.topic-item:hover {
    background: rgba(245,237,224,0.08);
    border-color: rgba(196,137,90,0.12);
    transform: translateY(-2px);
}
.topic-icon { font-size: 1.2rem; line-height: 1; }
.topic-name {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.85rem;
    color: var(--driftwood-light);
    font-weight: 400;
}

/* Message Section */
.about-message {
    padding: 36px 32px;
    background: rgba(245,237,224,0.04);
    border-radius: 16px;
    border: 1px solid rgba(196,137,90,0.06);
    text-align: center;
    margin: 36px 0;
}
.about-message-icon { width: 40px; height: 40px; margin: 0 auto 14px; opacity: 0.3; }
.about-message-icon svg { width: 100%; height: 100%; }
.about-message-label {
    font-size: 0.5rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
    margin-bottom: 12px;
}
.about-message-text {
    font-family: 'Caveat', cursive;
    font-size: 1.2rem;
    line-height: 1.6;
    color: var(--cream);
    max-width: 420px;
    margin: 0 auto;
}

/* Signature */
.about-signoff {
    text-align: center;
    padding-top: 40px;
    border-top: 1px solid rgba(196,137,90,0.06);
    margin-top: 48px;
}
.about-signoff-text {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.85rem;
    font-style: italic;
    color: var(--driftwood-light);
    max-width: 420px;
    margin: 0 auto 20px;
}
.about-signoff-name {
    font-family: 'Caveat', cursive;
    font-size: 1.6rem;
    color: var(--cream);
    line-height: 1.2;
}
.about-signoff-title {
    font-size: 0.6rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--driftwood-light);
    font-family: 'Inter', sans-serif;
    margin-top: 4px;
}

@media (max-width: 768px) {
    .about-banner { height: 50vh; min-height: 320px; }
    .about-banner-title { font-size: 2.2rem; }
    .pull-quote-text { font-size: 1.2rem; }
    .topics-grid-about { grid-template-columns: 1fr; }
    .about-narrative { padding: 40px 20px 60px; }
    .visual-break { height: 140px; }
}
</style>

<div class="about-page">

    <!-- Banner -->
    <section class="about-banner">
        <img src="https://images.unsplash.com/photo-1475924156734-496f6cac6ec1?w=1400&q=80&auto=format" alt="Dark dreamy sea at sunset" loading="eager">
        <div class="about-banner-overlay"></div>
        <div class="about-banner-content">
            <div class="about-banner-label">✦ Failure's Dock</div>
            <h1 class="about-banner-title">About</h1>
            <p class="about-banner-sub">A harbour for everything that didn't work out</p>
        </div>
    </section>

    <!-- Narrative -->
    <div class="about-narrative">

        <div class="pull-quote">
            <div class="pull-quote-text">Where do broken ships go?</div>
            <div class="pull-quote-source">— a question that started it all</div>
        </div>

        <div class="narrative-block">
            <p>If you're reading this, I think we might be kindred spirits. Because people don't stumble upon a place called <em>Failure's Dock</em> by accident. They come here because something didn't go the way they planned. A dream that quietly faded. A door that closed a little too firmly.</p>

            <p><strong>I want you to know: you are not late. You are not broken. You are not behind.</strong></p>
        </div>

        <!-- Pull quote inset -->
        <div class="visual-break">
            <img src="https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=1200&q=80&auto=format" alt="Open sea at sunset" loading="lazy">
        </div>

        <div class="narrative-block">
            <p>I spent so many nights asking — where do people go when they hit rock bottom? Not the dramatic kind. The quiet 2 AM kind where you're lying awake wondering if any of it matters, and the ceiling has more answers than the people around you.</p>

            <p>And somewhere in the middle of all that wondering, I started writing. Not for anyone. Just to make sense of the noise. And the more I wrote, the more I realised something: <strong>we're all failing our way forward.</strong></p>

            <p>Every person you admire has a graveyard of abandoned ideas and misspoken words. Social media just hides the graveyard and shows you the garden. So I built this dock — a quiet harbour for everything that didn't work out.</p>
        </div>

        <div class="narrative-divider">
            <span class="narrative-divider-line"></span>
            <span class="narrative-divider-dot"></span>
            <span class="narrative-divider-line"></span>
        </div>

        <!-- What You'll Find -->
        <div class="narrative-block">
            <h2 class="narrative-heading">What You'll Find Here</h2>
            <p>Think of this as a collection of things left behind on the dock — each one holds a story, a lesson, or a quiet realisation.</p>

            <div class="topics-grid-about">
                <div class="topic-item"><span class="topic-icon">🧭</span><span class="topic-name">Lessons Learned</span></div>
                <div class="topic-item"><span class="topic-icon">⚓</span><span class="topic-name">Personal Stories</span></div>
                <div class="topic-item"><span class="topic-icon">📖</span><span class="topic-name">Reflections</span></div>
                <div class="topic-item"><span class="topic-icon">🌊</span><span class="topic-name">New Discoveries</span></div>
                <div class="topic-item" style="grid-column: 1 / -1;"><span class="topic-icon">🍂</span><span class="topic-name">Things Left Behind</span></div>
            </div>
        </div>

        <div class="narrative-divider">
            <span class="narrative-divider-line"></span>
            <span class="narrative-divider-dot"></span>
            <span class="narrative-divider-line"></span>
        </div>

        <!-- Message -->
        <div class="about-message">
            <div class="about-message-icon">
                <svg viewBox="0 0 72 54" fill="none">
                    <rect x="6" y="12" width="60" height="38" rx="3" fill="rgba(245,237,224,0.1)" stroke="rgba(196,137,90,0.2)" stroke-width="1"/>
                    <path d="M6 16 L36 36 L66 16" stroke="rgba(196,137,90,0.15)" stroke-width="1" fill="rgba(245,237,224,0.05)"/>
                    <circle cx="36" cy="32" r="7" fill="rgba(196,137,90,0.08)" stroke="rgba(196,137,90,0.12)" stroke-width="0.8"/>
                    <path d="M33 32 L36 28 L39 32 L36 35 Z" fill="rgba(196,137,90,0.08)"/>
                </svg>
            </div>
            <div class="about-message-label">A note left behind</div>
            <div class="about-message-text">"You are not alone in this. The dock is always open."</div>
        </div>

        <!-- Signoff -->
        <div class="about-signoff">
            <div class="about-signoff-text">If something here resonates — if it makes you feel a little less alone in your own unfinished projects — then this dock has done its job.</div>
            <div class="about-signoff-name">— Fatima</div>
            <div class="about-signoff-title">Keeper of Failure's Dock</div>
        </div>

    </div>
</div>
@endsection
