<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


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

        $article_no = 1;
        if($page_no = request()->query('page')) $article_no = $page_no;
        $article = $this->articles[$article_no-1];

        if($page_no) return Redirect::to(route('monthly-magazine.article', ['month' => $month, 'topic' => $article->topic->name, 'article_slug' => $article->slug])."?page=$page_no");
        else return Redirect::to(route('monthly-magazine.article', ['month' => $month, 'topic' => $article->topic->name, 'article_slug' => $article->slug]));
    }

    public function renderArticles($month, $topic, $article_slug)
    {

        $this->getData($month);

        $article = $this->articleService->getArticleBySlug($article_slug);

        return View('pages.monthly-magazine', [
            "publishedDate" => $this->latestMonthlyMagazine->published_at,
            "articles" => $this->articles,
            "article" => $article,
            "topics" => $this->topics,
            "totalArticles" => count($this->articles),
            "baseUrl" => url('monthly-magazine')."/".$month
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
