<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule('required|email')]
    public $email;

    public function render()
    {
        return view('livewire.forms.register');
    }
}
