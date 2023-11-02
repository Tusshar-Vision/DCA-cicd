<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class MonthlyFocus extends Component
{
    public $year;

    public function mount($year) {
        $this->year = $year;
    }
    public function render()
    {
        return view('livewire.widgets.monthly-focus');
    }
}
