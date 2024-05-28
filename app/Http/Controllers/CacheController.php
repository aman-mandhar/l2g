<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function clearConfigCache()
    {
        Artisan::call('config:cache');
        return 'Config cache cleared';
    }

    public function clearRouteCache()
    {
        Artisan::call('route:cache');
        return 'Route cache cleared';
    }

    public function clearViewCache()
    {
        Artisan::call('view:cache');
        return 'View cache cleared';
    }

    public function clearAppCache()
    {
        Artisan::call('cache:clear');
        return 'Application cache cleared';
    }

    public function clearAllCaches()
    {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        Artisan::call('cache:clear');
        return 'All caches cleared';
    }
}

