<?php

namespace App\Http\Controllers\Pages;

use App\DTO\NewsTodayDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Services\ArticleService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NewsTodayController extends Controller
{
    private int $initiativeId;
    protected NewsTodayDTO $newsToday;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly ArticleService $articleService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY);
    }

    /**
     * @throws \Throwable
     */
    public function index()
    {
        $this->newsToday = NewsTodayDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId)
        );

        return redirect()
            ->route(
                'news-today-date-wise.article',
                [
                    'date' => $date,
                    'topic' => $article_topic,
                    'article_slug' => $article_slug
                ]);
    }

    /**
     * @throws \Throwable
     */
    public function getArticlesDateWise($date)
    {
        $latestPublishedInitiative = $this->publishedInitiativeService->getLatest($this->initiativeId, $date);

        $article_no = 1;

        if ($page_no = request()->query('page'))
            $article_no = $page_no;

        $articles = $latestPublishedInitiative->articles;

        if ($articles->isEmpty()) {
            return View('pages.no-news-today');
        }

        $article = $articles[$article_no - 1];

        if ($page_no)
            return Redirect::to(route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]) . "?page=$page_no");
        else
            return Redirect::to(route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]));
    }

    /**
     * @throws \Throwable
     */
    public function renderArticles($date, $topic, $slug)
    {
        $latestPublishedInitiative = $this->publishedInitiativeService->getLatest($this->initiativeId, $date);
        $articles = $latestPublishedInitiative->articles;
        $article = $this->articleService->getArticleBySlug($slug);
        $relatedArticles = $this->articleService->getRelatedArticles($article);

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->id)->count() > 0 ? true : false;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->id)->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->id)->first();
            if ($bookmark) $isArticleBookmarked = true;
        }

        return View('pages.news-today', [
//            "topics" => $topics,
            "articles" => $articles,
            "article" => $article,
            "totalArticles" => count($articles),
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "baseUrl" => url('news-today') . "/" . $date,
            "relatedArticles" => $relatedArticles,
            "isArticleBookmarked" => $isArticleBookmarked
        ]);
    }

    public function archive()
    {
        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive"
        ]);
    }
}
