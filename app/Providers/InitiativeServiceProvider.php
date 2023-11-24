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
        if (Schema::hasTable('initiatives')) {

            $initiatives = Initiative::get(['id', 'name', 'path']);
            $newsTodayData = $initiativeService->getMenuData('NEWS_TODAY');
            $monthlyMagazineData = $initiativeService->getMenuData('MONTHLY_MAGAZINE');
            $weeklyFocusData = $initiativeService->getMenuData('WEEKLY_FOCUS');

//            dd([$newsTodayData, $monthlyMagazineData, $weeklyFocusData]);

            view()->share([
                'initiatives' => $initiatives,
                'menuData' => [
                    'newsToday' => $newsTodayData,
                    'monthlyMagazine' => $monthlyMagazineData,
                    'weeklyFocus' => $weeklyFocusData,
                ]
            ]);
        }
    }
}
