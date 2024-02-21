<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class Filter extends Component
{

    public $data;

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.widgets.filter');
    }
}
