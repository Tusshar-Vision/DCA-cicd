<?php

namespace App\Livewire\Widgets;

use App\Services\ArticleService;
use Livewire\Component;

class NewsSection extends Component
{
    public $latestNewsArticles;
    public function mount($latestNewsArticles): void
    {
        $this->latestNewsArticles = $latestNewsArticles;
    }

    public function getData(ArticleService $articleService): void
    {
        $this->latestNewsArticles = $articleService->getLatestNews(2);
    }
    public function render()
    {
        return view('livewire.widgets.news-section');
    }
}
