<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class MonthlyMagazine extends Component
{
    public $articles, $years, $pdfUrl;

    public function mount($articles, $years, $pdfUrl): void
    {
        $this->articles = $articles;
        $this->years = $years;
        $this->pdfUrl = $pdfUrl;
    }
    public function render(): View
    {
        return view('livewire.widgets.archives.monthly-magazine');
    }
}
