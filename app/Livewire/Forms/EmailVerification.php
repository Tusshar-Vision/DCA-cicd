<?php

namespace App\Livewire\Forms;

use App\Services\CognitoAuthService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EmailVerification extends Component
{
    public $otp_first, $otp_sec, $otp_third, $otp_fourth, $otp_fifth, $otp_sixth;
    public $email;

    public function mount(CognitoAuthService $cognitoAuthService): void
    {
        $this->email = session('verify_email');
        $cognitoAuthService->resendCode($this->email);
    }

    public function verify(CognitoAuthService $cognitoAuthService): void
    {
        $otpCode = $this->otp_first . $this->otp_sec . $this->otp_third . $this->otp_fourth . $this->otp_fifth . $this->otp_sixth;
        $response = $cognitoAuthService->confirmSignup($this->email, $otpCode);

        logger($response);
    }

    public function render(): View
    {
        return view('livewire.forms.email-verification');
    }
}
