<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidUserFieldException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
        /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws InvalidUserFieldException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $attributes = [];

        $userFields = config('cognito.sso_user_fields');

        foreach ($userFields as $userField) {
            if ($request->filled($userField)) {
                $attributes[$userField] = $request->get($userField);
            } else {
                throw new InvalidUserFieldException("The configured user field {$userField} is not provided in the request.");
            }
        }

        app()->make(CognitoClient::class)->register($request->email, $request->password, $attributes);

        $user = $this->create($request->all());

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }
}
