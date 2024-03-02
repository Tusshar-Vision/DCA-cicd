<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleSideBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $tableOfContent;
    public $isAlsoInNews;
    public function __construct(
        $tableOfContent,
        $isAlsoInNews = null
    ) {
        $this->tableOfContent = $tableOfContent;
        $this->isAlsoInNews = $isAlsoInNews;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.article-side-bar');
    }
}
