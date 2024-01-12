<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class Mains365ArchiveSection extends Component
{

    public $data;
    public function mount($data): void
    {
        $this->data = collect($data);
    }

    public function render()
    {
        return view('livewire.widgets.mains-365-archive-section');
    }
}
