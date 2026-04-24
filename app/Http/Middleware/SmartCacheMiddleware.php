<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SmartCacheMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ❌ Skip caching for admin routes
        if ($request->is('admin/*')) {
            return $next($request);
        }

        // ❌ Skip caching for logged-in admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // ❌ Skip non-GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        return $next($request);
    }
}