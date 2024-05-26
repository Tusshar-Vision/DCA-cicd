<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class WeeklyFocus extends Component
{
    public $data, $years, $pdfUrl;

    public function mount($data, $years, $pdfUrl): void
    {
        $this->data = $data;
        $this->years = $years;
        $this->pdfUrl = $pdfUrl;
    }
    public function render(): View
    {
        return view('livewire.widgets.archives.weekly-focus');
    }
}
