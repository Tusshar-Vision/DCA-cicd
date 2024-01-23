<?php

namespace App\Livewire\Forms;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Rule('required|email')]
    public $email;

    public $success;

    public function render(): View
    {
        return view('livewire.forms.reset-password');
    }
}
