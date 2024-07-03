<?php

namespace App\Http\Controllers\Pages;

use App\DTO\MonthlyMagazineDTO;
use App\Enums\Initiatives;
use App\Helpers\ContentsFromHeadersGenerator;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Models\ReadHistory;
use App\Services\DownloadService;
use App\Services\PublishedInitiativeService;
use Aws\CloudFront\CloudFrontClient;
use Aws\CloudFront\UrlSigner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MonthlyMagazineController extends Controller
{
    private int $initiativeId;
    private MonthlyMagazineDTO $monthlyMagazine;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly DownloadService $downloadService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE);
    }

    /**
     * @throws \Throwable
     */
    public function index()
    {
        $this->monthlyMagazine = MonthlyMagazineDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId)
        );

        //        // Define cache key based on weeklyFocus published date
        //        $cacheKey = 'monthly-magazine/' . $this->monthlyMagazine->publishedAt;
        //
        //        // Check if the monthlyMagazine DTO exists in the cache
        //        if (!Cache::has($cacheKey)) {
        //            // Store the monthlyMagazine DTO in the cache for 60 minutes
        //            Cache::put($cacheKey, $this->monthlyMagazine, 60);
        //        }

        return redirect()->route(
            'monthly-magazine.article',
            [
                'date' => $this->monthlyMagazine->publishedAt,
                'topic' => str_replace('&', 'and', $this->monthlyMagazine->articles->first()->topic),
                'article_slug' => $this->monthlyMagazine->articles->first()->slug
            ]
        );
    }

    /**
     * @throws \Throwable
     */
    public function renderArticle($date, ?string $topic = null, ?string $slug = null)
    {
        $this->hydrateData($date);
        $article = $this->monthlyMagazine->getArticleFromSlug($slug);
        $article->loadContent();

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;
        $isArticleRead = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0 ? true : false;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            if ($bookmark) $isArticleBookmarked = true;
            $readHistory = ReadHistory::where(
                'student_id', Auth::guard('cognito')->user()->id
                )
                ->where('article_id', $article->getID())
                ->where('read_percent', '=', '100')
                ->first();
            if ($readHistory) $isArticleRead = true;
        }

        $toc['toc'] = [];
        if (!($article->content === '' || $article->content === null)) {
            $contents = new ContentsFromHeadersGenerator();
            $toc = $contents->generateTOC($article->content);

            if (!empty($toc)) {
                $article->content = $toc['updatedHTMLContent'];
            }
        }

        return View('pages.monthly-magazine', [
            "package" => $this->monthlyMagazine,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "tableOfContent" => $toc['toc'],
            "isArticleBookmarked" => $isArticleBookmarked,
            "isArticleRead" =>  $isArticleRead,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function newsInShorts($date, string $topic)
    {
        $this->hydrateData($date);
        $article = $this->monthlyMagazine->getShortNewsArticles($topic);

        $this->monthlyMagazine->shortArticles->where('topic', $topic)->map(function ($shortArticle) {
            $shortArticle->loadContent();
        });

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;
        $isArticleRead = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0 ? true : false;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            if ($bookmark) $isArticleBookmarked = true;
            $readHistory = ReadHistory::where(
                'student_id', Auth::guard('cognito')->user()->id
                )
                ->where('article_id', $article->getID())
                ->where('read_percent', '=', '100')
                ->first();
            if ($readHistory) $isArticleRead = true;
        }

        $toc['toc'] = [];

        return View('pages.monthly-magazine', [
            "package" => $this->monthlyMagazine,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "tableOfContent" => $toc['toc'],
            "isArticleBookmarked" => $isArticleBookmarked,
            "isArticleRead" =>  $isArticleRead,
        ]);
    }

    /**
     * @throws \Throwable
     */
    private function hydrateData($date)
    {
        // Define cache key based on newsToday published date
        //        $monthlyCacheKey = 'monthly-magazine/' . $date;
        //
        //        // Check if the newsToday DTO exists in the cache
        //        if (Cache::has($monthlyCacheKey)) {
        //            // Retrieve newsToday DTO from cache
        //            $this->monthlyMagazine = Cache::get($monthlyCacheKey);
        //        } else {
        // Create a NewsTodayDTO object from the latest published initiative for the given date
        $this->monthlyMagazine = MonthlyMagazineDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );
        //
        //            // Store the newsToday DTO in the cache for 60 minutes
        //            Cache::put($monthlyCacheKey, $this->monthlyMagazine, 60);
        //        }
    }

    public function archive(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getUrl();

        $data = $this->downloadService->getMonthlyMagazineArchive($year, $month);

        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives",
            'data' => [$data[0], $data[1]],
            "pdfUrl" => $pdfUrl
        ]);
    }
}
