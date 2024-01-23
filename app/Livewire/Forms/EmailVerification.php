<?php

namespace App\Livewire\Forms;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class EmailVerification extends Component
{
    public $otp_first, $otp_sec, $otp_third, $otp_fourth, $otp_fifth, $otp_sixth;
    public $email, $user;

    #[On('signup')]
    public function confirmEmail($email): void
    {
        $this->email = $email;
    }

    public function __construct() {}

    public function verify()
    {

    }

    public function render(): View
    {
        return view('livewire.forms.email-verification');
    }
}
