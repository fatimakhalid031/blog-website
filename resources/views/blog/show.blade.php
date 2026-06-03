@extends('layouts.app')

@section('title', $post->title)

@section('content')
    @if($post->featured_image)
        <div class="banner-wrap">
            <img
                src="{{ $post->featured_image }}"
                alt="{{ $post->title }}"
                class="banner banner-sm"
                loading="eager"
            >
        </div>
    @endif

    <article>
        <header class="post-header">
            <div class="post-meta">{{ $post->formatted_date }}</div>
            <h1 class="post-title">{{ $post->title }}</h1>
            @if($post->category)
                <span class="post-category">{{ $post->category }}</span>
            @endif
        </header>

        <div class="post-body">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div style="margin-top: 60px; padding-top: 24px; border-top: 1px solid rgba(0,0,0,0.06);">
            <a href="{{ route('home') }}" style="font-size: 0.8rem; color: #888;">← back to entries</a>
        </div>
    </article>
@endsection
