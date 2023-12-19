<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Ellaisys\Cognito\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{

    use RegistersUsers;

    public $fname;
    public $lname;

    #[Rule('required|email')]
    public $email;

    #[Rule('required|min:8')]
    public $password;

    #[Rule('required|min:10')]
    public $mobile;

    public function register(Request $request)
    {
        $data['email'] = $this->email;
        $data['name'] = $this->fname . " " . $this->lname;
        $data['phone'] = "+91" . $this->mobile;

        $data = collect($data);
        if ($cognitoRegistered = $this->createCognitoUser($data)) {
            User::create(($data->only('name', 'email')->toArray()));
        }
        //Redirect to view
        return redirect()->route('home');
    }


    public function render()
    {
        return view('livewire.forms.register');
    }
}
