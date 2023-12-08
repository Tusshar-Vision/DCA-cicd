<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class AddNote extends Component
{
    public $article;
    public $note;

    public function mount($article, $note)
    {
        $this->article = $article;
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.widgets.add-note');
    }
}
