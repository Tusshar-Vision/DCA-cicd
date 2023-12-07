<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class NewsTodayController extends Controller
{
    private int $initiativeId;
    protected $articles;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly ArticleService $articleService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID('NEWS_TODAY');
    }

    public function index()
    {
        $latestNewsToday = $this->publishedInitiativeService->getLatestById($this->initiativeId, Carbon::now());

        if (!$latestNewsToday) {
            return View('pages.no-news-today');
        }

        $articles = $latestNewsToday->articles->where('language', config("settings.language." . app()->getLocale()));
        $article_slug = $articles[0]->slug;
        $article_topic = $articles[0]->topic->name;
        $date =  Carbon::parse($articles[0]->published_at)->format('Y-m-d');

        return redirect()->route('news-today-date-wise.article', ['date' => $date, 'topic' => $article_topic, 'article_slug' => $article_slug]);
    }

    public function getArticlesDateWise($date)
    {
        $latestPublishedInitiative = $this->publishedInitiativeService->getLatestById($this->initiativeId, $date);

        if (!$latestPublishedInitiative) {
            return View('pages.no-news-today');
        }

        $article_no = 1;

        if ($page_no = request()->query('page'))
            $article_no = $page_no;

        $articles = $latestPublishedInitiative->articles->where('language', config("settings.language." . app()->getLocale()));

        if ($articles->isEmpty()) {
            return View('pages.no-news-today');
        }

        $article = $articles[$article_no - 1];

        if ($page_no)
            return Redirect::to(route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]) . "?page=$page_no");
        else
            return Redirect::to(route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]));
    }

    public function renderArticles($date, $topic, $slug)
    {
        $latestPublishedInitiative = $this->publishedInitiativeService->getLatestById($this->initiativeId, $date);
        $articles = $latestPublishedInitiative->articles->where('language', config("settings.language." . app()->getLocale()));
        $article = $this->articleService->getArticleBySlug($slug);
        $relatedArticles = $this->articleService->getRelatedArticles($article);

        $topics = [];

        foreach ($articles as $a) {
            $topics[] = $a->topic;
        }

        $topics = array_unique($topics);

        usort($topics, function ($a, $b) {
            return $a->id - $b->id;
        });

        $sortedArticles = [];

        foreach ($topics as $topic) {
            foreach ($articles as $a) {
                if ($a->topic === $topic) {
                    $sortedArticles[] = $a;
                }
            }
        }

        $articles = $sortedArticles;

        $noteAvailable = Note::where("user_id", Auth::user()->id)->count() > 0 ? true : false;

        return View('pages.news-today', [
            "topics" => $topics,
            "articles" => $articles,
            "article" => $article,
            "totalArticles" => count($articles),
            "noteAvailable"  => $noteAvailable,
            "baseUrl" => url('news-today') . "/" . $date,
            "relatedArticles" => $relatedArticles
        ]);
    }

    public function archive()
    {
        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive"
        ]);
    }
}
