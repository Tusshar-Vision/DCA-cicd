<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SearchBox extends Component
{
    public $searchTerm = '';

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount(): void
    {
        $this->searchTerm = request()->get('query');
    }

    public function search()
    {
        $this->validate([
            'searchTerm' => 'required|min:2', // Add validation rules as needed
        ]);

        return $this->redirect('/search?query=' . $this->searchTerm, navigate: true);
    }

    public function render(): View
    {
        return view('livewire.widgets.search-box');
    }
}
