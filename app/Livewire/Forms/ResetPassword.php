<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Rule('required|email')]
    public $email;

    public function render()
    {
        return view('livewire.forms.reset-password');
    }
}
