<?php

namespace App\Providers;

use App\Enums\Initiatives;
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

            $initiatives = Initiative::orderBy('order_column')->get(['id', 'name', 'name_hindi', 'path']);
            $newsTodayData = $initiativeService->getMenuData(Initiatives::NEWS_TODAY);
            $monthlyMagazineData = $initiativeService->getMenuData(Initiatives::MONTHLY_MAGAZINE);
            $weeklyFocusData = $initiativeService->getMenuData(Initiatives::WEEKLY_FOCUS);
            $moreData = $initiativeService->getMenuData(Initiatives::MORE);

            view()->share([
                'initiatives' => $initiatives,
                'menuData' => [
                    'newsToday' => $newsTodayData,
                    'monthlyMagazine' => $monthlyMagazineData,
                    'weeklyFocus' => $weeklyFocusData,
                    'more' => $moreData
                ]
            ]);
        }
    }
}
