<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Ellaisys\Cognito\Auth\ResetsPasswords; //Added for AWS Cognito

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
     protected $redirectTo = RouteServiceProvider::HOME;
}
