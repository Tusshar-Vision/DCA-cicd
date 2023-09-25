<?php

namespace App\Http\Controllers;

use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class NavigationController extends Controller
{
    public $converter;

    public function __construct() {
        $this->converter = new GithubFlavoredMarkdownConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    public function renderHomePage() {
        return View('home');
    }

    public function renderNewsTodayPage() {
        $news_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('NEWS_TODAY')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->first();

        $published_articles = Article::where(
            'published_initiative_id', '=', $news_published_today->id
        )->get();

        return View('news-today', [
            'articles' => $published_articles
        ]);
    }

    public function renderMonthlyMagazinePage() {
        
        $publishedDate = Carbon::parse(date('Y-m'));

        $monthly_magazine_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('MONTHLY_MAGAZINE')
        )->whereYear(
            'published_at', '=', $publishedDate->format('Y')
        )->whereMonth(
            'published_at', '=', $publishedDate->format('m')
        )->orderBy('updated_at')->first();

        if($monthly_magazine_published_today === null) {
            return View('monthly-magazine', [
                'articles' => [],
                'topics' => [],
                'publishedDate' => $publishedDate->format('Y-m')
            ]);    
        }
        
        $published_articles = Article::where(
            'published_initiative_id', '=', $monthly_magazine_published_today->id
        )->with('topic')->get();

        $published_articles_topics = $published_articles->map(function($item) {
            return $item->topic;
        });

        $published_articles_topics = $published_articles_topics->unique();

        $published_articles_topics = $published_articles_topics->sortBy(function($item) {
            return InitiativesHelper::getInitiativeTopicID($item['name']);
        });

        $published_articles = $published_articles->map(function($article) {
            $article->content = $this->converter->convert($article->content);

            return $article;
        });
        
        return View('monthly-magazine', [
            'articles' => $published_articles,
            'topics' => $published_articles_topics,
            'publishedDate' => $publishedDate->format('Y-m')
        ]);
    }

    public function renderWeeklyFocusPage() {
        $weekly_focus_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('WEEKLY_FOCUS')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->first();

        $published_articles = Article::where(
            'published_initiative_id', '=', $weekly_focus_published_today->id
        )->get();

        return View('weekly-focus', [
            'articles' => $published_articles
        ]);
    }

    public function renderMains365Page() {
        $mains_365_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('MAINS_365')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->first();
        
        $published_articles = Article::where(
            'published_initiative_id', '=', $mains_365_published_today->id
        )->get();

        return View('mains-365', [
            'articles' => $published_articles
        ]);
    }

    public function renderPT365Page() {
        $pt_365_published_today = PublishedInitiative::where(
            'initiative_id', '=', InitiativesHelper::getInitiativeID('PT_365')
        )->whereDate('published_at', '=', date('Y-m-d'))->orderBy('updated_at')->first();
        
        $published_articles = Article::where(
            'published_initiative_id', '=', $pt_365_published_today->id
        )->get();

        return View('pt-365', [
            'title' => 'PT 365',
            'articles' => $published_articles
        ]);
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

    
    public function renderDownloadsPage() {
        return View('downloads');
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
