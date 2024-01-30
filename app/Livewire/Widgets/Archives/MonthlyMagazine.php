<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class MonthlyMagazine extends Component
{
    public $articles;

    public function mount($articles): void
    {
        $this->articles = json_decode($articles, true);
        // $this->articles = $articles;
    }
    public function render(): View
    {
        return view('livewire.widgets.archives.monthly-magazine');
    }
}
