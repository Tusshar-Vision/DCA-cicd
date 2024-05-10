<?php

namespace App\Http\Controllers\Pages;

use App\DTO\WeeklyFocusDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Models\ReadHistory;
use App\Services\DownloadService;
use App\Services\PublishedInitiativeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class WeeklyFocusController extends Controller
{
    private int $initiativeId;
    private WeeklyFocusDTO $weeklyFocus;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly DownloadService $downloadService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
    }

    /**
     * @throws \Throwable
     */
    public function index()
    {
        $this->weeklyFocus = WeeklyFocusDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId)
        );

        //        // Define cache key based on weeklyFocus published date
        //        $cacheKey = 'weekly-focus/' . $this->weeklyFocus->publishedAt;
        //
        //        // Check if the weeklyFocus DTO exists in the cache
        //        if (!Cache::has($cacheKey)) {
        //            // Store the weeklyFocus DTO in the cache for 60 minutes
        //            Cache::put($cacheKey, $this->weeklyFocus, 60);
        //        }

        return redirect()
            ->route(
                'weekly-focus.article',
                [
                    'date' => $this->weeklyFocus->publishedAt,
                    'topic' => $this->weeklyFocus->articles->first()->topic,
                    'article_slug' => $this->weeklyFocus->articles->first()->slug
                ]
            );
    }

    /**
     * @throws \Throwable
     */
    public function renderArticle($date, $topic, $slug)
    {
        $this->hydrateData($date);

        $article = $this->weeklyFocus->getArticleFromSlug($slug);

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

        return View('pages.weekly-focus', [
            "package" => $this->weeklyFocus,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "isArticleBookmarked" => $isArticleBookmarked,
            "isArticleRead" => $isArticleRead,
        ]);
    }

    /**
     * @throws \Throwable
     */
    private function hydrateData($date)
    {
        // Define cache key based on newsToday published date
        //        $weeklyCacheKey = 'weekly-focus/' . $date;
        //
        //        // Check if the newsToday DTO exists in the cache
        //        if (Cache::has($weeklyCacheKey)) {
        //            // Retrieve newsToday DTO from cache
        //            $this->weeklyFocus = Cache::get($weeklyCacheKey);
        //        } else {
        // Create a NewsTodayDTO object from the latest published initiative for the given date
        $this->weeklyFocus = WeeklyFocusDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );

        // Store the newsToday DTO in the cache for 60 minutes
        //            Cache::put($weeklyCacheKey, $this->weeklyFocus, 60);
        //        }
    }

    public function archive()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $data = $this->downloadService->getWeeklyFocusArchive($year, $month);

        return View('pages.archives.weekly-focus', [
            "title" => "Weekly Focus Archive",
            'data' => $data
        ]);
    }
}
