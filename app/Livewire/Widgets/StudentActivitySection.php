<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class StudentActivitySection extends Component
{

    public $readHistories;

    public function mount($readHistories)
    {
        $this->readHistories = $readHistories;
    }

    public function render()
    {
        return view('livewire.widgets.student-activity-section');
    }
}
