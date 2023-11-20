<?php

namespace App\View\Components\Navigation;

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

        //Checking if the Initiative is Monthly Magazine

        if ($this->initiativeId === 2) {
            logger("from sidedropdown class", [$this->menuData[1]]);
            foreach ($this->menuData[1] as $key => $value) {
                $dataToRender[] = Carbon::parse($value['published_at'])->monthName;
            }
        }

        if ($this->initiativeId === 3) {
            foreach ($this->menuData as $key => $value) {
                $dataToRender[] = ['title' => $value['title'], 'topic' => $value['topic']['name'], 'slug' => $value['slug']];
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
