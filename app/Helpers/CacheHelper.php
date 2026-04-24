<?php

namespace App\Helpers;

class CacheHelper
{
    public static function ttl($request)
    {
        if ($request->is('api/*')) {
            return 60; // 1 min
        }

        if ($request->is('products/*')) {
            return 300; // 5 min
        }

        return 600; // default 10 min
    }
}