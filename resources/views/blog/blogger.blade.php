@extends('layouts.app')

@section('title', 'Meet the Blogger')

@section('content')
<style>
/* ── Immersive Dock Scene ── */
.dock-scene {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
}

.dock-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    background:
        radial-gradient(ellipse at 20% 80%, rgba(196,137,90,0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 20%, rgba(44,62,80,0.12) 0%, transparent 40%),
        linear-gradient(180deg, rgba(20,30,40,0.35) 0%, rgba(16,24,28,0.6) 100%);
}
.dock-bg-img {
    position: absolute;
    inset: 0;
    z-index: -1;
}
.dock-bg-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ── Water shimmer ── */
.dock-water {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 200px;
    overflow: hidden;
    pointer-events: none;
    z-index: 0;
}
.dock-water svg {
    width: 100%;
    height: 100%;
    opacity: 0.12;
    animation: waterDrift 12s ease-in-out infinite alternate;
}
@keyframes waterDrift {
    0% { transform: translateX(-20px) scaleY(1); }
    100% { transform: translateX(20px) scaleY(1.08); }
}

/* ── Dock planks ── */
.dock-planks {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    opacity: 0.05;
    background-image:
        repeating-linear-gradient(
            90deg,
            transparent 0px,
            transparent 119px,
            rgba(196,137,90,0.15) 119px,
            rgba(196,137,90,0.15) 120px
        ),
        repeating-linear-gradient(
            0deg,
            transparent 0px,
            transparent 29px,
            rgba(196,137,90,0.06) 29px,
            rgba(196,137,90,0.06) 30px
        );
}

/* ── Lantern ── */
.dock-lantern {
    position: fixed;
    top: 100px;
    right: 40px;
    z-index: 5;
    opacity: 0.25;
    pointer-events: none;
    animation: lanternSway 6s ease-in-out infinite;
}
@keyframes lanternSway {
    0%, 100% { transform: rotate(-2deg); }
    50% { transform: rotate(2deg); }
}

/* ── The Letter ── */
.letter-container {
    position: relative;
    z-index: 2;
    max-width: 820px;
    margin: 0 auto;
    padding: 100px 24px 120px;
}

.letter-card {
    position: relative;
    background: linear-gradient(
        165deg,
        rgba(252, 246, 238, 0.94) 0%,
        rgba(245, 237, 224, 0.90) 40%,
        rgba(238, 228, 212, 0.93) 100%
    );
    backdrop-filter: blur(12px);
    border-radius: 3px;
    padding: 68px 64px 60px;
    box-shadow:
        0 3px 70px rgba(0,0,0,0.12),
        0 10px 35px rgba(0,0,0,0.06),
        inset 0 1px 0 rgba(255,255,255,0.35);
    border: 1px solid rgba(200,180,160,0.12);
}

/* ── Wax seal ── */
.letter-seal-wrapper {
    position: absolute;
    top: -28px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Ribbon/thread hanging from seal */
.seal-ribbon {
    width: 1.5px;
    height: 20px;
    background: linear-gradient(180deg, rgba(160,120,80,0.4), rgba(160,120,80,0.08));
    margin-bottom: 2px;
}

.letter-seal {
    width: 58px;
    height: 56px;
    border-radius: 50% 50% 50% 50% / 55% 55% 45% 45%;
    background:
        radial-gradient(ellipse at 30% 30%, #e8c090 0%, #c89050 30%, #b07838 55%, #906030 80%, #784820 100%);
    box-shadow:
        0 6px 20px rgba(120, 70, 30, 0.35),
        0 2px 8px rgba(0,0,0,0.15),
        inset 0 -3px 6px rgba(60,30,10,0.25),
        inset 0 3px 8px rgba(255,220,180,0.2);
    position: relative;
    animation: sealGlow 5s ease-in-out infinite;
}
@keyframes sealGlow {
    0%, 100% { box-shadow: 0 6px 20px rgba(120, 70, 30, 0.35), 0 2px 8px rgba(0,0,0,0.15), inset 0 -3px 6px rgba(60,30,10,0.25), inset 0 3px 8px rgba(255,220,180,0.2); }
    50% { box-shadow: 0 8px 28px rgba(120, 70, 30, 0.45), 0 3px 12px rgba(0,0,0,0.18), inset 0 -3px 6px rgba(60,30,10,0.25), inset 0 3px 8px rgba(255,220,180,0.2); }
}

/* Slight irregular edge drip */
.letter-seal::before {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 18px;
    width: 8px;
    height: 4px;
    background: #a07040;
    border-radius: 0 0 50% 50%;
    opacity: 0.4;
}
.letter-seal::after {
    content: '';
    position: absolute;
    bottom: -2px;
    right: 14px;
    width: 5px;
    height: 3px;
    background: #a07040;
    border-radius: 0 0 50% 50%;
    opacity: 0.3;
}

/* Embossed mark on seal */
.seal-emboss {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.seal-emboss svg {
    width: 30px;
    height: 30px;
    opacity: 0.2;
    filter: drop-shadow(0 1px 1px rgba(255,220,180,0.15));
}

/* ── Letter content ── */
.letter-body {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 0.92rem;
    line-height: 1.85;
    color: #2a2520;
    font-weight: 400;
}

.letter-body .greeting {
    font-family: 'Caveat', cursive;
    font-size: 2.4rem;
    color: #b07848;
    margin-bottom: 16px;
    line-height: 1.2;
}

.letter-body p {
    margin-bottom: 1.2em;
}

.letter-body strong {
    color: #1a1510;
    font-weight: 700;
}

/* ── Signature ── */
.letter-signature-area {
    margin-top: 36px;
    padding-top: 20px;
    position: relative;
}
.letter-signature-area::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 70px;
    height: 1px;
    background: linear-gradient(90deg, rgba(196,137,90,0.5), transparent);
}

.letter-signature-name {
    font-family: 'Caveat', cursive;
    font-size: 1.8rem;
    color: #2a2520;
    margin-top: 6px;
    line-height: 1.2;
}
.letter-signature-title {
    font-family: 'Inter', sans-serif;
    font-size: 0.55rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #b8a890;
    margin-top: 2px;
}

/* ── Scribbled failures ── */
.failure-margin {
    margin: 24px -8px;
    padding: 16px 20px 18px;
    background: rgba(200,180,160,0.06);
    border-left: 2px solid rgba(196,137,90,0.15);
    border-radius: 0 8px 8px 0;
}
.failure-margin-note {
    font-family: 'Caveat', cursive;
    font-size: 0.78rem;
    color: #9a8a7a;
    margin-bottom: 8px;
}
.failure-margin-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 3px 0;
    font-family: 'Inter', sans-serif;
    font-size: 0.76rem;
    color: #6a5a4a;
}
.failure-margin-dash {
    color: rgba(196,137,90,0.25);
    flex-shrink: 0;
    font-size: 0.7rem;
}
.failure-margin-item em {
    color: #9a8a7a;
    font-size: 0.7rem;
}

/* ── Social link ── */
.social-link {
    color: #6a5a4a !important;
    text-decoration: underline;
    text-underline-offset: 3px;
    text-decoration-color: rgba(196,137,90,0.15);
    transition: all 0.3s ease;
}
.social-link:hover {
    color: #b07848 !important;
    text-decoration-color: #b07848;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .letter-card {
        padding: 48px 24px 36px;
    }
    .letter-container {
        padding: 80px 16px 100px;
    }
    .letter-body {
        font-size: 0.85rem;
    }
    .dock-lantern { display: none; }
}
</style>

<div class="dock-scene">
    {{-- Background image --}}
    <div class="dock-bg-img">
        <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1600&q=80&auto=format" alt="Starry night over the ocean" loading="eager">
    </div>
    <div class="dock-bg"></div>

    {{-- Water --}}
    <div class="dock-water">
        <svg viewBox="0 0 1440 200" preserveAspectRatio="none">
            <path d="M0 80 Q180 60 360 85 Q540 110 720 75 Q900 40 1080 70 Q1260 100 1440 60 L1440 200 L0 200 Z" fill="rgba(196,137,90,0.06)"/>
        </svg>
    </div>

    {{-- Dock planks --}}
    <div class="dock-planks"></div>

    {{-- Lantern --}}
    <div class="dock-lantern">
        <svg width="28" height="48" viewBox="0 0 28 48" fill="none">
            <rect x="10" y="2" width="8" height="4" rx="1" fill="rgba(196,137,90,0.3)"/>
            <rect x="6" y="6" width="16" height="24" rx="2" fill="rgba(196,137,90,0.08)" stroke="rgba(196,137,90,0.2)" stroke-width="0.8"/>
            <circle cx="14" cy="18" r="6" fill="rgba(196,137,90,0.12)"/>
            <circle cx="14" cy="18" r="3" fill="rgba(196,137,90,0.06)"/>
            <rect x="10" y="30" width="8" height="3" rx="1" fill="rgba(196,137,90,0.2)"/>
            <line x1="14" y1="33" x2="14" y2="42" stroke="rgba(196,137,90,0.15)" stroke-width="0.5"/>
        </svg>
    </div>

    {{-- The Letter --}}
    <div class="letter-container">
        <div class="letter-card">

            {{-- Wax seal --}}
            <div class="letter-seal-wrapper">
                <div class="seal-ribbon"></div>
                <div class="letter-seal">
                    <div class="seal-emboss">
                        <svg viewBox="0 0 30 30" fill="none">
                            <path d="M10 16 L14 7 L18 16 Z" stroke="rgba(200,170,100,0.25)" stroke-width="0.8" fill="none"/>
                            <path d="M14 7 L14 18" stroke="rgba(200,170,100,0.15)" stroke-width="0.6"/>
                            <circle cx="14" cy="14" r="11" stroke="rgba(200,170,100,0.12)" stroke-width="0.4" fill="none"/>
                            <path d="M8 19 Q14 23 20 19" stroke="rgba(200,170,100,0.12)" stroke-width="0.4" fill="none"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="letter-body">

                <div class="greeting">Dear wanderer,</div>

                <p>If you're reading this, you've made it all the way to the end of the dock. That alone tells me something about you.</p>

                <p>I'm <strong>Fatima</strong> — someone who's never quite been able to choose between a good book and a good piece of code, so I stopped trying. I spend my days weaving words and building things, finding stories in the small moments no one else seems to notice: the way the light hits the wall at 4pm, the half-drunk coffee that's gone cold, the comfortable silence between two people who understand each other.</p>

                <p>I've co-authored two anthologies — <em>Kalamkariyan</em> and <em>Whispers of Eternity</em> — and what those taught me is that every story we share makes the world a little less lonely. That stuck with me.</p>

                <p>But this blog? It's not about the things that worked. It's about the things that didn't. The drafts that never became anything. The ideas that fizzled out. The mornings I swore I'd wake up early — and then didn't. Because honestly? I think we learn more from the stuff we mess up than from the stuff we get right.</p>

                {{-- Failures scribbled in margin --}}
                <div class="failure-margin">
                    <div class="failure-margin-note">things currently docked here:</div>
                    <div class="failure-margin-item"><span class="failure-margin-dash">—</span> tried to learn guitar <em>(May 2026)</em></div>
                    <div class="failure-margin-item"><span class="failure-margin-dash">—</span> started a newsletter, it died <em>(March 2026)</em></div>
                    <div class="failure-margin-item"><span class="failure-margin-dash">—</span> 5am mornings — made it one day <em>(Jan 2026)</em></div>
                    <div class="failure-margin-item"><span class="failure-margin-dash">—</span> that sourdough starter <em>(Dec 2025)</em></div>
                </div>

                <p>If that resonates — if you've ever started something and let it go, if you're trying to be kinder to your own unfinished stories — I'm glad you found this place. There's room for all of us here.</p>

                <p>I share bits and pieces on Instagram: <a href="https://instagram.com/invisibleink.knp" target="_blank" class="social-link">@invisibleink.knp</a>, if you want to say hello.</p>

                {{-- Signature --}}
                <div class="letter-signature-area">
                    <div style="font-family: 'Caveat', cursive; font-size: 0.95rem; color: #8a7a6a;">anyway, with warmth —</div>
                    <div class="letter-signature-name">Fatima</div>
                    <div class="letter-signature-title">keeper of Failure's Dock</div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
