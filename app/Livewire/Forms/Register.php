<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|string|min:3')]
    public $first_name;
    #[Validate('required|string|min:3')]
    public $last_name;

    #[Validate('regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', message: 'Please enter a valid email address.')]
    #[Validate('required')]
    public $email;

    #[Validate('regex:/^(?!\s)(?!.*\s$).+/', message: 'Password can’t start or end with a blank space.')]
    #[Validate('required')]
    #[Validate('min:6')]
    public $password;

    #[Validate('required|min_digits:10|max_digits:10')]
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

        $userConfirmed = $authService->register(
            $this->email,
            $this->password,
            $this->first_name,
            $this->last_name,
            $attributes
        );

        if ($userConfirmed === CognitoErrorCodes::USER_LAMBDA_VALIDATION) {
            $this->addError('email', "Account already exists, Please Login.");
            return;
        }

        if ($userConfirmed === CognitoErrorCodes::USERNAME_EXISTS) {
            $this->addError('email', "Account already exists, Please Login.");
        }
        else if ($userConfirmed) {
            $this->dispatch('renderComponent', 'forms.login');
        } else {
            session(['verify_email' => $this->email]);
            $this->dispatch('renderComponent', 'forms.email-verification');
        }
    }

    public function render(): View
    {
        return view('livewire.forms.register');
    }
}
