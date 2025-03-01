<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    // public function handle(Request $request, Closure $next, string $role): Response
    // {
    //     // Ensure the user is authenticated and has the required role
    //     if (!$request->user() || $request->user()->role !== $role) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     return $next($request);
    // }
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Unauthorized access.');
    }

}