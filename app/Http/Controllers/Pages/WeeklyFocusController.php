<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
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

        $article_slug = $this->articles[0]->slug;
        $article_topic = $this->articles[0]->topic->name;

        return redirect()->route('weekly-focus.article', ['topic' => $article_topic, 'article_slug' => $article_slug]);
    }

    public function renderArticle($topic, $article_slug)
    {

        $this->getData();

        $article = $this->articleService->getArticleBySlug($article_slug);

        return View('pages.weekly-focus', [
            "publishedDate" => $this->latestWeeklyFocus[0]->published_at,
            "articles" => $this->articles,
            "article" => $article,
        ]);
    }

    public function archive()
    {

        return View('pages.archives.weekly-focus', [
            "title" => "Weekly Focus Archive"
        ]);
    }

    protected function getData($publishedAt = null)
    {

        $this->latestWeeklyFocus = $this->publishedInitiativeService->getLatestById($this->initiativeId);

        $this->articles = $this->latestWeeklyFocus[0]->articles;
    }
}
