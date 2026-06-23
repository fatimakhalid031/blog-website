@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
<style>
    .signin-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 60px;
    }

    .signin-card {
        width: 100%;
        max-width: 400px;
        background: var(--bg-surface);
        border: 1px solid rgba(196, 137, 90, 0.08);
        border-radius: 20px;
        padding: 48px 40px 44px;
        text-align: center;
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(196, 137, 90, 0.04);
    }

    .signin-icon {
        width: 44px;
        height: 44px;
        margin: 0 auto 20px;
        background: rgba(196, 137, 90, 0.08);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .signin-icon svg {
        width: 22px;
        height: 22px;
        opacity: 0.6;
    }

    .signin-card h1 {
        font-size: 1.5rem;
        color: var(--cream);
        margin-bottom: 6px;
        font-weight: 600;
    }

    .signin-sub {
        font-size: 0.8rem;
        color: var(--driftwood-light);
        margin-bottom: 36px;
        font-weight: 300;
        font-style: italic;
    }

    .signin-card .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .signin-card .form-group label {
        display: block;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--driftwood-light);
        margin-bottom: 6px;
        font-weight: 400;
    }

    .signin-card .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid rgba(200, 180, 160, 0.12);
        background: rgba(20, 28, 32, 0.6);
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        color: var(--cream);
        border-radius: 10px;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    }

    .signin-card .form-control::placeholder {
        color: rgba(160, 144, 128, 0.4);
    }

    .signin-card .form-control:focus {
        outline: none;
        border-color: var(--gold);
        background: rgba(20, 28, 32, 0.8);
        box-shadow: 0 0 0 3px rgba(196, 137, 90, 0.08);
    }

    .signin-card .form-control:-webkit-autofill,
    .signin-card .form-control:-webkit-autofill:hover,
    .signin-card .form-control:-webkit-autofill:focus {
        -webkit-text-fill-color: var(--cream);
        -webkit-box-shadow: 0 0 0px 1000px rgba(20, 28, 32, 0.9) inset;
        border-color: var(--gold);
        transition: background-color 5000s ease-in-out 0s;
    }

    .signin-error {
        font-size: 0.7rem;
        color: #d4836a;
        display: block;
        margin-top: 4px;
        font-weight: 400;
    }

    .signin-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .signin-checkbox input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        border: 1px solid rgba(200, 180, 160, 0.2);
        border-radius: 4px;
        background: rgba(20, 28, 32, 0.6);
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .signin-checkbox input[type="checkbox"]:checked {
        background: var(--gold);
        border-color: var(--gold);
    }

    .signin-checkbox input[type="checkbox"]:checked::after {
        content: '';
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 1.5px 1.5px 0;
        transform: rotate(45deg);
        display: block;
        margin-top: -1px;
    }

    .signin-checkbox label {
        font-size: 0.78rem;
        color: var(--driftwood-light);
        cursor: pointer;
        margin: 0;
        text-transform: none;
        letter-spacing: normal;
        user-select: none;
    }

    .signin-card .btn {
        width: 100%;
        padding: 12px 24px;
        font-size: 0.75rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        background: transparent;
        border: 1px solid var(--gold);
        color: var(--gold);
        border-radius: 10px;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        transition: all 0.25s ease;
    }

    .signin-card .btn:hover {
        background: var(--gold);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(196, 137, 90, 0.25);
    }

    .signin-card .btn:active {
        transform: translateY(0);
    }

    @media (max-width: 480px) {
        .signin-card {
            padding: 36px 24px 32px;
            border-radius: 16px;
        }
    }
</style>

<div class="signin-page">
    <div class="signin-card">
        <div class="signin-icon">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="14" stroke="#c4a882" stroke-width="1.5"/>
                <path d="M10 16 L14 20 L22 12" stroke="#c4a882" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h1>sign in</h1>
        <p class="signin-sub">welcome back, stranger</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ old('email') }}" required autofocus autocomplete="email"
                       placeholder="you@example.com">
                @error('email')
                    <span class="signin-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                       required autocomplete="current-password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                @error('password')
                    <span class="signin-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="signin-checkbox">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">Stay signed in</label>
            </div>

            <button type="submit" class="btn">Sign in</button>
        </form>
    </div>
</div>
@endsection
