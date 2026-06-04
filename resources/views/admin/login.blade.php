@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
    <div style="max-width: 400px; margin: 80px auto; text-align: center;">
        <div style="margin-bottom: 20px;">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.4;">
                <circle cx="16" cy="16" r="14" stroke="%23c4a882" stroke-width="1.5"/>
                <path d="M10 16 L14 20 L22 12" stroke="%23c4a882" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h1 style="font-size: 1.6rem; margin-bottom: 8px;">sign in</h1>
        <p style="font-size: 0.8rem; color: #888; margin-bottom: 40px; font-weight: 300;">
            welcome back, stranger
        </p>

        <form action="{{ route('login') }}" method="POST" style="text-align: left;">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="email">
                @error('email')
                    <span style="font-size: 0.75rem; color: #c65d47; display: block; margin-top: 4px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
                @error('password')
                    <span style="font-size: 0.75rem; color: #c65d47; display: block; margin-top: 4px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember" style="margin: 0; text-transform: none; letter-spacing: normal; color: #1a1a1a; font-size: 0.8rem;">Stay signed in</label>
            </div>

            <button type="submit" class="btn" style="width: 100%; margin-top: 8px;">Sign in</button>
        </form>
    </div>
@endsection
