<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeeklyFocusController extends Controller
{
    private int $initiativeId;
    protected $latestWeeklyFocus;
    protected $articles;

    public function __construct(
        private readonly ArticleService $articleService,
        private readonly PublishedInitiativeService $publishedInitiativeService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID('WEEKLY_FOCUS');
    }

    public function index()
    {

        $this->getData();

        $article = $this->articles[0];
        $article_slug = $article->slug;
        $article_topic = $article->topic->name;
        $publishedAt = Carbon::parse($article->published_at)->format('Y-m-d');

        return redirect()->route('weekly-focus.article', ['date' => $publishedAt, 'topic' => $article_topic, 'article_slug' => $article_slug]);
    }

    public function renderArticles($date, $topic, $article_slug)
    {

        $this->getData();

        $article = $this->articleService->getArticleBySlug($article_slug);

        return View('pages.weekly-focus', [
            "publishedDate" => $this->latestWeeklyFocus->published_at,
            "articles" => $this->articles,
            "article" => $article,
        ]);
    }

    protected function getData($publishedAt = null)
    {
        $this->latestWeeklyFocus = $this->publishedInitiativeService->getLatestById($this->initiativeId);
        $this->articles = $this->latestWeeklyFocus->articles;
    }


    public function archive()
    {

        return View('pages.archives.weekly-focus', [
            "title" => "Weekly Focus Archive"
        ]);
    }
}
