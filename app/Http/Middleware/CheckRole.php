<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Admin has access to everything
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Check if user's role is in the allowed roles
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // Not authorized — redirect to their own panel
        return match ($user->role) {
            'manager' => redirect()->route('manager.dashboard'),
            'client'  => redirect('/'),
            default   => redirect()->route('login'),
        };
    }
}
