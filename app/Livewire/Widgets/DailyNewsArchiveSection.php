<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class DailyNewsArchiveSection extends Component
{
    public int $year;

    public function mount($year) {
        $this->year = $year;
    }

    public function render()
    {
        return view('livewire.widgets.daily-news-archive-section');
    }
}
