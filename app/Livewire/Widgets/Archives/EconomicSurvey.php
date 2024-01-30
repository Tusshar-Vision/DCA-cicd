<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class EconomicSurvey extends Component
{

    public $data;
    public function mount($data): void
    {
        $this->data = collect($data);
    }

    public function render(): View
    {
        return view('livewire.widgets.archives.economic-survey');
    }
}
