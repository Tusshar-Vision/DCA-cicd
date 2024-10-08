<?php

namespace App\View\Components\Navigation;

use App\Traits\StringFormatting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topics extends Component
{
    use StringFormatting;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $topics,
        public $publishedDate
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.topics');
    }
}
