<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class EditNote extends Component
{
    public $articleId;

    public function mount($articleId)
    {
        $this->articleId = $articleId;
    }

    public function render()
    {
        return view('livewire.widgets.edit-note');
    }
}
