<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class WeeklyFocusArchiveSection extends Component
{
    public int $year;

    public function mount($year) {
        $this->year = $year;
    }
    public function render()
    {
        return view('livewire.widgets.weekly-focus-archive-section');
    }
}
