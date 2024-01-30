<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DailyNews extends Component
{
    public $articles;

    public function mount($articles): void
    {
        $this->articles = $articles;
    }

    public function render(): View
    {
        return view('livewire.widgets.archives.daily-news');
    }
}
