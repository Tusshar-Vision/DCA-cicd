<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CognitoClient;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Ellaisys\Cognito\AwsCognitoClaim;
use Ellaisys\Cognito\Auth\AuthenticatesUsers as CognitoAuthenticatesUsers;


class UserAuthController extends Controller
{
    use CognitoAuthenticatesUsers;

    public function getUser(Request $request) {
        return response([
            "message" => Response::$statusTexts[Response::HTTP_OK]
        ], Response::HTTP_OK);
    }
    
    public function login(UserLoginRequest $request)
    {
        $validated = $request->validated();

        //Convert request to collection
        $collection = collect(
            [
                "username" => $validated['email'],
                ...$validated
            ]
        );

        //Authenticate with Cognito Package Trait (with 'api' as the auth guard)
        if ($claim = $this->attemptLogin($collection, 'api', 'username', 'password', true)) {
            if ($claim instanceof AwsCognitoClaim) {
                return $claim->getData();
            } else {
                return response()->json(['status' => 'error', 'message' => $claim], 400);
            } //End if
        } //End if

        // $response = app()->make(CognitoClient::class)->authenticate($validated['email'], $validated['password']);

        // if(is_string($response)) {
        //     return response([
        //         'message' => $response    
        //     ], Response::HTTP_NOT_FOUND);
        // }

        // return response([
        //     $response
        // ], Response::HTTP_OK);
    }

    public function signup(Request $request) {

        $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:64|unique:users',
            'password' => 'sometimes|confirmed|min:6|max:64',
        ]);

        //Create credentials object
        $collection = collect($request->all());
        $data = $collection->only('name', 'email', 'password'); //passing 'password' is optional.

        //Register User in cognito
        if ($cognitoRegistered=$this->createCognitoUser($data)) {

            //If successful, create the user in local db
            User::create($collection->only('name', 'email'));
        } //End if

        //Redirect to view
        return view('login');

        // $response = app()->make(CognitoClient::class)->register($request->email, $request->password, [
        //     "name"    => $request->first_name . " " . $request->last_name,
        //     "phone_number"  => $request->mobile 
        // ]);

        // dd($response);
    }

    public function confirmSignup(Request $request) {
        dd(app()->make(CognitoClient::class)->confirmSignup($request->email, $request->code));
    }

    public function resetPassword(Request $request) {

    }

    public function resendConfirmationCode(Request $request) {
        dd(app()->make(CognitoClient::class)->resendCode($request->email));
    }
}
