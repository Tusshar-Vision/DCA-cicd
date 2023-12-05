<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class AddNote extends Component
{
    public $article;

    public function mount($article)
    {
        $this->article = $article;
    }

    public function render()
    {
        return view('livewire.widgets.add-note');
    }
}
