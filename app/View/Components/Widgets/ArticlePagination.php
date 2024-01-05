<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticlePagination extends Component
{
    public ?string $nextArticleIndex = null;
    public ?string $previousArticleIndex = null;
    /**
     * Create a new component instance.
     */
    public function __construct(public $currentInitiative, string $currentArticleSlug)
    {
        $currentArticleIndex = $this->currentInitiative->getArticleIndexFromSlug($currentArticleSlug);

        if ($currentArticleIndex === 0) {
            $this->nextArticleIndex = $currentArticleIndex + 1;
        }

        if ($currentArticleIndex > 0 && $currentArticleIndex < $this->currentInitiative->articles->count() - 1) {
            $this->previousArticleIndex = $currentArticleIndex - 1;
            $this->nextArticleIndex = $currentArticleIndex + 1;
        }

        if ($currentArticleIndex === $this->currentInitiative->articles->count() - 1) {
            $this->previousArticleIndex = $currentArticleIndex - 1;
            $this->nextArticleIndex = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.article-pagination');
    }
}
