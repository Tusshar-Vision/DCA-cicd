<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ellaisys\Cognito\Auth\AuthenticatesUsers; //Added for AWS Cognito
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Authenticate User
     * 
     * @throws \HttpException
     * 
     * @return mixed
     */
    public function login(Request $request)
    {
        try {
            //Convert request to collection
            $collection = collect($request->all());

            //Authenticate with Cognito Package Trait (with 'web' as the auth guard)
            if ($response = $this->attemptLogin($collection, 'web')) {
                if ($response===true) {
                    $request->session()->regenerate();

                    return redirect(route('home'));
    
                       // ->intended('home');
                } else if ($response===false) {
                    return redirect()
                        ->back()
                        ->withInput($request->only('username', 'remember'))
                        ->withErrors([
                            'username' => 'Incorrect username and/or password !!',
                        ]);

                    //$this->incrementLoginAttempts($request);
                    //
                    //$this->sendFailedLoginResponse($collection, null);
                } else {
                    return $response;
                } //End if
            } //End if
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return $response->back()->withInput($request);
        } //Try-catch ends

    } //Function ends

    public function logout() {
        Auth::guard('web')->logout(true);
        return redirect(RouteServiceProvider::HOME);
    }
}
