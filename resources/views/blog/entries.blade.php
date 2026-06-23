@extends('layouts.app')

@section('title', 'The Logbook')

@section('content')
<style>
.entries-page {
    padding: 120px 24px 80px;
    max-width: 740px;
    margin: 0 auto;
}

.entries-header {
    text-align: center;
    margin-bottom: 56px;
}
.entries-label {
    font-family: 'Caveat', cursive;
    font-size: 1rem;
    color: var(--driftwood-light);
    margin-bottom: 4px;
}
.entries-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2.6rem;
    font-weight: 400;
    color: var(--cream);
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.entry-card {
    display: block;
    text-decoration: none;
    background: rgba(245,237,224,0.06);
    border-radius: 16px;
    padding: 28px 28px 24px;
    margin-bottom: 12px;
    border: 1px solid rgba(196,137,90,0.04);
    transition: all 0.3s ease;
    position: relative;
}
.entry-card:hover {
    background: rgba(245,237,224,0.09);
    border-color: rgba(196,137,90,0.08);
    padding-left: 34px;
}

.entry-date {
    font-family: 'Caveat', cursive;
    font-size: 0.9rem;
    color: var(--driftwood-light);
    margin-bottom: 4px;
}

.entry-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 400;
    line-height: 1.35;
    color: var(--cream);
    margin-bottom: 8px;
    transition: color 0.3s ease;
}
.entry-card:hover .entry-title {
    color: var(--gold-light);
}

.entry-excerpt {
    font-size: 0.8rem;
    color: var(--driftwood-light);
    line-height: 1.6;
}

.entry-footer {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 12px;
}
.entry-tag {
    display: inline-block;
    font-size: 0.5rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 3px 12px;
    border-radius: 20px;
    color: var(--gold);
    background: rgba(196,137,90,0.06);
    border: 1px solid rgba(196,137,90,0.06);
    font-family: 'Inter', sans-serif;
}
.entry-read {
    font-size: 0.6rem;
    color: var(--driftwood-light);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-family: 'Inter', sans-serif;
}

.entries-empty {
    text-align: center;
    padding: 80px 0;
}
.entries-empty-icon { font-size: 2.4rem; margin-bottom: 12px; opacity: 0.15; }
.entries-empty-text {
    font-family: 'Caveat', cursive;
    font-size: 1.3rem;
    color: var(--driftwood-light);
}

@media (max-width: 768px) {
    .entries-title { font-size: 1.8rem; }
    .entry-card { padding: 22px 20px; }
    .entries-page { padding: 100px 20px 60px; }
}
</style>

<div class="entries-page">
    <div class="entries-header">
        <div class="entries-label">✦ The Logbook</div>
        <h1 class="entries-title">The Logbook</h1>
    </div>

    @if($posts->count() > 0)
        @foreach($posts as $post)
        <a href="{{ route('blog.show', $post->slug) }}" class="entry-card">
            <div class="entry-date">{{ $post->formatted_date }}</div>
            <h2 class="entry-title">{{ $post->title }}</h2>
            @if($post->excerpt)
            <p class="entry-excerpt">{{ $post->excerpt }}</p>
            @endif
            <div class="entry-footer">
                @if($post->category)
                <span class="entry-tag">{{ $post->category }}</span>
                @endif
                <span class="entry-read">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
            </div>
        </a>
        @endforeach

        <div class="pagination" style="margin-top: 48px;">
            {{ $posts->links() }}
        </div>
    @else
        <div class="entries-empty">
            <div class="entries-empty-icon">📭</div>
            <div class="entries-empty-text">No entries yet</div>
        </div>
    @endif
</div>
@endsection
