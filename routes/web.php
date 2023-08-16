<?php

use App\Http\Controllers\InitiativeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [InitiativeController::class, 'index']);
Route::get('/{initiative}', [InitiativeController::class, 'getArticles']);