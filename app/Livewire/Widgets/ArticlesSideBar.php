<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class ArticlesSideBar extends Component
{
    public $topics, $articles, $tableOfContent;

    public function mount($topics, $articles, $tableOfContent)
    {
        $this->topics = $topics;
        $this->articles = $articles;
        $this->tableOfContent = $tableOfContent;
    }

    public function render()
    {
        return view('livewire.widgets.articles-side-bar');
    }
}
