<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DailyNews extends Component
{
    public $articles, $years;

    public function mount($articles, $years): void
    {
        $this->articles = $articles;
        $this->years = $years;
    }

    public function render(): View
    {
        return view('livewire.widgets.archives.daily-news');
    }
}
