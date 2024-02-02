<?php

namespace App\Services;

use App\DTO\StudentDTO;
use App\Enums\CognitoErrorCodes;
use App\Models\Student;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Aws\Credentials\Credentials;
use Aws\Result;

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
    public function authenticate(array $credentials): true|CognitoErrorCodes
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

            $studentData = $this->getUser($accessToken);

            $studentDTO = StudentDTO::fromAwsResult($studentData['UserAttributes']);

            $user = Student::createOrFirst([
                'first_name' => $studentDTO->first_name,
                'last_name' => $studentDTO->last_name,
                'email' => $studentDTO->email,
                'mobile_number' => $studentDTO->mobile_number,
            ]);

            auth('cognito')->login($user);

            return true;
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
     * Registers a user in the given user pool
     *
     * @param $email
     * @param $password
     * @param array $attributes
     * @return bool
     */
    public function register($email, $password, array $attributes = []): bool
    {
        $attributes['email'] = $email;

        try
        {
            $response = $this->client->signUp([
                'ClientId' => $this->client_id,
                'Password' => $password,
                // 'SecretHash' => $this->cognitoSecretHash($email),
                'UserAttributes' => $this->formatAttributes($attributes),
                'Username' => $email
            ]);
        }
        catch (CognitoIdentityProviderException $exception) {
            if ($exception->getAwsErrorCode() === CognitoErrorCodes::USERNAME_EXISTS) {
                return false;
            }

            throw $exception;
        }

        return (bool) $response['UserConfirmed'];
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

    public function forgotPassword($email): CognitoErrorCodes|Result
    {
        try {
            $response = $this->client->forgotPassword([
                'ClientId' => $this->client_id,
                'Username' => $email,
            ]);

            // Handle the result, if needed
            return $response;
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION->value => CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }
    }

    /**
     * Generates and resends the confirmation code for the given user
     *
     * @param $email
     * @return bool
     */
    public function resendCode($email): bool|CognitoErrorCodes
    {
        try
        {
            $response = $this->client->resendConfirmationCode([
                'ClientId' => $this->client_id,
                'Username' => $email,
                'UserPoolId' => $this->user_pool_id
            ]);
        }
        catch (CognitoIdentityProviderException $exception) {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION->value => CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }

        return (bool) $response['UserConfirmed'];
    }

    /**
     * Get user details using token
     *
     * @param string $token
     * @return false|Result
     */
    public function getUser(string $token): false|Result
    {
        try {
            $user = $this->client->getUser([
                'AccessToken' => $token,
            ]);
        } catch (CognitoIdentityProviderException $exception) {
            return false;
        }

        return $user;
    }

    /**
     * @throws \Exception
     */
    public function checkIfUserExists($email): CognitoErrorCodes|Result
    {
        try {
            $user = $this->client->adminGetUser([
                'UserPoolId' => $this->user_pool_id,
                'Username' => $email
            ]);
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::USER_NOT_FOUND->value => CognitoErrorCodes::USER_NOT_FOUND,
                CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION->value => CognitoErrorCodes::NOT_AUTHORIZED_EXCEPTION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }
        return $user;
    }

    /**
     * Format attributes in Name/Value array
     *
     * @param  array $attributes
     * @return array
     */
    protected function formatAttributes(array $attributes): array
    {
        $userAttributes = [];

        foreach ($attributes as $key => $value) {
            $userAttributes[] = [
                'Name' => $key,
                'Value' => $value,
            ];
        }

        return $userAttributes;
    }
}
