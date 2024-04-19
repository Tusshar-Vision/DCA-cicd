<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', message: 'Please enter a valid email address.')]
    #[Validate('required')]
    public $email;

    #[Validate('regex:/^(?!\s)(?!.*\s$).+/', message: 'Password can’t start or end with a blank space.')]
    #[Validate('required')]
    #[Validate('min:6')]
    #[Validate('max:16')]
    public $password;

    /**
     * @throws \Exception
     */
    public function login(CognitoAuthService $authService): void
    {
        $validated = $this->validate();

        $response = $authService->authenticate($validated);

        if ($response === true) {
            $this->redirect(route('home'), navigate: true);
        }

        if ($response === CognitoErrorCodes::USER_NOT_FOUND) {
            $this->addError('email', "User doesn't exist, please signup!");
        }

        if ($response === CognitoErrorCodes::NOT_AUTHORIZED) {
            $this->addError('email', "Email id or password doesn't match.");
        }

        if ($response === CognitoErrorCodes::USER_NOT_CONFIRMED) {
            session(['verify_email' => $this->email]);
            $authService->resendCode($this->email);
            $this->dispatch('renderComponent', 'forms.email-verification');
        }

        if ($response === CognitoErrorCodes::USER_LAMBDA_VALIDATION) {
            $this->addError('email', "Only staff members can login.");
        }
    }

    public function render(): View
    {
        return view('livewire.forms.login');
    }
}
