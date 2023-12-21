<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use App\Models\User;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
use Ellaisys\Cognito\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{

    use RegistersUsers;

    protected $aws_access_key_id;
    protected $aws_secret_access_key;
    protected $client;
    protected $client_id;
    protected $user_pool_id;
    protected $client_secret;

    public $fname;
    public $lname;

    #[Rule('required|email')]
    public $email;

    #[Rule('required|min:8')]
    public $password;

    #[Rule('required|min:10')]
    public $mobile;

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
        $this->client_secret = config('aws.cognito.client_secret');
        $this->user_pool_id = config('aws.cognito.user_pool_id');
    }

    public function register()
    {
        $userAttributes = [
            [
                'Name' => 'email',
                'Value' => $this->email,
            ],
            [
                'Name' => 'name',
                'Value' => $this->fname . " " . $this->lname
            ],
            [
                'Name' => 'phone_number',
                'Value' => "+91" . $this->mobile
            ],
            [
                'Name' => 'gender',
                'Value' => 'male'
            ]
        ];


        try {
            $result = $this->client->signUp([
                'ClientId' => $this->client_id,
                'Username' => $this->email,
                'Password' => $this->password,
                'UserAttributes' => $userAttributes,
            ]);

            logger("passwo", [$this->password]);

            logger("result", [$result]);

            $user = Student::create(['name' => $this->fname . " " . $this->lname, 'email' => $this->email, 'password' => bcrypt($this->password)]);

            $this->dispatch('signup', email: $this->email);
            $this->dispatch('user-created', user: $user);
        } catch (AwsException $e) {
            Log::info('Error: ' . $e->getAwsErrorMessage());
        }
    }

    // public function register(Request $request)
    // {
    //     $data['email'] = $this->email;
    //     $data['name'] = $this->fname . " " . $this->lname;
    //     $data['phone'] = "+91" . $this->mobile;

    //     $data = collect($data);
    //     if ($cognitoRegistered = $this->createCognitoUser($data)) {
    //         User::create(($data->only('name', 'email')->toArray()));
    //     }
    //     //Redirect to view
    //     return redirect()->route('home');
    // }


    public function render()
    {
        return view('livewire.forms.register');
    }
}
