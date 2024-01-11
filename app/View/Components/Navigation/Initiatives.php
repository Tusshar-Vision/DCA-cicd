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
    private $initiatives;
    private $weeklyFocusData, $monthlyMagazineData, $moreData;

    /**
     * Create a new component instance.
     * @throws \Throwable
     */
    public function __construct(InitiativeService $initiativeService)
    {
        if (Schema::hasTable('initiatives')) {

            $this->initiatives = Initiative::orderBy('order_column')->get(['id', 'name', 'name_hindi', 'path']);
            $this->weeklyFocusData = $initiativeService->getMenuData(\App\Enums\Initiatives::WEEKLY_FOCUS);
            $this->monthlyMagazineData = $initiativeService->getMenuData(\App\Enums\Initiatives::MONTHLY_MAGAZINE);
            $this->moreData = $initiativeService->getMenuData(\App\Enums\Initiatives::MORE);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.initiatives')->with([
            'initiatives' => $this->initiatives,
            'menuData' => [
                'monthlyMagazine' => $this->monthlyMagazineData,
                'weeklyFocus' => $this->weeklyFocusData,
                'more' => $this->moreData,
            ]
        ]);
    }
}
