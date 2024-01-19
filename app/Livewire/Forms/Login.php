<?php

namespace App\Livewire\Forms;

use App\Services\CognitoAuthService;
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
        $authService->attemptLogin($validated);
    }

    public function render()
    {
        return view('livewire.forms.login');
    }
}
