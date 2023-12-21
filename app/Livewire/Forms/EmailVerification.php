<?php

namespace App\Livewire\Forms;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class EmailVerification extends Component
{
    protected $aws_access_key_id;
    protected $aws_secret_access_key;
    protected $client;
    protected $client_id;
    protected $user_pool_id;

    public $otp_first, $otp_sec, $otp_third, $otp_fourth, $otp_fifth, $otp_sixth;
    public $email;

    #[On('signup')]
    public function updatePostList($email)
    {
        $this->email = $email;
    }

    public function __construct()
    {
        $this->aws_access_key_id = config('aws.access_key.id');
        $this->aws_secret_access_key = config('aws.access_key.secret');
        $this->client = new CognitoIdentityProviderClient([
            'version' => config('aws.cognito.version'),
            'region' => config('aws.cognito.region'),
            'credentials' => new Credentials($this->aws_access_key_id, $this->aws_secret_access_key),
        ]);
        $this->client_id =  config('aws.cognito.client_id');
        $this->user_pool_id = config('aws.cognito.user_pool_id');
    }

    public function verify()
    {
        $username = $this->email;

        $verificationCode = $this->otp_first . $this->otp_sec . $this->otp_third . $this->otp_fourth . $this->otp_fifth . $this->otp_sixth;

        try {
            $result = $this->client->confirmSignUp([
                'ClientId' => $this->client_id,
                'Username' => $this->email,
                'ConfirmationCode' => $verificationCode,
            ]);
        } catch (AwsException $e) {
            Log::info('Error: ' . $e->getAwsErrorMessage());
        }
    }

    public function render()
    {
        return view('livewire.forms.email-verification');
    }
}
