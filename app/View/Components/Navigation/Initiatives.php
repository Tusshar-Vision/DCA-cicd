<?php

namespace App\View\Components\Navigation;

use App\Models\Initiative;
use App\Services\InitiativeService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Component;

class Initiatives extends Component
{
    public $initiatives;

    /**
     * Create a new component instance.
     * @throws \Throwable
     */
    public function __construct(InitiativeService $initiativeService)
    {
        if (Schema::hasTable('initiatives')) {

            $this->initiatives = Initiative::orderBy('order_column')->get(['id', 'name', 'name_hindi', 'path']);
            $newsTodayData = $initiativeService->getMenuData(\App\Enums\Initiatives::NEWS_TODAY);
            $weeklyFocusData = $initiativeService->getMenuData(\App\Enums\Initiatives::WEEKLY_FOCUS);
            $monthlyMagazineData = $initiativeService->getMenuData(\App\Enums\Initiatives::MONTHLY_MAGAZINE);
            $moreData = $initiativeService->getMenuData(\App\Enums\Initiatives::MORE);

            view()->share([
                'initiatives' => $this->initiatives,
                'menuData' => [
                    'newsToday' => $newsTodayData,
                    'monthlyMagazine' => $monthlyMagazineData,
                    'weeklyFocus' => $weeklyFocusData,
                    'more' => $moreData
                ]
            ]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.initiatives');
    }
}
