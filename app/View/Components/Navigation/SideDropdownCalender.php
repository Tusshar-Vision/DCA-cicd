<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideDropdownCalender extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $menuData, public $initiativeId
    )
    {}

    public function getDataToRender() : array {
        //Checking if the Initiative is Monthly Magazine

        return range(1, $this->menuData);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.side-dropdown-calender');
    }
}
