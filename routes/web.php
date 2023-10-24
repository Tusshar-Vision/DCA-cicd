<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages;

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

Auth::routes();

// Routes for all the pages
Route::get('/', [Pages\HomeController::class, 'index'])->name('home');
Route::get('/news-today', [Pages\NewsTodayController::class, 'index'])->name('news-today');
Route::get('/monthly-magazine', [Pages\MonthlyMagazineController::class, 'index'])->name('monthly-magazine');
Route::get('/weekly-focus', [Pages\WeeklyFocusController::class, 'index'])->name('weekly-focus');
Route::get('/mains-365', [Pages\Mains365Controller::class, 'index'])->name('mains-365');
Route::get('/pt-365', [Pages\PT365Controller::class, 'index'])->name('pt-365');
Route::get('/downloads', [Pages\DownloadsController::class, 'index'])->name('downloads');
Route::get('/search', [Pages\SearchController::class, 'index'])->name('search');

// Routes for all the archives
Route::prefix('/archives')->group(function() {
    Route::get('/monthly-magazine', [Pages\MonthlyMagazineController::class, 'archive'])->name('archive.monthly-magazine');
    Route::get('/weekly-focus', [Pages\WeeklyFocusController::class, 'archive'])->name('archive.weekly-focus');
    Route::get('/daily-news', [Pages\NewsTodayController::class, 'archive'])->name('archive.daily-news');
});

// Route to render any article
Route::get('{initiative}/{topic}/{article_id}/{article_slug?}', [ArticleController::class, 'show']);

Route::middleware('auth')->group(function() {
    Route::prefix('user')->group(function() {
        // Route::get('/dashboard', )
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});

