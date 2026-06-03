@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="banner-wrap">
        <img
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=1200&q=80&auto=format"
            alt="Misty forest path"
            class="banner banner-sm"
            loading="eager"
        >
    </div>

    <div class="about-content">
        <h1>About this place</h1>

        <p>
            <em>Failure's Dock</em> is a harbour for everything that didn't work out.
            Failed projects, abandoned ideas, half-baked attempts, and the quiet lessons
            that only come from falling short.
        </p>

        <p>
            We live in a world obsessed with success stories — the highlight reels, the
            overnight sensations, the carefully curated wins. But I've always been more
            interested in what happens in the background. The drafts. The near-misses.
            The things we tried and let go.
        </p>

        <p>
            This is a dock where those things can rest. Not as trophies of failure, but
            as proof that we tried. That we were brave enough to begin, even when we
            didn't know how things would end.
        </p>

        <p>
            If something here resonates — if it makes you feel a little less alone in
            your own unfinished projects — then this dock has done its job.
        </p>

        <div class="signature">
            — Fatima
        </div>
    </div>
@endsection
