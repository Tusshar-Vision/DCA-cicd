<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;

class MonthlyMagazineController extends Controller
{
    private int $initiativeId;
    protected $latestMonthlyMagazine;
    protected $articles;
    protected $topics;

    protected  $article_topic;
    protected $article_slug;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly ArticleService $articleService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID('MONTHLY_MAGAZINE');
    }

    public function index()
    {
        $publishedAt = Carbon::now()->format('Y-m');
        $this->getData($publishedAt);

        $this->article_slug = $this->articles[0]->slug;
        $this->article_topic = $this->articles[0]->topic->name;

        return redirect()->route('monthly-magazine.article', ['month' => $publishedAt, 'topic' => $this->article_topic, 'article_slug' => $this->article_slug]);
    }


    public function renderByMonth($month)
    {
        $this->getData($month);
        $this->article_slug = $this->articles[0]->slug;
        $this->article_topic = $this->articles[0]->topic->name;
        return redirect()->route('monthly-magazine.article', ['month' => $month, 'topic' => $this->article_topic, 'article_slug' => $this->article_slug]);
    }

    public function renderArticles($month, $topic, $article_slug)
    {

        $this->getData($month);

        $article = $this->articleService->getArticleBySlug($article_slug);

        return View('pages.monthly-magazine', [
            "publishedDate" => $this->latestMonthlyMagazine->published_at,
            "articles" => $this->articles,
            "article" => $article,
            "topics" => $this->topics
        ]);
    }

    protected function getData($publishedAt = null)
    {
        $this->latestMonthlyMagazine = $this->publishedInitiativeService->getByMonthAndYear($this->initiativeId, $publishedAt);

        $this->articles = $this->latestMonthlyMagazine->articles;

        $this->topics = [];

        foreach ($this->articles as $article) {
            $this->topics[] = $article->topic;
        }

        $this->topics = array_unique($this->topics);

        usort($this->topics, function ($a, $b) {
            return $a->id - $b->id;
        });

        $sortedArticles = [];

        foreach ($this->topics as $topic) {
            foreach ($this->articles as $article) {
                if ($article->topic === $topic) {
                    $sortedArticles[] = $article;
                }
            }
        }

        $this->articles = $sortedArticles;
    }

    public function archive()
    {
        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives"
        ]);
    }
}
