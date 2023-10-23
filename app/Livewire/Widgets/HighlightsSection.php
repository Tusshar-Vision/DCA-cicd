<?php

namespace App\Livewire\Widgets;

use App\Services\ArticleService;
use Livewire\Component;

class HighlightsSection extends Component
{
    public $featuredArticles;
    public function mount($featuredArticles): void
    {
        $this->featuredArticles = $featuredArticles;
    }

    public function getData(ArticleService $articleService): void
    {
        $this->featuredArticles = $articleService->getFeatured();
    }
    public function render()
    {
        return view('livewire.widgets.highlights-section');
    }
}
