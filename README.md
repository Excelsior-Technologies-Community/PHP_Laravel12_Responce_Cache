# PHP_Laravel12_Responce_Cache

## Introduction

PHP_Laravel12_Responce_Cache is a Laravel 12 demonstration project that implements HTTP response caching using the Spatie Laravel ResponseCache package.
It shows how cached responses reduce database load, improve application performance, and deliver faster results for both web and API requests, making it useful for performance optimization learning, interviews, and portfolio projects.

## Project Overview

This project demonstrates how to implement **Response Caching in Laravel12** using the **Spatie Laravel ResponseCache** package with proper middleware configuration in the Laravel 12 application structure.  

Response caching helps: 

- Improve application performance
- Reduce unnecessary database queries 
- Serve faster responses to users 
- Handle high traffic efficiently
- Optimize API and web routes


------------------------------------------------------------------------

## Step 1 --- Create Laravel 12 Project

``` bash
composer create-project laravel/laravel PHP_Laravel12_Responce_Cache "12.*"
cd PHP_Laravel12_Responce_Cache
```

Check Laravel version:

``` bash
php artisan --version
```

------------------------------------------------------------------------

## Step 2 --- Install Spatie Response Cache Package

``` bash
composer require spatie/laravel-responsecache
```

Publish config:

``` bash
php artisan vendor:publish --provider="Spatie\ResponseCache\ResponseCacheServiceProvider"
```

This creates:

```
config/responsecache.php
```

------------------------------------------------------------------------

## Step 3 --- Configure Cache Driver

Open `.env` and set:

``` env
CACHE_DRIVER=file
```

------------------------------------------------------------------------

## Step 4 --- Middleware Registration

Open:

    bootstrap/app.php

Open bootstrap/app.php and modify like this:

``` php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\ResponseCache\Middlewares\CacheResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Apply Response Cache middleware to all web routes
        $middleware->web(append: [
            CacheResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
```

- Now response caching is enabled for web routes.

------------------------------------------------------------------------

## Step 5 --- Create Test Route

Open:

    routes/web.php

``` php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'This response is cached!',
        'time' => now()->toDateTimeString(),
    ]);
});
```

------------------------------------------------------------------------

## Step 6 --- Clear Cache Command

``` bash
php artisan responsecache:clear
```

------------------------------------------------------------------------

## Step 7 --- Test Response Cache

Run server:

``` bash
php artisan serve
```

Open in browser multiple times:

    http://127.0.0.1:8000

You will notice **time does not change**, meaning response is cached.

------------------------------------------------------------------------

## Output

### Before Cache Cleared

<img width="1780" height="1087" alt="Screenshot 2026-02-11 105427" src="https://github.com/user-attachments/assets/b41b8919-b5ea-4fd0-9c3e-b893d31a2eef" />

### Response Cache Cleared

<img width="1414" height="196" alt="Screenshot 2026-02-11 105505" src="https://github.com/user-attachments/assets/24ec40c2-d993-4b99-91bb-97d7758903a9" />

### After Cache Cleared

<img width="1786" height="1087" alt="Screenshot 2026-02-11 105527" src="https://github.com/user-attachments/assets/dc3a711f-8d86-429d-b92a-90ae30df659f" />


------------------------------------------------------------------------

## Project Folder Structure

```
PHP_Laravel12_Responce_Cache
│
├── app/
├── bootstrap/
│   └── app.php   ← Middleware registered here (Laravel 12)
├── config/
│   └── responsecache.php
├── public/
├── resources/
├── routes/
│   └── web.php
├── storage/
├── tests/
├── .env
└── composer.json
```

------------------------------------------------------------------------

## How Response Cache Works

1.  First request → Laravel processes normally.
2.  Package stores full HTTP response in cache.
3.  Next requests → Served directly from cache.
4.  Improves speed drastically.


------------------------------------------------------------------------

## Conclusion

You successfully created a **Laravel 12 Response Cache Project** using
**Spatie ResponseCache** with:

-   Proper installation
-   Middleware setup
-   Testing route
-   Cache clearing
-   Folder structure explanation





