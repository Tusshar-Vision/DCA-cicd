<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MoreDropDown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $menuData
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.more-drop-down');
    }
}
