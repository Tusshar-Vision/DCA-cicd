<?php

namespace App\Services;

use App\DTO\StudentDTO;
use App\Enums\CognitoErrorCodes;
use App\Helpers\CustomEncrypter;
use App\Models\Student;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Aws\Credentials\Credentials;
use Aws\Result;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use JOSE_JWT;

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
            $idToken = $result['AuthenticationResult']['IdToken'];
            $accessToken = $result['AuthenticationResult']['AccessToken'];
            $refreshToken = $result['AuthenticationResult']['RefreshToken'];

            $decodedIdToken = $this->decodeToken($idToken);
            $decodedAccessToken = $this->decodeToken($accessToken);

            $idTokenCookie = ['idToken' => ['jwtToken' => $idToken, 'expiryTime' => $decodedIdToken->claims['exp']]];
            $accessTokenCookie = ['accessToken' => ['jwtToken' => $accessToken, 'expiryTime' => $decodedAccessToken->claims['exp']]];
            $refreshTokenCookie = ['refreshToken' => ['token' => $refreshToken]];

            $encrypterVersion = config('app.encryption_version');

            CustomEncrypter::setKey('VisionIas');
            $encryptedVersionCookie = CustomEncrypter::encrypt($encrypterVersion);

            ($encrypterVersion === 'V1') ? CustomEncrypter::setKey(config('app.encryption_key_v1')) : CustomEncrypter::resetKey();

            $encryptedIdTokenCookie = CustomEncrypter::encrypt(json_encode($idTokenCookie));
            $encryptedAccessTokenCookie = CustomEncrypter::encrypt(json_encode($accessTokenCookie));
            $encryptedRefreshTokenCookie = CustomEncrypter::encrypt(json_encode($refreshTokenCookie));

            CustomEncrypter::resetKey();

            Cookie::queue(
                Cookie::make(
                    config('app.cookie_name.version'),
                    $encryptedVersionCookie,
                    525600,
                    "/",
                    config('app.cookie_domain'),
                    false,
                    false
                )
            );
            Cookie::queue(
                Cookie::make(
                    config('app.cookie_name.access_token'),
                    $encryptedAccessTokenCookie,
                    5,
                    "/",
                    config('app.cookie_domain'),
                    false,
                    false
                )
            );
            Cookie::queue(
                Cookie::make(
                    config('app.cookie_name.refresh_token'),
                    $encryptedRefreshTokenCookie,
                    525600,
                    "/",
                    config('app.cookie_domain'),
                    false,
                    false
                )
            );
            Cookie::queue(
                Cookie::make(
                    config('app.cookie_name.id_token'),
                    $encryptedIdTokenCookie,
                    5,
                    "/",
                    config('app.cookie_domain'),
                    false,
                    false
                )
            );

            $this->syncToken($refreshToken, $idToken);
            $this->loginStudent($idToken);

            return true;
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::USER_NOT_FOUND->value => CognitoErrorCodes::USER_NOT_FOUND,
                CognitoErrorCodes::USER_NOT_CONFIRMED->value => CognitoErrorCodes::USER_NOT_CONFIRMED,
                CognitoErrorCodes::NOT_AUTHORIZED->value => CognitoErrorCodes::NOT_AUTHORIZED,
                CognitoErrorCodes::USER_LAMBDA_VALIDATION->value => CognitoErrorCodes::USER_LAMBDA_VALIDATION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }
    }

    public function refreshTokenAuthentication($refreshToken) {
        try {
            $result = $this->client->initiateAuth([
                'UserPoolId' => $this->user_pool_id,
                'ClientId' => $this->client_id,
                'AuthFlow' => 'REFRESH_TOKEN_AUTH',
                'AuthParameters' => [
                    'REFRESH_TOKEN' => $refreshToken,
                ],
            ]);

            // Extract the new tokens from the result
            $tokens = $result->get('AuthenticationResult');

        } catch (\Exception $e) {
            $tokens['error'] = "Exception Occured";
        }

        return $tokens;
    }

    public function loginStudent(string $idToken): void
    {
        $studentData = $this->getUser($idToken);

        $studentDTO = StudentDTO::fromAwsResult($studentData['result']);

        $user = Student::createOrFirst([
            'email' => $studentDTO->email,
        ],[
            'first_name' => $studentDTO->first_name,
            'last_name' => $studentDTO->last_name,
            'mobile_number' => $studentDTO->mobile_number,
        ]);

        auth('cognito')->login($user);
    }

    /**
     * Registers a user in the given user pool
     *
     * @param $email
     * @param $password
     * @param array $attributes
     * @throws \Exception
     */
    public function register($email, $password, $firstName, $lastName, array $attributes = []): bool|CognitoErrorCodes
    {
        $attributes['email'] = $email;

        try
        {
            $response = $this->client->signUp([
                'ClientId' => $this->client_id,
                'Password' => $password,
                'UserAttributes' => $this->formatAttributes($attributes),
                'Username' => $email,
                'ClientMetadata' => [
                    'passwd' => $password,
                    'first_name' =>  $firstName,
                    'last_name' => $lastName,
                    'name' => $attributes['name'],
                    'gender' => $attributes['gender'],
                    'birthdate' => '1997-10-20',
                ]
            ]);
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::TOO_MANY_REQUESTS->value => CognitoErrorCodes::TOO_MANY_REQUESTS,
                CognitoErrorCodes::LIMIT_EXCEEDED->value => CognitoErrorCodes::LIMIT_EXCEEDED,
                CognitoErrorCodes::USERNAME_EXISTS->value => CognitoErrorCodes::USERNAME_EXISTS,
                CognitoErrorCodes::USER_LAMBDA_VALIDATION->value => CognitoErrorCodes::USER_LAMBDA_VALIDATION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }

        return (bool) $response['UserConfirmed'];
    }

    /**
     * Confirms email of a user in the given user pool
     *
     * @param $email
     * @param $code
     * @return CognitoErrorCodes|bool
     * @throws \Exception
     */
    public function confirmSignup($email, $code): CognitoErrorCodes|bool
    {
        try
        {
            $response = $this->client->confirmSignUp([
                'ClientId' => $this->client_id,
                'Username' => $email,
                'ConfirmationCode' => $code
            ]);
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::CODE_MISMATCH->value => CognitoErrorCodes::CODE_MISMATCH,
                CognitoErrorCodes::EXPIRED_CODE->value => CognitoErrorCodes::EXPIRED_CODE,
                CognitoErrorCodes::TOO_MANY_REQUESTS->value => CognitoErrorCodes::TOO_MANY_REQUESTS,
                CognitoErrorCodes::LIMIT_EXCEEDED->value => CognitoErrorCodes::LIMIT_EXCEEDED,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }

        return (bool) $response['UserConfirmed'];
    }

    /**
     * @throws \Exception
     */
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
                CognitoErrorCodes::NOT_AUTHORIZED->value => CognitoErrorCodes::NOT_AUTHORIZED,
                CognitoErrorCodes::USER_NOT_FOUND->value => CognitoErrorCodes::USER_NOT_FOUND,
                CognitoErrorCodes::TOO_MANY_REQUESTS->value => CognitoErrorCodes::TOO_MANY_REQUESTS,
                CognitoErrorCodes::LIMIT_EXCEEDED->value => CognitoErrorCodes::LIMIT_EXCEEDED,
                CognitoErrorCodes::INVALID_PARAMETER_EXCEPTION->value => CognitoErrorCodes::INVALID_PARAMETER_EXCEPTION,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }
    }

    /**
     * @throws \Exception
     */
    public function confirmForgotPassword($email, $newPassword, $confirmationCode): CognitoErrorCodes|Result
    {
        try {
            $response = $this->client->confirmForgotPassword([
                'ClientId' => $this->client_id,
                'Username' => $email,
                'Password' => $newPassword,
                'ConfirmationCode' => $confirmationCode,
                'ClientMetadata' => [
                    'passwd' => $newPassword
                ]
            ]);

            // Handle the result, if needed
            return $response;
        } catch (CognitoIdentityProviderException $exception)
        {
            $errorCode = $exception->getAwsErrorCode();

            return match ($errorCode) {
                CognitoErrorCodes::CODE_MISMATCH->value => CognitoErrorCodes::CODE_MISMATCH,
                CognitoErrorCodes::EXPIRED_CODE->value => CognitoErrorCodes::EXPIRED_CODE,
                CognitoErrorCodes::TOO_MANY_REQUESTS->value => CognitoErrorCodes::TOO_MANY_REQUESTS,
                CognitoErrorCodes::LIMIT_EXCEEDED->value => CognitoErrorCodes::LIMIT_EXCEEDED,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }
    }

    /**
     * Generates and resends the confirmation code for the given user
     *
     * @param $email
     * @return bool|CognitoErrorCodes
     * @throws \Exception
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
                CognitoErrorCodes::NOT_AUTHORIZED->value => CognitoErrorCodes::NOT_AUTHORIZED,
                CognitoErrorCodes::TOO_MANY_REQUESTS->value => CognitoErrorCodes::TOO_MANY_REQUESTS,
                CognitoErrorCodes::LIMIT_EXCEEDED->value => CognitoErrorCodes::LIMIT_EXCEEDED,
                default => throw new \Exception("Unhandled AWS Cognito error code: $errorCode"),
            };
        }

        return (bool) $response['UserConfirmed'];
    }

    /**
     * Get user details using token
     *
     * @param string $token
     * @return false|array
     */
    public function getUser(string $token): false|array
    {
        try {
            $response = Http::withHeaders([
                'Bearer' => $token,
                'Content-Type' => 'application/json',
            ])->get(config('app.vision_api') . '/user/details');

            $user = $response->json();

        } catch (\Exception $exception) {
            return false;
        }

        return $user;
    }

    private function syncToken(string $refreshToken, string $idToken): void
    {
        try {
            $response = Http::withHeaders([
                'Bearer' => $idToken,
                'Content-Type' => 'application/json',
            ])->post(config('app.vision_api') . '/auth/token/sync', [
                'refresh_token' => $refreshToken,
            ]);

            if ($response->successful()) {
                $data = $response->json();
            } else {
                $statusCode = $response->status();
                $errorBody = $response->body();
            }
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function decodeToken($token): JOSE_JWT|\JOSE_JWE
    {
        try {
            $jwt = JOSE_JWT::decode($token);
        }
        catch(\Exception $e){
            $jwt = (object)[];
            $jwt->error = "Exception Occured";
        }
        return $jwt;
    }

    public function getUserFromToken($access_token): array
    {
        try {
            $user = $this->client->getUser([
                'AccessToken' => $access_token,
            ]);
            // echo 'User is still logged in';
            return ['status' => TRUE, 'data' => $user];

        } catch (\Exception $e) {
            // echo 'User has been logged out';
            return ['status' => FALSE, 'message' => "User has been logged out"];

        }
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
                CognitoErrorCodes::NOT_AUTHORIZED->value => CognitoErrorCodes::NOT_AUTHORIZED,
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
