<?php

namespace App\Livewire\Forms;

use App\Enums\CognitoErrorCodes;
use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EmailVerification extends Component
{
    #[Validate('required|min:1', as: 'OTP')]
    public $otp_first, $otp_sec, $otp_third, $otp_fourth, $otp_fifth, $otp_sixth;

    public $email;
    public $success;
    public $attempt;

    /**
     * @throws \Exception
     */
    public function mount(): void
    {
        $this->email = session('verify_email');
        $this->attempt = 1;
        $this->success = null;
    }

    /**
     * @throws \Exception
     */
    public function verify(CognitoAuthService $cognitoAuthService): void
    {
        $this->validate();
        $otpCode = $this->otp_first . $this->otp_sec . $this->otp_third . $this->otp_fourth . $this->otp_fifth . $this->otp_sixth;
        $response = $cognitoAuthService->confirmSignup($this->email, $otpCode);

        if ($response === CognitoErrorCodes::CODE_MISMATCH) {
            $this->addError('OTP', 'Invalid verification code please try again');
            $this->attempt = $this->attempt + 1;
        } else if ($response === CognitoErrorCodes::EXPIRED_CODE) {
            $this->addError('OTP', 'Verification code expired, request a new one!');
            $this->attempt = $this->attempt + 1;
        } else {
            $this->dispatch('renderComponent', 'forms.login');
        }
    }

    /**
     * @throws \Exception
     */
    public function resendCode(CognitoAuthService $authService): void
    {
        $response = $authService->resendCode($this->email);

        if ($response === CognitoErrorCodes::TOO_MANY_REQUESTS) {
            $this->addError('OTP', "You have requested multiple codes, try again later.");
        } else if ($response === CognitoErrorCodes::LIMIT_EXCEEDED) {
            $this->addError('OTP', "Limit exceeded, try again later.");
        } else {
            $this->success = true;
        }
        $this->attempt = $this->attempt + 1;
    }

    public function render(): View
    {
        return view('livewire.forms.email-verification');
    }
}
