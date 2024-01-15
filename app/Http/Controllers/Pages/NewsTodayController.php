<?php

namespace App\Http\Controllers\Pages;

use App\DTO\NewsTodayDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Services\ArticleService;
use App\Services\MediaService;
use App\Services\PublishedInitiativeService;
use Illuminate\Support\Facades\Auth;

class NewsTodayController extends Controller
{
    private int $initiativeId;
    private NewsTodayDTO $newsToday;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly ArticleService $articleService,
        private readonly MediaService $mediaService
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
    public function renderArticle($date, $topic, $slug)
    {
        $this->newsToday = NewsTodayDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );

        $article = $this->newsToday->getArticleFromSlug($slug);
        $relatedArticles = $this->articleService->getRelatedArticles($article);
        $relatedVideos = $this->mediaService->getRelatedVideos($article);

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
            "articles" => $this->newsToday,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "isArticleBookmarked" => $isArticleBookmarked,
            "relatedArticles" => $relatedArticles,
            "relatedVideos" => $relatedVideos
        ]);
    }

    public function getByYearAndMonth()
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $articles = $this->articleService->getByYearAndMonth(config('settings.initiatives.NEWS_TODAY'), $year, $month);
        logger("articles");
        logger($articles);
        return response()->json($articles);
    }

    public function archive()
    {
        $archiveData = $this->articleService->archive(config('settings.initiatives.NEWS_TODAY'));
        logger("archiveData");
        logger($archiveData);

        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive",
            "data" => $archiveData
        ]);
    }
}
