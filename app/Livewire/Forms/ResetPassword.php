<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Validate('regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', message: 'Please enter a valid email address.')]
    #[Validate('required')]
    public $email;

    public $success;

    /**
     * @throws \Exception
     */
    public function submit(CognitoAuthService $authService): void
    {
        $validated = $this->validate();

        $response = $authService->forgotPassword($this->email);

        if ($response === CognitoErrorCodes::TOO_MANY_REQUESTS) {
            $this->addError('email', "You have requested multiple codes, try again later.");
        } else if ($response === CognitoErrorCodes::LIMIT_EXCEEDED) {
            $this->addError('email', "Limit exceeded, try again later.");
        } else if ($response === CognitoErrorCodes::USER_NOT_FOUND) {
            $this->addError('email', "Sorry we don't recognize this email address.");
        } else if ($response === CognitoErrorCodes::INVALID_PARAMETER_EXCEPTION) {
            $this->addError('email', "Complete your signup.");
        } else {
            session(['verify_email' => $this->email]);
            $this->dispatch('renderComponent', 'forms.reset-password-confirm');
        }
    }

    public function render(): View
    {
        return view('livewire.forms.reset-password');
    }
}
