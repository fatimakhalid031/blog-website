@extends('layouts.app')

@section('title', 'Meet the Blogger')

@section('content')
    <div class="content-section" style="max-width: 600px;">
        <div class="blogger-page">
            <div class="blogger-page-avatar">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300&q=80&auto=format" alt="Fatima" loading="lazy">
            </div>
            <h1 class="blogger-page-name">Fatima</h1>
            <p class="blogger-page-tagline">writing into the void</p>
            <div class="blogger-page-bio">
                <p>A quiet observer documenting the beautiful mess of being human.</p>
                <p>Words, wanderings, and half-baked thoughts. This dock is where they all rest — the failed attempts, the abandoned ideas, the lessons learned along the way.</p>
            </div>

            <div class="blogger-page-divider"></div>

            <h3 class="blogger-page-failures-title">Failure's Dock</h3>
            <div class="blogger-failure-list">
                <div class="blogger-failure-item">
                    <span class="bf-dot"></span>
                    <div>
                        <div class="bf-title">tried to learn guitar</div>
                        <div class="bf-date">May 2026</div>
                    </div>
                </div>
                <div class="blogger-failure-item">
                    <span class="bf-dot"></span>
                    <div>
                        <div class="bf-title">started a newsletter (RIP)</div>
                        <div class="bf-date">March 2026</div>
                    </div>
                </div>
                <div class="blogger-failure-item">
                    <span class="bf-dot"></span>
                    <div>
                        <div class="bf-title">5am mornings — day 1</div>
                        <div class="bf-date">January 2026</div>
                    </div>
                </div>
                <div class="blogger-failure-item">
                    <span class="bf-dot"></span>
                    <div>
                        <div class="bf-title">that sourdough starter</div>
                        <div class="bf-date">December 2025</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
