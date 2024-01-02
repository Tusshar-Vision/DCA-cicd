<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class StudentActivitySection extends Component
{

    public $readHistories;
    public $montlyMagazineConsumption;
    public $weeklyFocusConsumption;
    public $newsTodayConsumption;

    public function mount($readHistories, $montlyMagazineConsumption, $weeklyFocusConsumption, $newsTodayConsumption)
    {
        $this->readHistories = $readHistories;
        $this->montlyMagazineConsumption = $montlyMagazineConsumption;
        $this->weeklyFocusConsumption = $weeklyFocusConsumption;
        $this->newsTodayConsumption = $newsTodayConsumption;
    }

    public function render()
    {
        return view('livewire.widgets.student-activity-section');
    }
}
