<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class StudentActivitySection extends Component
{

    public $readHistories;
    public $montlyMagazineConsumption;

    public function mount($readHistories, $montlyMagazineConsumption)
    {
        $this->readHistories = $readHistories;
        $this->montlyMagazineConsumption = $montlyMagazineConsumption;
    }

    public function render()
    {
        return view('livewire.widgets.student-activity-section');
    }
}
