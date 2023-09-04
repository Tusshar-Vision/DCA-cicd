<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function renderHomePage() {
        return View('home');
    }

    public function renderNewsTodayPage() {
        return View('news-today');
    }

    public function renderMonthlyMagazinePage() {
        $articles = Article::where('initiative_id', '=' , 2)->get();
        return View('monthly-magazine', [
            'articles' => $articles
        ]);
    }

    public function renderWeeklyFocusPage() {
        return View('weekly-focus');
    }

    public function renderMains365Page() {
        return View('mains-365');
    }

    public function renderPT365Page() {
        return View('pt-365', [
            "title" => "PT 365"
        ]);
    }

    public function renderDownloadsPage() {
        return View('downloads');
    }

    public function renderMonthlyMagazineArchivesPage() {
        return View('archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives"
        ]);
    }

    public function renderWeeklyFocusArchivesPage() {
        return View('archives.weekly-focus', [
            "title" => "Weekly Focus Archive"
        ]);
    }

    public function renderDailyNewsArchivesPage() {
        return View('archives.daily-news', [
            "title" => "Daily News Archive"
        ]);
    }

    public function renderSearchPage(Request $request) {
        $query = $request->get('query');

        $searchResults = Article::search($query)->paginate(10);

        return View('search', [
            'query' => $query,
            'searchResults' => $searchResults
        ]);
    }
}
