<?php

namespace App\Services;

use App\Enums\CognitoErrorCodes;
use App\Models\Student;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Aws\Credentials\Credentials;

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

    /**
     * @throws \Exception
     */
    public function authenticate(array $credentials)
    {
        try {

            $result = $this->client->initiateAuth([
                'AuthFlow' => 'USER_PASSWORD_AUTH',
                'ClientId' => $this->client_id,
                'UserPoolId' => $this->user_pool_id,
                'AuthParameters' => [
                    'USERNAME' => $credentials['email'],
                    'PASSWORD' => $credentials['password'],
                ],
            ]);

            // Authentication successful
            $accessToken = $result['AuthenticationResult']['AccessToken'];
            $idToken = $result['AuthenticationResult']['IdToken'];
            $refreshToken = $result['AuthenticationResult']['RefreshToken'];

            $user = Student::where('email',  $credentials['email'])->first();
            if ($user) auth('cognito')->login($user);

            // You can now use the tokens as needed
            // echo 'Access Token: ' . $accessToken . PHP_EOL;
            // echo 'Id Token: ' . $idToken . PHP_EOL;
            // echo 'Refresh Token: ' . $refreshToken . PHP_EOL;
            return redirect()->route('home');
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::USER_NOT_FOUND->value => CognitoErrorCodes::USER_NOT_FOUND,
                CognitoErrorCodes::USER_NOT_CONFIRMED->value => CognitoErrorCodes::USER_NOT_CONFIRMED,
                CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION->value => CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }
    }
    /**
     * Confirms email of a user in the given user pool
     *
     * @param $email
     * @param $code
     * @return bool
     */
    public function confirmSignup($email, $code): bool
    {
        try
        {
            $response = $this->client->confirmSignUp([
                'ClientId' => $this->client_id,
                'Username' => $email,
                'ConfirmationCode' => $code
            ]);
        }
        catch (CognitoIdentityProviderException $exception) {
            if ($exception->getAwsErrorCode() === CognitoErrorCodes::CODE_MISMATCH || $exception->getAwsErrorCode() === CognitoErrorCodes::EXPIRED_CODE) {
                return false;
            }

            throw $exception;
        }

        return (bool) $response['UserConfirmed'];
    }
}
