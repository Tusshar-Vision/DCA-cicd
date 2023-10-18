<?php

namespace App\Providers;

use App\Models\Initiative;
use App\Services\InitiativeService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class InitiativeServiceProvider extends ServiceProvider
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
     * @throws \Throwable
     */
    public function boot(InitiativeService $initiativeService): void
    {
        if(Schema::hasTable('initiatives')) {
            $initiatives = Initiative::get(['id', 'name', 'path']);

            view()->share([
                'initiatives' => $initiatives,
                'menuData' => [
                    'newsToday' => $initiativeService->getMenuData('NEWS_TODAY'),
                    'monthlyMagazine' => $initiativeService->getMenuData('MONTHLY_MAGAZINE'),
                    'weeklyFocus' => $initiativeService->getMenuData('WEEKLY_FOCUS'),
                ]
            ]);
        }
    }
}
