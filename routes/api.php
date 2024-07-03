<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/test', function() {
//     return response([
//         "message" => "This is a test endpoint"
//     ], 200);
// });

// Route::post('/register', [UserAuthController::class, 'signup'])->name('register');
// Route::post('/login', [UserAuthController::class, 'login'])->name('login');


// //These routes will only be accessed by a valid client

// Route::middleware('auth:sanctum')->group(function() {
//     Route::controller(UserAuthController::class)->prefix('/user')->group(function() {
//         Route::get('/', 'getUser');
//         Route::post('/confirm', 'confirmSignup');
//         Route::post('/reset-password', 'resetPassword');
//         Route::post('/resend-confirmation', 'resendConfirmationCode');
//         Route::post('logout', 'logout')->name('logout');
//     });
// });