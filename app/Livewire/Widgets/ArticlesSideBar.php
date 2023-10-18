<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class ArticlesSideBar extends Component
{
    public $topics, $articles;

    public function mount($topics, $articles)
    {
        $this->topics = $topics;
        $this->articles = $articles;
    }

    public function render()
    {
        return view('livewire.widgets.articles-side-bar');
    }
}
