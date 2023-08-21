<?php

namespace App\Providers;

use App\Models\Initiative;
use Illuminate\Support\ServiceProvider;

class GlobalInitiativesDataProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $initiatives = Initiative::get(['id', 'name', 'path']);

        view()->share('initiatives', $initiatives);
    }
}
