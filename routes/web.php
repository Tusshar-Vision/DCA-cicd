<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\NoteController;
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

// Routes for all the pages
Route::get('/', [Pages\HomeController::class, 'index'])->name('home');

Route::get('/search', [Pages\SearchController::class, 'index'])->name('search');
Route::get('/search/{query}', [Pages\SearchController::class, 'searchQuery'])->name('search.query');

Route::post('/upload', [\App\Http\Controllers\CkEditorController::class, 'store'])->name('ck-editor.upload');

Route::controller(Pages\NewsTodayController::class)
    ->group(
        function () {
            Route::prefix('/news-today')
                ->group(
                    function () {
                        Route::get('/', 'index')->name('news-today');
                        Route::get('/{date}/{topic}/{article_slug}', 'renderArticle')->name('news-today.article');
                        Route::get('/getbymonth', 'getByYearAndMonth')->name('news-today.getByYearAndMonth');
                        Route::get('/archive/{media?}', 'archive')->name('news-today.archive');
                        Route::get('/{date}/also-in-news', 'alsoInNews')->name('news-today.alsoInNews');
                    }
                );
        }
    );

Route::controller(Pages\WeeklyFocusController::class)
    ->group(
        function () {
            Route::prefix('/weekly-focus')
                ->group(
                    function () {
                        Route::get('/', 'index')->name('weekly-focus');
                        Route::get('/{date}/{topic}/{article_slug}', 'renderArticle')->name('weekly-focus.article');
                        Route::get('/archive/{media?}', 'archive')->name('weekly-focus.archive');
                    }
                );
        }
    );

Route::controller(Pages\MonthlyMagazineController::class)
    ->group(
        function () {
            Route::prefix('/monthly-magazine')
                ->group(
                    function () {
                        Route::get('/', 'index')->name('monthly-magazine');
                        Route::get('/{date}/{topic}/news-in-shorts', 'newsInShorts')->name('monthly-magazine.newsInShorts');
                        Route::get('/{date}/{topic}/{article_slug}', 'renderArticle')->name('monthly-magazine.article');
                        Route::get('/archive/{media?}', 'archive')->name('monthly-magazine.archive');
                    }
                );
        }
    );

// Routes for downloadable initiatives
Route::controller(Pages\DownloadsController::class)->group(function () {
    Route::get('/downloads', 'index')->name('downloads');
    Route::get('/mains-365/{media?}', 'renderMains365')->name('mains-365');
    Route::get('/pt-365/{media?}', 'renderPT365')->name('pt-365');
    Route::get('/economic-survey/{media?}', 'renderEconomicSurvey')->name('economic-survey');
    Route::get('/budget/{media?}', 'renderBudget')->name('budget');
    Route::get('/value-added-material/{media?}', 'renderValueAddedMaterial')->name('value-added-material');
    Route::get('/value-added-material-optional/{media?}', 'renderValueAddedMaterialOptional')->name('value-added-material-optional');
    Route::get('/quarterly-revision-documents/{media?}', 'renderQuarterlyRevisionDocument')->name('quarterly-revision-document');
    Route::get('/year-end-reviews/{media?}', 'renderYearEndReviews')->name('year-end-review');
    Route::get('/the-planet-vision/{media?}', 'renderPlanetVision')->name('planet-vision');
    Route::get('/previous-year-questions', 'renderPreviousYearQuestions')->name('pyq');

    //    Route::get('/weekly-round-table', 'getWeeklyRoundTable')->name('weekly-round-table');
    //    Route::get('/animated-shorts', 'getAnimatedShorts')->name('animated-shorts');
});

Route::controller(Pages\VideosController::class)->group(function () {
    Route::get('/videos', 'index')->name('videos');
    Route::get('/daily-news', 'renderDailyNews')->name('daily-news');
    Route::get('/in-conversation', 'renderInConversation')->name('in-conversation');
    Route::get('/simplified-by-visionias', 'renderSimplifiedByVisionIAS')->name('simplified-by-visionias');
    Route::get('/personality-in-focus', 'renderPersonalityInFocus')->name('personality-in-focus');
    Route::get('/scheme-in-focus', 'renderSchemeInFocus')->name('scheme-in-focus');
});

Route::middleware('auth:cognito')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/activity', [Pages\UserController::class, 'dashboard'])->name('user.dashboard');

        Route::post('/update/read-history', [Pages\UserController::class, 'updateReadHistory'])->name('user.read-history');
        Route::post('/mark-as-read', [Pages\UserController::class, 'markAsRead'])->name('user.mark-as-read');
        Route::get('/read-history/search/{query?}', [Pages\UserController::class, 'searchReadHistory'])->name('user.search-read-history');

        Route::get('/bookmarks', [Pages\UserController::class, 'bookmarks'])->name('bookmarks');
        Route::post('/bookmarks/add', [Pages\UserController::class, 'addBookmark'])->name('bookmarks.add');
        Route::get('/bookmarks/search/{query?}', [Pages\UserController::class, 'searchBookmark']);

        Route::get('/content/{type?}', [Pages\UserController::class, 'myContent'])->name('user.content');
        Route::get('/search-notes', [Pages\UserController::class, 'searchNotes'])->name('user.search-notes');
        Route::get('/filter-notes/{topic_id}/{section_id}', [NoteController::class, 'getFilteredNotes'])->name('user.filter-notes');

        Route::get('/logout', [Pages\UserController::class, 'logout'])->name('logout');
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

Route::get('/papers', [AppController::class, 'getPapers'])->name('papers');
Route::get('/subjects/{paper_id}', [AppController::class, 'getSubjectsOfPaper'])->name('subjects');
Route::get('/sections/{subject_id}', [AppController::class, 'getSectionsOfSubject'])->name('sections');
