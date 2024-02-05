<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
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

    /**
     * @throws \Exception
     */
    public function login(CognitoAuthService $authService): void
    {
        $validated = $this->validate();
        $userExists = $authService->checkIfUserExists($validated['email']);

        if ($userExists === CognitoErrorCodes::USER_NOT_FOUND) {
            $this->addError('email', "Email id doesn't exists, Please Sign Up.");
        }
        else {
            $response = $authService->authenticate($validated);

            if ($response === true) {
                $this->redirect(route('home'), navigate: true);
            }

            if ($response === CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION) {
                $this->addError('email', "Email id or password doesn't match.");
            }

            if ($response === CognitoErrorCodes::USER_NOT_CONFIRMED) {
                session(['verify_email' => $this->email]);
                $authService->resendCode($this->email);
                $this->dispatch('renderComponent', 'forms.email-verification');
            }
        }
    }

    public function render(): View
    {
        return view('livewire.forms.login');
    }
}
