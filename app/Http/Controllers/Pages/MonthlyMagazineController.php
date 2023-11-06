<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;

class MonthlyMagazineController extends Controller
{
    private int $initiativeId;
    protected $latestMonthlyMagazine;
    protected $articles;
    protected $topics;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly ArticleService $articleService
    )
    {
        $this->initiativeId = InitiativesHelper::getInitiativeID('MONTHLY_MAGAZINE');
    }

    public function index() {

        $this->getData();

        $article_slug = $this->articles[0]->slug;
        $article_topic = $this->articles[0]->topic->name;

        return redirect()->route('monthly-magazine.article', ['topic' => $article_topic, 'article_slug' => $article_slug]);
    }

    public function renderArticle($topic, $article_slug) {

        $this->getData();

        $article = $this->articleService->getArticleBySlug($article_slug);

        return View('pages.monthly-magazine', [
            "publishedDate" => $this->latestMonthlyMagazine[0]->published_at,
            "articles" => $this->articles,
            "article" => $article,
            "topics" => $this->topics
        ]);
    }

    public function archive() {

        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives"
        ]);
    }

    protected function getData($publishedAt = null) {

        $this->latestMonthlyMagazine = $this->publishedInitiativeService->getLatestById($this->initiativeId);

        $this->articles = $this->latestMonthlyMagazine[0]->articles;

        $this->topics = [];

        foreach ($this->articles as $article) {
            $this->topics[] = $article->topic;
        }

        $this->topics = array_unique($this->topics);

        usort($this->topics, function($a, $b) {
            return $a->id - $b->id;
        });

        $sortedArticles = [];

        foreach ($this->topics as $topic) {
            foreach ($this->articles as $article) {
                if($article->topic === $topic) {
                    $sortedArticles[] = $article;
                }
            }
        }

        $this->articles = $sortedArticles;
    }
}
