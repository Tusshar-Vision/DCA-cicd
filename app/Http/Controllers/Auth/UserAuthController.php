<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CognitoClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserAuthController extends Controller
{
    public function getUser(Request $request) {
        dd($request->all());
    }
    
    public function login(Request $request)
    {
        dd(app()->make(CognitoClient::class)->authenticate($request->email, $request->password));
        // $response = app()->make(CognitoClient::class)->register($request->email, $request->password, [
        //     "name"    => $request->first_name . " " . $request->last_name,
        //     "phone_number"  => $request->mobile 
        // ]);

        // dd($response);
    }

    public function signup(Request $request) {

    }

    public function confirmSignup(Request $request) {

    }

    public function resetPassword(Request $request) {

    }

    public function resendConfirmationCode(Request $request) {

    }
}
