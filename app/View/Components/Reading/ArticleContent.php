<?php

namespace App\View\Components\Reading;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleContent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $article, public $publishedAt)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reading.article-content');
    }
}
