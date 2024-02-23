<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBarDownloadMenu extends Component
{
    /**
     * Create a new component instance.
     */


    public function __construct(
        public $initiative = null,
        public $videoUrl = "",
        public $media = ""
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.side-bar-download-menu');
    }
}
