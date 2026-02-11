<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'message' => 'This response is cached!',
        'time' => now()->toDateTimeString(),
    ]);
});

