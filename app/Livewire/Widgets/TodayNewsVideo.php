<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TodayNewsVideo extends Component
{
    public $videoUrl;

    public function mount($videoUrl): void
    {
        $this->videoUrl = $videoUrl;
    }

    public function render(): View
    {
        return view('livewire.widgets.today-news-video');
    }
}
