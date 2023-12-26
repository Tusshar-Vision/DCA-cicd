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
    protected $aws_access_key_id;
    protected $aws_secret_access_key;
    protected $client;
    protected $client_id;
    protected $user_pool_id;

    #[Rule('required|email')]
    public $email;

    #[Rule('required|min:8')]
    public $password;

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

    // public function login()
    // {
    //     if (empty($this->email) || empty($this->password)) {
    //         return;
    //     }

    //     try {
    //         $collection = collect(['email' => $this->email, 'password' => $this->password]);

    //         $response = $this->attemptLogin($collection, 'cognito');
    //         //Authenticate with Cognito Package Trait (with 'web' as the auth guard)
    //         if ($response) {
    //             if ($response === true) {
    //                 session()->regenerate();
    //                 return redirect(route('home'));
    //                 // ->intended('home');
    //             } else if ($response === false) {
    //                 session()->flash('error', 'Incorrect email and/or password.');
    //                 $this->reset(['password']); // Clear the password field

    //                 //$this->incrementLoginAttempts($request);
    //                 //
    //                 //$this->sendFailedLoginResponse($collection, null);
    //             } else {
    //                 return $response;
    //             } //End if
    //         } //End if
    //     } catch (Exception $e) {
    //         session()->flash('error', $e->getMessage());
    //         $this->reset(['password']);
    //         Log::error($e->getMessage());
    //     } //Try-catch ends
    // }



    public function render()
    {
        return view('livewire.forms.login');
    }
}
