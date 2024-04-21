<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ValueAddedMaterialOptional extends Component
{
    public $data, $pdfUrl;
    public function mount($data, $pdfUrl): void
    {
        $this->data = collect($data);
        $this->pdfUrl = $pdfUrl;
    }

    public function render(): View
    {
        return view('livewire.widgets.archives.value-added-material-optional');
    }
}
