<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PdfViewer extends Component
{
    public $infographic;

    public function mount($infographic): void {
        $this->infographic = $infographic;
    }

    public function render(): View
    {
        return view('livewire.widgets.pdf-viewer');
    }
}
