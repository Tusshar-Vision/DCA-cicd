<?php
namespace App\Helpers;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Illuminate\Support\Facades\Password;

class CognitoClient
{
    const NEW_PASSWORD_CHALLENGE    = 'NEW_PASSWORD_REQUIRED';
    const FORCE_PASSWORD_STATUS     = 'FORCE_CHANGE_PASSWORD';
    const RESET_REQUIRED            = 'PasswordResetRequiredException';
    const USER_NOT_FOUND            = 'UserNotFoundException';
    const USERNAME_EXISTS           = 'UsernameExistsException';
    const INVALID_PASSWORD          = 'InvalidPasswordException';
    const CODE_MISMATCH             = 'CodeMismatchException';
    const EXPIRED_CODE              = 'ExpiredCodeException';
    const NOT_AUTHORIZED_EXCEPTION  = 'NotAuthorizedException';

    /**
     * @var CognitoIdentityProviderClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $poolId;

    /**
     * CognitoClient constructor.
     * @param CognitoIdentityProviderClient $client
     * @param string $clientId
     * @param string $clientSecret
     * @param string $poolId
     */
    public function __construct(
        CognitoIdentityProviderClient $client,
        $clientId,
        $clientSecret,
        $poolId
    ) {
        $this->client       = $client;
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
        $this->poolId       = $poolId;
    }

    /**
     * Checks if credentials of a user are valid
     *
     * @see http://docs.aws.amazon.com/cognito-user-identity-pools/latest/APIReference/API_AdminInitiateAuth.html
     * @param string $email
     * @param string $password
     * @return \Aws\Result|bool
     */
    public function authenticate($email, $password)
    {
        try
        {
            $response = $this->client->initiateAuth([
                'AuthFlow'       => 'USER_PASSWORD_AUTH',
                'AuthParameters' => [
                    'USERNAME'     => $email,
                    'PASSWORD'     => $password,
                    // 'SECRET_HASH'  => $this->cognitoSecretHash($email)
                ],
                'ClientId'   => $this->clientId,
                'UserPoolId' => $this->poolId
            ]);
        }
        catch (CognitoIdentityProviderException $exception)
        {
            if (
                ($exception->getAwsErrorCode() === self::RESET_REQUIRED) ||
                ($exception->getAwsErrorCode() === self::USER_NOT_FOUND)  ||
                ($exception->getAwsErrorCode() === self::NOT_AUTHORIZED_EXCEPTION)
            ) {
                return $exception->getAwsErrorCode();
            } 

            throw $exception;
        }

        return $response['AuthenticationResult'];
    }

    /**
     * Registers a user in the given user pool
     *
     * @param $email
     * @param $password
     * @param array $attributes
     * @return bool
     */
    public function register($email, $password, array $attributes = [])
    {
        $attributes['email'] = $email;

        try
        {
            $response = $this->client->signUp([
                'ClientId' => $this->clientId,
                'Password' => $password,
                // 'SecretHash' => $this->cognitoSecretHash($email),
                'UserAttributes' => $this->formatAttributes($attributes),
                'Username' => $email
            ]);
        }
        catch (CognitoIdentityProviderException $exception) {
            if ($exception->getAwsErrorCode() === self::USERNAME_EXISTS) {
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
    public function confirmSignup($email, $code)
    {
        try
        {
            $response = $this->client->confirmSignUp([
                'ClientId' => $this->clientId,
                'Username' => $email,
                'ConfirmationCode' => $code
            ]);
        }
        catch (CognitoIdentityProviderException $exception) {
            if ($exception->getAwsErrorCode() === self::CODE_MISMATCH || $exception->getAwsErrorCode() === self::EXPIRED_CODE) {
                return false;
            }

            throw $exception;
        }

        return true;
    }

    /**
     * Generates and resends the confirmation code for the given user
     *
     * @param $email
     * @param $code
     * @return bool
     */
    public function resendCode($email)
    {
        try
        {
            $response = $this->client->resendConfirmationCode([
                'ClientId' => $this->clientId,
                'Username' => $email,
                'UserPoolId' => $this->poolId
            ]);
        }
        catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }

        return true;
    }

    /**
     * Get user details using token
     *
     * @param  string $token
     * @return mixed
     */
    public function getUser($token)
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
     * Send a password reset code to a user.
     * @see http://docs.aws.amazon.com/cognito-user-identity-pools/latest/APIReference/API_ForgotPassword.html
     *
     * @param  string $username
     * @return string
     */
    public function sendResetLink($username)
    {
        try {
            $result = $this->client->forgotPassword([
                'ClientId' => $this->clientId,
                // 'SecretHash' => $this->cognitoSecretHash($username),
                'Username' => $username,
            ]);
        } catch (CognitoIdentityProviderException $exception) {
            if ($exception->getAwsErrorCode() === self::USER_NOT_FOUND) {
                return Password::INVALID_USER;
            }

            throw $exception;
        }

        return Password::RESET_LINK_SENT;
    }

    # HELPER FUNCTIONS

    /**
     * Set a users attributes.
     * http://docs.aws.amazon.com/cognito-user-identity-pools/latest/APIReference/API_AdminUpdateUserAttributes.html
     *
     * @param string $username
     * @param array  $attributes
     * @return bool
     */
    public function setUserAttributes($username, array $attributes)
    {
        $this->client->AdminUpdateUserAttributes([
            'Username' => $username,
            'UserPoolId' => $this->poolId,
            'UserAttributes' => $this->formatAttributes($attributes),
        ]);

        return true;
    }


    /**
     * Creates the Cognito secret hash
     * @param string $username
     * @return string
     */
    protected function cognitoSecretHash($username)
    {
        return $this->hash($username . $this->clientId);
    }

    /**
     * Creates a HMAC from a string
     *
     * @param string $message
     * @return string
     */
    protected function hash($message)
    {
        $hash = hash_hmac(
            'sha256',
            $message,
            $this->clientSecret,
            true
        );

        return base64_encode($hash);
    }

    /**
     * Get user details.
     * http://docs.aws.amazon.com/cognito-user-identity-pools/latest/APIReference/API_GetUser.html
     *
     * @param  string $username
     * @return mixed
     */
    public function adminGetUser($username)
    {
        try {
            $user = $this->client->AdminGetUser([
                'Username' => $username,
                'UserPoolId' => $this->poolId,
            ]);
        } catch (CognitoIdentityProviderException $exception) {
            return false;
        }

        return $user;
    }

    /**
     * Format attributes in Name/Value array
     *
     * @param  array $attributes
     * @return array
     */
    protected function formatAttributes(array $attributes)
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
