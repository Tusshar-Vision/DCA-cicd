<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropDownMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $buttonText,
        public $buttonLink,
        public $archiveLink
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.drop-down-menu');
    }
}
