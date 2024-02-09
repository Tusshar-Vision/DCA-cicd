<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResetPasswordConfirm extends Component
{
    public $email;
    public $success;

    #[Validate('required|min:1', as: 'OTP')]
    public $otp_first, $otp_sec, $otp_third, $otp_fourth, $otp_fifth, $otp_sixth;

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
        $this->success = null;
    }

    /**
     * @throws \Exception
     */
    public function verify(CognitoAuthService $authService): void
    {
        $validated = $this->validate();
        $otpCode = $this->otp_first . $this->otp_sec . $this->otp_third . $this->otp_fourth . $this->otp_fifth . $this->otp_sixth;

        $response = $authService->confirmForgotPassword($this->email, $this->confirmPassword, $otpCode);

        if ($response === CognitoErrorCodes::CODE_MISMATCH) {
            $this->addError('OTP', 'Invalid verification code please try again');
        } else if ($response === CognitoErrorCodes::EXPIRED_CODE) {
            $this->addError('OTP', 'Verification code expired, request a new one!');
        } else {
            $this->dispatch('renderComponent', 'forms.reset-password-success');
        }
    }

    /**
     * @throws \Exception
     */
    public function resendCode(CognitoAuthService $authService): void
    {
        $response = $authService->forgotPassword($this->email);

        if ($response === CognitoErrorCodes::TOO_MANY_REQUESTS) {
            $this->addError('OTP', "You have requested multiple codes, try again later.");
        } else if ($response === CognitoErrorCodes::LIMIT_EXCEEDED) {
            $this->addError('OTP', "Limit exceeded, try again later.");
        } else {
            $this->success = true;
        }
    }

    public function render(): View
    {
        return view('livewire.forms.reset-password-confirm');
    }
}
