<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchBox extends Component
{
    public $query = '';

    public function search(): void
    {
        $this->validate([
            'query' => 'required|min:2', // Add validation rules as needed
        ]);

        $url = route('search', ['query' => $this->query], true);

        if (config('app.env') === 'production') {
            $url = str_replace('/search', config('app.prefix_url') . '/search', $url);
        }

        $this->redirect($url, navigate: false);
    }

    public function render(): View
    {
        return view('livewire.widgets.search-box');
    }
}
