<?php

namespace App\Livewire\Widgets;

use App\Traits\StringFormatting;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArticlesSideBar extends Component
{
    use StringFormatting;

    public $topics, $articles, $tableOfContent;

    public function mount($topics, $articles, $tableOfContent): void
    {
        $this->topics = $topics;
        $this->articles = $articles;
        $this->tableOfContent = $tableOfContent;
    }

    public function render(): View
    {
        return view('livewire.widgets.articles-side-bar');
    }
}
