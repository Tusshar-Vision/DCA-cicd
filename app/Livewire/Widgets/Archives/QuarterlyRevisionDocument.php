<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuarterlyRevisionDocument extends Component
{
    public $data, $years, $pdfUrl;
    public function mount($data, $years, $pdfUrl): void
    {
        $this->data = collect($data);
        $this->years = $years;
        $this->pdfUrl = $pdfUrl;
    }

    public function render(): View
    {
        return view('livewire.widgets.archives.quarterly-revision-document');
    }
}
