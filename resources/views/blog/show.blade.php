@extends('layouts.app')

@section('title', $post->title)

@section('content')
<style>
    .diary-single-body p:first-of-type::first-letter {
        font-family: 'DM Serif Display', serif;
        font-size: 3rem;
        float: left;
        line-height: 0.8;
        padding-right: 8px;
        color: var(--gold);
    }
</style>
    <div class="content-section post-page" style="max-width: 780px;">
        <div class="diary-single">
            <div class="diary-single-header">
                @if($post->category)
                    <span class="diary-category" style="margin-bottom: 12px; display: inline-block;">{{ $post->category }}</span>
                @endif
                <div class="diary-single-date">{{ $post->formatted_date }}</div>
                <h1 class="diary-single-title">{{ $post->title }}</h1>
            </div>

            <div class="diary-single-body">
                {!! nl2br(e($post->content)) !!}
            </div>

            <a href="{{ route('entries') }}" class="diary-back">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M10 3L5 7L10 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                back to the logbook
            </a>
        </div>
    </div>
@endsection
