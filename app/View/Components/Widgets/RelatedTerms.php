<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RelatedTerms extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $relatedTerms
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.related-terms');
    }
}
