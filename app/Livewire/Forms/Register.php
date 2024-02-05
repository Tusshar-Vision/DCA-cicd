<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule('required|string|min:3')]
    public $first_name;
    #[Rule('required|string|min:3')]
    public $last_name;

    #[Rule('required|email')]
    public $email;

    #[Rule('required|min:6')]
    public $password;

    #[Rule('required|min_digits:10|max_digits:10')]
    public $mobile;

    public function __construct() {}

    /**
     * @throws \Exception
     */
    public function register(CognitoAuthService $authService): void
    {
        $validated = $this->validate();
        $attributes = [
                'email' => $this->email,
                'name' => $this->first_name . " " . $this->last_name,
                'phone_number' => "+91" . $this->mobile,
                'gender' => 'male'
        ];
        $userExists = $authService->checkIfUserExists($validated['email']);

        if ($userExists === CognitoErrorCodes::USER_NOT_FOUND) {
            $userConfirmed = $authService->register(
                $this->email,
                $this->password,
                $attributes
            );

            if ($userConfirmed) {
                $this->dispatch('renderComponent', 'forms.login');
            } else {
                session(['verify_email' => $this->email]);
                $authService->resendCode($this->email);
                $this->dispatch('renderComponent', 'forms.email-verification');
            }
        } else {
            $this->addError('email', "Account already exists, Please Login.");
        }
    }

    public function render(): View
    {
        return view('livewire.forms.register');
    }
}
