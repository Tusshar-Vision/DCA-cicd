<?php

namespace App\Http\Controllers\Pages;

use App\DTO\Menu\NewsTodayMenuDTO;
use App\DTO\NewsTodayDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Services\ArticleService;
use App\Services\InitiativeService;
use App\Services\PublishedInitiativeService;
use App\Services\SuggestionService;
use Illuminate\Support\Facades\Auth;

class NewsTodayController extends Controller
{
    private int $initiativeId;
    private NewsTodayDTO $newsToday;

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
                'news-today.article',
                [
                    'date' => $this->newsToday->publishedAt,
                    'topic' => $this->newsToday->articles->first()->topic,
                    'article_slug' => $this->newsToday->articles->first()->slug
                ]
            );
    }

    /**
     * @throws \Throwable
     */
    public function alsoInNews($date, InitiativeService $initiativeService)
    {
        $this->newsToday = NewsTodayDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );

        $newsTodayCalendar = NewsTodayMenuDTO::fromNewsTodayDTO(
            $this->newsToday,
            $initiativeService->getMenuData(Initiatives::NEWS_TODAY)
        );

        $article = $this->newsToday->getArticleInNews();

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            if ($bookmark) $isArticleBookmarked = true;
        }

        return View('pages.news-today', [
            "articles" => $this->newsToday,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "isArticleBookmarked" => $isArticleBookmarked,
            "newsTodayCalendar" => $newsTodayCalendar,
            "isAlsoInNews" => $article
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function renderArticle($date, $topic, $slug, InitiativeService $initiativeService)
    {
        $this->newsToday = NewsTodayDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );

        $newsTodayCalendar = NewsTodayMenuDTO::fromNewsTodayDTO(
            $this->newsToday,
            $initiativeService->getMenuData(Initiatives::NEWS_TODAY)
        );

        $article = $this->newsToday->getArticleFromSlug($slug);
        $isAlsoInNews = $this->newsToday->getArticleInNews();

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            if ($bookmark) $isArticleBookmarked = true;
        }

        return View('pages.news-today', [
            "articles" => $this->newsToday,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "isArticleBookmarked" => $isArticleBookmarked,
            "newsTodayCalendar" => $newsTodayCalendar,
            "isAlsoInNews" => $isAlsoInNews
        ]);
    }

    public function getByYearAndMonth()
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $articles = $this->articleService->getByYearAndMonth(config('settings.initiatives.NEWS_TODAY'), $year, $month);
        return response()->json($articles);
    }

    public function archive()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $archiveData = $this->articleService->archive(config('settings.initiatives.NEWS_TODAY'), $year, $month);

        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive",
            "data" => $archiveData
        ]);
    }
}
