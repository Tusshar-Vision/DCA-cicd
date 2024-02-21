<?php

namespace App\Livewire\Widgets\Archives;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuarterlyRevisionDocument extends Component
{
    public $data, $years;
    public function mount($data, $years): void
    {
        $this->data = collect($data);
        $this->years = $years;
    }

    public function render(): View
    {
        return view('livewire.widgets.archives.quarterly-revision-document');
    }
}
