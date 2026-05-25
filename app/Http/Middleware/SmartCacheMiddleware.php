<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SmartCacheMiddleware
{
    public function handle(Request $request, Closure $next, $ttl = 60)
    {
        
        if ($request->is('cache-dashboard') || $request->is('clear*')) {
            return $next($request);
        }

        if ($request->is('admin/*')) {
            return $next($request);
        }

        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        $key = 'route_cache_' . Str::slug($request->fullUrl());

        if ($request->has('refresh_cache') && $request->refresh_cache === 'true') {
            Cache::forget($key);
        }

        if (Cache::has($key)) {
            Cache::increment('cache_hits_count');
            return response(Cache::get($key))->header('X-Cache', 'HIT');
        }

        $response = $next($request);

        if ($response->isSuccessful()) {
            Cache::put($key, $response->getContent(), now()->addMinutes($ttl));
            Cache::increment('cache_misses_count');
        }

        return $response->header('X-Cache', 'MISS');
    }
}