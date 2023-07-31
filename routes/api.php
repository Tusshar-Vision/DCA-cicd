<?php

use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {

    //!Important, This route generates the access token to access the api from the client.
    Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);

    Route::get('/test', function() {
        dd("This is a test endpoint");
    });
});

Route::middleware('client')->group(function () {

    //These routes will only be accessed by a valid client

    Route::controller(UserAuthController::class)->prefix('/user')->group(function() {
        Route::post('/', 'getUser');
        Route::post('/register', 'signup');
        Route::post('/login', 'login');
        Route::post('/confirm', 'confirmSignup');
        Route::post('/reset-password', 'resetPassword');
        Route::post('/resend-confirmation', 'resendConfirmationCode');
        Route::post('logout', 'logout')->name('logout');
    });
});