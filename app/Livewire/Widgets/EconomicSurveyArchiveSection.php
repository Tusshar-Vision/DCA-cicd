<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class EconomicSurveyArchiveSection extends Component
{

    public $data;
    public function mount($data): void
    {
        $this->data = collect($data);
        logger("asdfjsldfjs");
    }

    public function render()
    {
        return view('livewire.widgets.economic-survey-archive-section');
    }
}
