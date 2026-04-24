<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class CacheController extends Controller
{
    public function index()
    {
        // cache directory path
        $cachePath = storage_path('framework/cache/data');

        // count cache files
        $cacheFiles = File::exists($cachePath)
            ? count(File::allFiles($cachePath))
            : 0;

        return view('cache-dashboard', [
            'cacheFiles' => $cacheFiles,
            'laravel' => app()->version(),
            'php' => phpversion(),
        ]);
    }

    public function clear()
    {
        Artisan::call('responsecache:clear');

        return redirect('/cache-dashboard')
            ->with('success', 'Cache cleared successfully!');
    }
}