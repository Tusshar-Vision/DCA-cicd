<?php

namespace App\Livewire\Forms;

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
        $response = $authService->forgotPassword($validated['email']);
    }

    public function render(): View
    {
        return view('livewire.forms.reset-password');
    }
}
