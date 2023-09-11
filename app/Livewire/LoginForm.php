<?php

namespace App\Livewire;

use Ellaisys\Cognito\Auth\AuthenticatesUsers;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;

class LoginForm extends Component
{
    use AuthenticatesUsers;

    #[Rule('required|email')]
    public $email;

    #[Rule('required|min:8')]
    public $password;

    public function login() {
        
        if(empty($this->email) || empty($this->password)) {
            return;
        }
        
        try {
            //Convert request to collection
            $collection = collect(['email' => $this->email, 'password' => $this->password]);

            //Authenticate with Cognito Package Trait (with 'web' as the auth guard)
            if ($response = $this->attemptLogin($collection, 'web')) {
                if ($response===true) {
                    session()->regenerate();
                    return redirect(route('home'));
                       // ->intended('home');
                } else if ($response===false) {
                    session()->flash('error', 'Incorrect email and/or password.');
                    $this->reset(['password']); // Clear the password field

                    //$this->incrementLoginAttempts($request);
                    //
                    //$this->sendFailedLoginResponse($collection, null);
                } else {
                    return $response;
                } //End if
            } //End if
        } catch(Exception $e) {
            session()->flash('error', $e->getMessage());
            $this->reset(['password']); 
            Log::error($e->getMessage());
        } //Try-catch ends
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
