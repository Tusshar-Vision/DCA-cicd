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
        }
    }

    public function render(): View
    {
        return view('livewire.forms.reset-password');
    }
}
