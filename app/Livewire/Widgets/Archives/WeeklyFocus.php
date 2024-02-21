<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class WeeklyFocus extends Component
{
    public $data, $years;

    public function mount($data, $years): void
    {
        $this->data = $data;
        $this->years = $years;
    }
    public function render(): View
    {
        return view('livewire.widgets.archives.weekly-focus');
    }
}
