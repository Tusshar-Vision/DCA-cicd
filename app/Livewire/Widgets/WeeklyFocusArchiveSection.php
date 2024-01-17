<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class WeeklyFocusArchiveSection extends Component
{
    public $data;

    public function mount($data)
    {
        $this->data = $data;
    }
    public function render()
    {
        return view('livewire.widgets.weekly-focus-archive-section');
    }
}
