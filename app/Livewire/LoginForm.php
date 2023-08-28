<?php

namespace App\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public $email, $password;

    public function login() {
        if(empty($this->email) || empty($this->password)) {
            return;
        }

        
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
