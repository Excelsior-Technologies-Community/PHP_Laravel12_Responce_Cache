<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class CacheController extends Controller
{
    public function index()
    {
        $cachePath = storage_path('framework/cache/data');

        $cacheFiles = File::exists($cachePath)
            ? count(File::allFiles($cachePath))
            : 0;

        $stats = [
            'hits' => Cache::get('cache_hits_count', 0),
            'misses' => Cache::get('cache_misses_count', 0),
        ];

        return view('cache-dashboard', [
            'cacheFiles' => $cacheFiles,
            'laravel' => app()->version(),
            'php' => phpversion(),
            'stats' => $stats,
        ]);
    }

    public function clear()
    {
        Artisan::call('responsecache:clear');
        Cache::flush();
        
        
        Cache::put('cache_hits_count', 0);
        Cache::put('cache_misses_count', 0);

        return redirect('/cache-dashboard')
            ->with('success', 'Cache cleared successfully!');
    }
}