<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArticlesSideBar extends Component
{
    public $topics, $articles, $tableOfContent;

    public function mount($topics, $articles, $tableOfContent): void
    {
        $this->topics = $topics;
        $this->articles = $articles;
        $this->tableOfContent = $tableOfContent;
    }

    public function formatString($inputString): string
    {
        // Replace hyphens and similar characters with a space
        $formattedString = str_replace(['-', '_'], ' ', $inputString);

        // Convert "and" symbols (&) back to "&", if they were converted to "and"
        $formattedString = str_replace(' and ', ' & ', $formattedString);

        // Capitalize the first letter of each word
        return ucwords($formattedString);
    }

    public function render(): View
    {
        return view('livewire.widgets.articles-side-bar');
    }
}
