<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class MonthlyMagazineArchiveSection extends Component
{
    public $articles;

    public function mount($articles)
    {
        $this->articles = json_decode($articles, true);
        // $this->articles = $articles;
    }
    public function render()
    {
        return view('livewire.widgets.monthly-magazine-archive-section');
    }
}
