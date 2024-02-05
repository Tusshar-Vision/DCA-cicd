<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Rule('required|email')]
    public $email;

    public $success;

    /**
     * @throws \Exception
     */
    public function submit(CognitoAuthService $authService): void
    {
        $validated = $this->validate();
        $userExists = $authService->checkIfUserExists($validated['email']);

        if ($userExists === CognitoErrorCodes::USER_NOT_FOUND) {
            $this->addError('email', "Account doesn't exist, Please Sign up.");
        } else {
            $response = $authService->forgotPassword($this->email);

            if ($response === CognitoErrorCodes::TOO_MANY_REQUESTS) {
                $this->addError('email', "You have requested multiple codes, try again later.");
            } else if ($response === CognitoErrorCodes::LIMIT_EXCEEDED) {
                $this->addError('email', "Limit exceeded, try again later.");
            } else {
                session(['verify_email' => $this->email]);
                $this->dispatch('renderComponent', 'forms.reset-password-confirm');
            }
        }
    }

    public function render(): View
    {
        return view('livewire.forms.reset-password');
    }
}
