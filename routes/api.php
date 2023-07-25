<?php

use App\Http\Controllers\ClientAuthController;
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

Route::middleware('guest')->group(function () {

    Route::controller(ClientAuthController::class)->group(function() {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
        Route::post('refresh-token', 'refreshToken')->name('refreshToken');
    });
    
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [ClientAuthController::class, 'logout'])->name('logout');
});