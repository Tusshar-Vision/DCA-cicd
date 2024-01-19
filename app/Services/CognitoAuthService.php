<?php

namespace App\Services;

use App\Models\Student;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Log;

class CognitoAuthService
{
    private string $aws_access_key_id;
    private string $aws_secret_access_key;
    private string $client_id;
    private string $user_pool_id;
    private CognitoIdentityProviderClient $client;

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

    public function attemptLogin(string $email, string $password)
    {
        try {
            $result = $this->client->initiateAuth([
                'AuthFlow' => 'USER_PASSWORD_AUTH',
                'ClientId' => $this->client_id,
                'UserPoolId' => $this->user_pool_id,
                'AuthParameters' => [
                    'USERNAME' => $email,
                    'PASSWORD' => $password,
                ],
            ]);

            // Authentication successful
            $accessToken = $result['AuthenticationResult']['AccessToken'];
            $idToken = $result['AuthenticationResult']['IdToken'];
            $refreshToken = $result['AuthenticationResult']['RefreshToken'];

            $user = Student::where('email', $email)->first();
            if ($user) auth('cognito')->login($user);

            // You can now use the tokens as needed
            // echo 'Access Token: ' . $accessToken . PHP_EOL;
            // echo 'Id Token: ' . $idToken . PHP_EOL;
            // echo 'Refresh Token: ' . $refreshToken . PHP_EOL;
            return redirect()->route('home');
        } catch (AwsException $e) {
            // Authentication failed
            Log::info('Error: ' . $e->getAwsErrorMessage());
        } catch (\Exception $e) {
            // Catch any other exception
            Log::info('Unhandled Exception: ' . $e->getMessage());
        }
    }
}
