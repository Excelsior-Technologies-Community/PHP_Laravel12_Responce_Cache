<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CacheController;

Route::get('/', function () {
    return response()->json([
        'message' => 'This response is cached!',
        'time' => now()->toDateTimeString(),
    ]);
});

Route::get('/cache-dashboard', [CacheController::class, 'index']);
Route::get('/cache-clear', [CacheController::class, 'clear']);
