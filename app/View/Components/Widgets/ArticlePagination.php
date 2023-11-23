<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticlePagination extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $totalArticles,public $baseUrl)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.article-pagination');
    }
}
