<?php

namespace App\Services;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Credentials\Credentials;

class CognitoAuthService
{
    private string $aws_access_key_id;
    private string $aws_secret_access_key;
    private string $client_id;
    private string $user_pool_id;
    private $client;

    public function __construct()
    {
        $this->aws_access_key_id = config('aws.access_key.id');
        $this->aws_secret_access_key = config('aws.access_key.secret');
        $this->client_id =  config('aws.cognito.client_id');
        $this->user_pool_id = config('aws.cognito.user_pool_id');

        $this->client = new CognitoIdentityProviderClient([
            'version' => config('aws.cognito.version'),
            'region' => config('aws.cognito.region'),
            'credentials' => new Credentials($this->aws_access_key_id, $this->aws_secret_access_key),
        ]);
    }
}
