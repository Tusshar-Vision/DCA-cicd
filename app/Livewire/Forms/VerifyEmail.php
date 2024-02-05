<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class VerifyEmail extends Component
{
    #[Validate('required|email')]
    public $email;

    /**
     * @throws \Exception
     */
    public function submit(CognitoAuthService $authService): void
    {
        $validated = $this->validate();
        $userExists = $authService->checkIfUserExists($validated['email']);

        if ($userExists === CognitoErrorCodes::USER_NOT_FOUND) {
            $this->addError('email', "Email id doesn't exists, Please Sign Up.");
        } else {
            session(['verify_email' => $this->email]);
            $this->dispatch('renderComponent', 'forms.email-verification');
        }
    }

    public function render(): View
    {
        return view('livewire.forms.verify-email');
    }
}
