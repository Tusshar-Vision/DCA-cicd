<?php

namespace App\Livewire\Forms;

use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:6')]
    public $password;

    public function login(CognitoAuthService $authService): void
    {
        $validated = $this->validate();
        $authService->authenticate($validated);
    }

    public function render(): View
    {
        return view('livewire.forms.login');
    }
}
