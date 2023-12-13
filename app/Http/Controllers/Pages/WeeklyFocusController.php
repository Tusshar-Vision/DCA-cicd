<?php

namespace App\Http\Controllers\Pages;

use App\Actions\Contents;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


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

        $article_no = 1;
        if ($page_no = request()->query('page')) {
            $article_no = $page_no;
            $article = $this->articles[$article_no - 1];
        } else  $article = $this->articles[0];

        $article_slug = $article->slug;
        $publishedAt = Carbon::parse($article->published_at)->format('Y-m-d');
        $article_topic = $article->topic->name;

        if ($page_no)
            return Redirect::to(route('weekly-focus.article', ['date' => $publishedAt, 'topic' => $article_topic, 'article_slug' => $article_slug]) . "?page=$page_no");
        else
            return Redirect::to(route('weekly-focus.article', ['date' => $publishedAt, 'topic' => $article_topic, 'article_slug' => $article_slug]));
    }

    public function renderArticles($date, $topic, $article_slug, Contents $contents)
    {

        $this->getData();

        $article = $this->articleService->getArticleBySlug($article_slug);
        $relatedArticles = $this->articleService->getRelatedArticles($article);

        $noteAvailable = null;
        $note = null;

        if (Auth::check()) {
            $noteAvailable = Note::where("user_id", Auth::user()->id)->where('article_id', $article->id)->count() > 0 ? true : false;
            $note = Note::where("user_id", Auth::user()->id)->where('article_id', $article->id)->first();
        }

        $article->content = $contents->fromText($article->content)->getHandledText();
        $tableOfContent = $contents->getContentsArray();

        return View('pages.weekly-focus', [
            "publishedDate" => $this->latestWeeklyFocus->published_at,
            "articles" => $this->articles,
            "article" => $article,
            "totalArticles" => count($this->articles),
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "baseUrl" => url('weekly-focus') . "/" . $date,
            "relatedArticles" => $relatedArticles,
            "tableOfContent" => $tableOfContent
        ]);
    }

    protected function getData($publishedAt = null)
    {
        $this->latestWeeklyFocus = $this->publishedInitiativeService->getLatestById($this->initiativeId);
        $this->articles = $this->latestWeeklyFocus->articles->where('language', config("settings.language." . app()->getLocale()));
    }


    public function archive()
    {
        return View('pages.archives.weekly-focus', [
            "title" => "Weekly Focus Archive"
        ]);
    }
}
