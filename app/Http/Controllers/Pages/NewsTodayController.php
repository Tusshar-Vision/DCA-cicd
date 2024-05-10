<?php

namespace App\Http\Controllers\Pages;

use App\DTO\Menu\NewsTodayMenuDTO;
use App\DTO\NewsTodayDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Models\ReadHistory;
use App\Services\DownloadService;
use App\Services\InitiativeService;
use App\Services\PublishedInitiativeService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class NewsTodayController extends Controller
{
    private int $initiativeId;
    private NewsTodayDTO $newsToday;
    private NewsTodayMenuDTO $newsTodayCalendar;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly InitiativeService $initiativeService,
        private readonly DownloadService $downloadService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY);
    }

    /**
     * @throws \Throwable
     */
    public function index()
    {
        // Create a NewsTodayDTO object from the latest published initiative
        $this->newsToday = NewsTodayDTO::fromModel(
            $this->publishedInitiativeService->getLatest($this->initiativeId)
        );

        // Define cache key based on newsToday published date
        $cacheKey = 'news-today/' . $this->newsToday->publishedAt;

        // Check if the newsToday DTO exists in the cache
        if (!Cache::has($cacheKey)) {
            // Store the newsToday DTO in the cache for 60 minutes
            Cache::put($cacheKey, $this->newsToday, 60);
        }

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
    public function alsoInNews($date)
    {
        $this->hydrateData($date);

        $article = $this->newsToday->getShortNewsArticles();

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;
        $isArticleRead = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $readHistory = ReadHistory::where(
                'student_id', Auth::guard('cognito')->user()->id
                )
                ->where('article_id', $article->getID())
                ->where('read_percent', '=', '100')
                ->first();
            if ($bookmark) $isArticleBookmarked = true;
            if ($readHistory) $isArticleRead = true;
        }

        return View('pages.news-today', [
            "package" => $this->newsToday,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "isArticleBookmarked" => $isArticleBookmarked,
            "newsTodayCalendar" => $this->newsTodayCalendar,
            "isAlsoInNews" => $article,
            "isArticleRead" => $isArticleRead,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function renderArticle($date, $topic, $slug)
    {
        $this->hydrateData($date);

        $article = $this->newsToday->getArticleFromSlug($slug);
        $isAlsoInNews = $this->newsToday->getShortNewsArticles();

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;
        $isArticleRead = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $readHistory = ReadHistory::where(
                'student_id', Auth::guard('cognito')->user()->id
                )
                ->where('article_id', $article->getID())
                ->where('read_percent', '=', '100')
                ->first();
            if ($bookmark) $isArticleBookmarked = true;
            if ($readHistory) $isArticleRead = true;
        }

        return View('pages.news-today', [
            "package" => $this->newsToday,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "isArticleBookmarked" => $isArticleBookmarked,
            "isArticleRead" => $isArticleRead,
            "newsTodayCalendar" => $this->newsTodayCalendar,
            "isAlsoInNews" => $isAlsoInNews
        ]);
    }

    /**
     * @throws \Throwable
     */
    private function hydrateData($date)
    {
        // Define cache key based on newsToday published date
        $newsCacheKey = 'news-today/' . $date;

        // Check if the newsToday DTO exists in the cache
        if (Cache::has($newsCacheKey)) {
            // Retrieve newsToday DTO from cache
            $this->newsToday = Cache::get($newsCacheKey);
        } else {
            // Create a NewsTodayDTO object from the latest published initiative for the given date
            $this->newsToday = NewsTodayDTO::fromModel(
                $this->publishedInitiativeService->getLatest($this->initiativeId, $date)
            );

            // Store the newsToday DTO in the cache for 60 minutes
            Cache::put($newsCacheKey, $this->newsToday, 60);
        }

        // Define cache key for newsToday calendar based on date
        $calendarCacheKey = 'news-today/calendar/' . $date;

        // Check if the newsToday calendar DTO exists in the cache
        if (Cache::has($calendarCacheKey)) {
            // Retrieve newsToday calendar DTO from cache
            $this->newsTodayCalendar = Cache::get($calendarCacheKey);
        } else {
            // Create a NewsTodayMenuDTO object from newsToday DTO and menu data
            $this->newsTodayCalendar = NewsTodayMenuDTO::fromNewsTodayDTO(
                $this->newsToday,
                $this->initiativeService->getMenuData(Initiatives::NEWS_TODAY)
            );

            // Store the newsToday calendar DTO in the cache for 60 minutes
            Cache::put($calendarCacheKey, $this->newsTodayCalendar, 60);
        }
    }

    public function getByYearAndMonth()
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $articles = $this->downloadService->getNewsTodayByYearAndMonth($year, $month);

        return response()->json($articles);
    }

    public function archive()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $archiveData = $this->downloadService->getNewsTodayArchive($year, $month);

        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive",
            "data" => $archiveData
        ]);
    }
}
