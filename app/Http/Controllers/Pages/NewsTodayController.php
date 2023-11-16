<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
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

        return redirect()->route('news-today.article', ['topic' => $article_topic, 'article_slug' => $article_slug]);
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
        print_r($articles);
    }
}
