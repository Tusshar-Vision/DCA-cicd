<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SearchBarWithButton extends Component
{
    public $query = '';

    public function search(): null
    {

        $this->validate([
            'query' => 'required|min:2', // Add validation rules as needed
        ]);

        return $this->redirectRoute('search', ['query' => $this->query]);
    }

    public function render(): View
    {
        return view('livewire.widgets.search-bar-with-button');
    }
}
