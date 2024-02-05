<?php

namespace App\Livewire\Forms;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResetPasswordConfirm extends Component
{
    #[Validate('required', as: 'OTP')]
    public $otp_first, $otp_sec, $otp_third, $otp_fourth, $otp_fifth, $otp_sixth;

    public $email;
    #[Validate('required|min:6')]
    public $password;
    #[Validate('required|same:password')]
    public $confirmPassword;

    /**
     * @throws \Exception
     */
    public function mount(): void
    {
        $this->email = session('verify_email');
    }

    public function verify(): void
    {
        $validated = $this->validate();

        $this->addError('OTP', 'Invalid verification code please try again');
    }

    public function render(): View
    {
        return view('livewire.forms.reset-password-confirm');
    }
}
