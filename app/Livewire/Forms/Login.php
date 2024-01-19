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

    }

    public function render()
    {
        return view('livewire.forms.login');
    }
}
