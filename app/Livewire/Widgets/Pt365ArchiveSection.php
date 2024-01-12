<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class Pt365ArchiveSection extends Component
{

    public $data;
    public function mount($data): void
    {
        $this->data = collect($data);
        logger("asdfjsldfjs");
    }

    public function render()
    {
        return view('livewire.widgets.pt-365-archive-section');
    }
}
