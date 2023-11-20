<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsTodayController extends Controller
{
    private int $initiativeId;
    protected $latestNewsToday;
    protected $articles;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly ArticleService $articleService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID('NEWS_TODAY');
    }

    public function index()
    {

        $this->getData();

        $article_slug = $this->articles[0]->slug;
        $article_topic = $this->articles[0]->topic->name;
        $date =  Carbon::parse($this->articles[0]->published_at)->format('Y-m-d');

        return redirect()->route('news-today-date-wise.article', ['date' => $date, 'topic' => $article_topic, 'article_slug' => $article_slug, 'page' => 'home_page']);
    }

    public function renderArticle($topic, $article_slug)
    {

        $this->getData();

        $article = $this->articleService->getArticleBySlug($article_slug);

        return View('pages.news-today', [
            "publishedDate" => $this->latestNewsToday[0]->published_at,
            "articles" => $this->articles,
            "article" => $article,
        ]);
    }

    public function archive()
    {

        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive"
        ]);
    }

    protected function getData($publishedAt = null)
    {

        $this->latestNewsToday = $this->publishedInitiativeService->getLatestById($this->initiativeId);

        $this->articles = $this->latestNewsToday[0]->articles;
    }

    public function getArticlesDateWise($date)
    {
        $articles = $this->articleService->getArticlesByDate($date);
        $article = $articles[0];

        return redirect()->route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]);
    }

    public function renderArticles($date, $topic, $slug, $page = null)
    {
        logger("pageee", [$page]);
        $articles = $this->articleService->getArticlesByDate($date);
        $article = $articles[0];

        $topics = [];

        foreach ($articles as $article) {
            $topics[] = $article->topic;
        }

        $topics = array_unique($topics);

        usort($topics, function ($a, $b) {
            return $a->id - $b->id;
        });

        $sortedArticles = [];

        foreach ($topics as $topic) {
            foreach ($articles as $article) {
                if ($article->topic === $topic) {
                    $sortedArticles[] = $article;
                }
            }
        }

        $articles = $sortedArticles;

        return View('pages.news-today', [
            "date_wise_page" => true,
            "topics" => $topics,
            "articles" => $articles,
            "article" => $article,
        ]);
    }
}
