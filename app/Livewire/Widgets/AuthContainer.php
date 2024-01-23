<?php

namespace App\Livewire\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
class AuthContainer extends Component
{
    public $component = 'forms.login';

    #[On('renderComponent')]
    public function renderComponent(string $component): void {
        $this->component = $component;
    }

    public function render(): View
    {
        return view('livewire.widgets.auth-container');
    }
}
