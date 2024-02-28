<?php

namespace App\View\Components\Navigation;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $menuData,
        public $initiativeId
    ) {
    }

    public function getDataToRender(): array
    {
        $dataToRender = [];

        if ($this->initiativeId === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
            foreach ($this->menuData as $key => $initiative) {
                $dataToRender[] = [
                    'date' => Carbon::parse($initiative->publishedAt)->format('Y-m-d'),
                    'name' => $initiative->name,
                    'title' => $initiative->article->first()->title,
                    'topic' => $initiative->article->first()->topic,
                    'slug' => $initiative->article->first()->slug
                ];
            }
        }

        if ($this->initiativeId === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)) {
            foreach ($this->menuData[1] as $key => $initiative) {
                $dataToRender[] = [
                    'date' => Carbon::parse($initiative->publishedAt)->format('Y-m-d'),
                    'title' => Carbon::parse($initiative->publishedAt)->monthName,
                    'topic' => $initiative->article->first()->topic,
                    'slug' => $initiative->article->first()->slug
                ];
            }
        }
        return $dataToRender;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.side-dropdown');
    }
}
