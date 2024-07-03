<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PdfViewer extends Component
{
    public $pdf, $initiative;

    public function mount($pdf, $initiative): void {
        $this->pdf = $pdf;
        $this->initiative = $initiative;
    }

    public function render(): View
    {
        return view('livewire.widgets.pdf-viewer');
    }
}
