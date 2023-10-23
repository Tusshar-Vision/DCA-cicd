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

Route::get('/', [Pages\HomeController::class, 'index'])->name('home');

Route::controller(NavigationController::class)->group(function() {
    Route::get('/news-today', 'renderNewsTodayPage')->name('news-today');
    Route::get('/monthly-magazine', 'renderMonthlyMagazinePage')->name('monthly-magazine');
    Route::get('/weekly-focus', 'renderWeeklyFocusPage')->name('weekly-focus');
    Route::get('/mains-365', 'renderMains365Page')->name('mains-365');
    Route::get('/pt-365', 'renderPT365Page')->name('pt-365');
    Route::get('/downloads', 'renderDownloadsPage')->name('downloads');
    Route::get('/search', 'renderSearchPage')->name('search');


    Route::prefix('/archives')->group(function() {
        Route::get('/monthly-magazine', 'renderMonthlyMagazineArchivesPage')->name('archive.monthly-magazine');
        Route::get('/weekly-focus', 'renderWeeklyFocusArchivesPage')->name('archive.weekly-focus');
        Route::get('/daily-news', 'renderDailyNewsArchivesPage')->name('archive.daily-news');
    });
});


Route::get('{initiative}/{topic}/{article_id}/{article_slug?}', [ArticleController::class, 'show']);

Route::middleware('auth')->group(function() {
    Route::prefix('user')->group(function() {
        // Route::get('/dashboard', )
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});

