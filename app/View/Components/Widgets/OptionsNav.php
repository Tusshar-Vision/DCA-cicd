<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OptionsNav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $articleId,
        public $publishedAt,
        public $isArticleBookmarked,
        public $isArticleRead
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.options-nav');
    }
}
