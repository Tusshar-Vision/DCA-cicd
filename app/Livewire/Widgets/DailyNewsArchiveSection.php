<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class DailyNewsArchiveSection extends Component
{
    public $articles;

    public function mount($articles)
    {
        $this->articles = $articles;
    }

    public function render()
    {
        return view('livewire.widgets.daily-news-archive-section');
    }
}
