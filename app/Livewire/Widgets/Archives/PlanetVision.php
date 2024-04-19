<?php

namespace App\Livewire\Widgets\Archives;

use Livewire\Component;

class PlanetVision extends Component
{
    public $data, $years;
    public function mount($data, $years): void
    {
        $this->data = collect($data);
        $this->years = $years;
    }

    public function render()
    {
        return view('livewire.widgets.archives.planet-vision');
    }
}
