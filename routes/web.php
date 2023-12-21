<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\NoteController;
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

//Auth::routes();

// Routes for all the pages
Route::get('/', [Pages\HomeController::class, 'index'])->name('home');
Route::get('/mains-365', [Pages\Mains365Controller::class, 'index'])->name('mains365');
Route::get('/pt-365', [Pages\PT365Controller::class, 'index'])->name('pt365');
Route::get('/downloads', [Pages\DownloadsController::class, 'index'])->name('downloads');
Route::get('/search', [Pages\SearchController::class, 'index'])->name('search');

Route::controller(Pages\NewsTodayController::class)->group(function () {
    Route::get('/news-today', 'index')->name('news-today');
    Route::get('/news-today/{date}/{article_no?}', 'getArticlesDateWise')->name('news-today-date-wise');
    Route::get('/news-today/{date}/{topic}/{article_slug}', 'renderArticles')->name('news-today-date-wise.article');
    Route::get('/archive/daily-news', 'archive')->name('news-today.archive');
});

Route::controller(Pages\MonthlyMagazineController::class)->group(function () {
    Route::get('/monthly-magazine', 'index')->name('monthly-magazine');
    Route::get('/monthly-magazine/{month}', 'renderByMonth')->name('monthly-magazine-of-month.article');
    Route::get('/monthly-magazine/{month}/{topic}/{article_slug}', 'renderArticles')->name('monthly-magazine.article');
    Route::get('/archive/monthly-magazine', 'archive')->name('monthly-magazine.archive');
});

Route::controller(Pages\WeeklyFocusController::class)->group(function () {
    Route::get('/weekly-focus', 'index')->name('weekly-focus');
    Route::get('/weekly-focus/{date}/{topic}/{article_slug}', 'renderArticles')->name('weekly-focus.article');
    Route::get('/archive/weekly-focus', 'archive')->name('weekly-focus.archive');
});

Route::middleware('auth:cognito')->group(function () {
    Route::prefix('user')->group(function () {
        // Route::get('/dashboard', )
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});

Route::get('/images/{filename}', [MediaController::class, 'renderImage'])->name('image.display');
Route::get('change/lang', [LocalizationController::class, 'changeLang'])->name('lang.change');

Route::get('/highlights', [HighlightController::class, 'index'])->name('highlights');
Route::get('/highlight-serialized/{article_id}', [HighlightController::class, 'serializedData'])->name('highlights.serialized');
Route::post('/add-highlight', [HighlightController::class, 'addHighlight'])->name("highlights.add");
Route::get('/download/{media}', [MediaController::class, 'download'])->name('download');
Route::get('/view-file/{media}', [MediaController::class, 'viewFile'])->name('view-file');
Route::post('/add-notes', [NoteController::class, 'addNote'])->name("notes.add");
Route::get('/all-notes', [NoteController::class, 'index'])->name("notes.all");
Route::get('/notes/{article_id}', [NoteController::class, 'getNotesByArticleId'])->name('notes.of-article');
Route::post('notes/add-tag/{note_id}', [NoteController::class, 'addTag'])->name('notes.add-tag');
Route::get('/tags/{search}', [NoteController::class, 'searchTagsLike'])->name('tags.search');


Route::get('/test', function () {
    return view('pages.user.home');
});
