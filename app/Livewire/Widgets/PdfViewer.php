<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PdfViewer extends Component
{
    public $pdf;

    public function mount($pdf): void {
        $this->pdf = $pdf;
//        dd($pdf->getMedia('infographic'));
    }

    public function render(): View
    {
        return view('livewire.widgets.pdf-viewer');
    }
}