<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CacheLogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $time = round((microtime(true) - $start) * 1000, 2);

        Log::info('CACHE TRACK', [
            'url' => $request->fullUrl(),
            'time_ms' => $time,
            'cached' => 'handled by response cache',
        ]);

        return $response;
    }
}