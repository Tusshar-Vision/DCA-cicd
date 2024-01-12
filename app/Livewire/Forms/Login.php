<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|email')]
    public $email;

    #[Rule('required|min:8')]
    public $password;

    public function login()
    {
        try {
            $result = $this->client->initiateAuth([
                'AuthFlow' => 'USER_PASSWORD_AUTH',
                'ClientId' => $this->client_id,
                'UserPoolId' => $this->user_pool_id,
                'AuthParameters' => [
                    'USERNAME' => $this->email,
                    'PASSWORD' => $this->password,
                ],
            ]);

            // Authentication successful
            $accessToken = $result['AuthenticationResult']['AccessToken'];
            $idToken = $result['AuthenticationResult']['IdToken'];
            $refreshToken = $result['AuthenticationResult']['RefreshToken'];

            $user = Student::where('email', $this->email)->first();
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

    public function render()
    {
        return view('livewire.forms.login');
    }
}
