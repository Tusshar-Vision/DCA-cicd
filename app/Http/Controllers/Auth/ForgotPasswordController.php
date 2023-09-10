<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ellaisys\Cognito\Auth\SendsPasswordResetEmails; //Added for AWS Cognito


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
}
