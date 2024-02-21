<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class MonthlyMagazine extends Component
{
    public $articles, $years;

    public function mount($articles, $years): void
    {
        $this->articles = json_decode($articles, true);
        $this->years = $years;
    }
    public function render(): View
    {
        return view('livewire.widgets.archives.monthly-magazine');
    }
}
