<?php

namespace App\View\Components\Widgets;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticlePagination extends Component
{
    public ?string $nextArticleIndex = null;
    public ?string $previousArticleIndex = null;
    public string $shortArticlesHeading = 'News In Shorts';
    /**
     * Create a new component instance.
     */
    public function __construct(public $currentInitiative, string $currentArticleSlug)
    {
        if ($this->currentInitiative->initiative_id !== InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
            if ($this->currentInitiative->articles->count() === 1) {

                $this->nextArticleIndex = null;
                $this->previousArticleIndex = null;

            } else {

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
        }

        if ($this->currentInitiative->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)) {
            $this->shortArticlesHeading = 'Also In News';
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
