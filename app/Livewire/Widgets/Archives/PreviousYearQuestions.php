<?php

namespace App\Livewire\Widgets\Archives;

use Livewire\Component;

class PreviousYearQuestions extends Component
{
    public $data, $years, $pdfUrl;
    public function mount($data, $years, $pdfUrl): void
    {
        $this->data = collect($data);
        $this->years = $years;
        $this->pdfUrl = $pdfUrl;
    }

    public function render()
    {
        return view('livewire.widgets.archives.previous-year-questions');
    }
}
