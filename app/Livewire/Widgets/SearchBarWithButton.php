<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class SearchBarWithButton extends Component
{
    public $searchTerm = '';

    public function mount()
    {
        $this->searchTerm = request()->get('query');
    }

    public function search() {

        $this->validate([
            'searchTerm' => 'required|min:2', // Add validation rules as needed
        ]);

        return $this->redirect('/search?query=' . $this->searchTerm, navigate: true);
    }

    public function render()
    {
        return view('livewire.widgets.search-bar-with-button');
    }
}
