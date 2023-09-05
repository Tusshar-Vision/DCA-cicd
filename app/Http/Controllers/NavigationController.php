<?php

namespace App\Http\Controllers;

use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\Initiative;
use App\Models\PublishedInitiative;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function renderHomePage() {
        return View('home');
    }

    public function renderNewsTodayPage() {
        $news_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('NEWS_TODAY')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->get();

        dd($news_published_today);

        return View('news-today');
    }

    public function renderMonthlyMagazinePage() {
        $monthly_magazine_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('MONTHLY_MAGAZINE')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->get();
        
        dd($monthly_magazine_published_today);

        return View('monthly-magazine', [
            'articles' => $articles
        ]);
    }

    public function renderWeeklyFocusPage() {
        $weekly_focus_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('WEEKLY_FOCUS')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->get();

        dd($weekly_focus_published_today);

        return View('weekly-focus');
    }

    public function renderMains365Page() {
        $mains_365_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('MAINS_365')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->get();
        
        dd($mains_365_published_today);

        return View('mains-365');
    }

    public function renderPT365Page() {
        $pt_365_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('PT_365')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->get();
        
        dd($pt_365_published_today);

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
