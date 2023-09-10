<?php

namespace App\Providers;

use App\Models\Initiative;
use App\Models\PublishedInitiative;
use Illuminate\Support\Facades\Schema;
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
        if(Schema::hasTable('initiatives')) {
            $initiatives = Initiative::get(['id', 'name', 'path']);
            $publishedInitiatives = PublishedInitiative::get(['initiative_id', 'published_at']);

            view()->share([
                'initiatives' => $initiatives,
                'publishedInitiatives' => $publishedInitiatives
            ]);
        }
    }
}
