@extends('layouts.app')

@section('title', "failure's dock")

@section('content')
    <div class="banner-wrap">
        <img
            src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=80&auto=format"
            alt="Mist over mountains at dusk"
            class="banner"
            loading="eager"
        >
    </div>

    <section class="hero-section">
        <h1 class="hero-title">Failures,<br>half-baked attempts,<br>& lessons learned.</h1>
        <p class="hero-subtitle">A dock where failed projects rest, abandoned ideas find peace, and every dead end becomes a story worth telling.</p>
        <div class="scroll-hint">
            <span class="line"></span>
            <span>scroll for entries</span>
        </div>
    </section>

    @if($posts->count() > 0)
        <h2 class="section-heading">Latest entries</h2>

        @foreach($posts as $post)
            <article class="post-card">
                <div class="post-meta">{{ $post->formatted_date }}</div>
                <a href="{{ route('blog.show', $post->slug) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                </a>
                @if($post->excerpt)
                    <p class="post-excerpt">{{ $post->excerpt }}</p>
                @endif
                @if($post->category)
                    <span class="post-category">{{ $post->category }}</span>
                @endif
            </article>
        @endforeach

        <div class="pagination">
            {{ $posts->links() }}
        </div>
    @else
        <div style="padding: 60px 0; text-align: center; color: #aaa;">
            <p style="font-family: 'Playfair Display', serif; font-size: 1.2rem; font-style: italic;">No entries yet.</p>
            <p style="font-size: 0.8rem; margin-top: 8px;">The page is blank, waiting to be filled.</p>
        </div>
    @endif
@endsection
