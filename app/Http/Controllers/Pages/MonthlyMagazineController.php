<?php

namespace App\Http\Controllers\Pages;

use App\DTO\MonthlyMagazineDTO;
use App\Enums\Initiatives;
use App\Helpers\ContentsFromHeadersGenerator;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Services\DownloadService;
use App\Services\PublishedInitiativeService;
use Illuminate\Support\Facades\Auth;


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
        $this->monthlyMagazine = MonthlyMagazineDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );

        $article = $this->monthlyMagazine->getArticleFromSlug($slug);

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;


        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0 ? true : false;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            if ($bookmark) $isArticleBookmarked = true;
        }

        $toc['toc'] = [];
        if (!($article->content === '' || $article->content === null))  {
            $contents = new ContentsFromHeadersGenerator();
            $toc = $contents->generateTOC($article->content);

            if (!empty($toc)) {
                $article->content = $toc['updatedHTMLContent'];
            }
        }

        return View('pages.monthly-magazine', [
            "publishedDate" => $this->monthlyMagazine->publishedAt,
            "articles" => $this->monthlyMagazine,
            "article" => $article,
            "topics" => $this->monthlyMagazine->topics,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "sortedArticlesWithTopics" => $this->monthlyMagazine->sortedArticlesWithTopic,
            "tableOfContent" => $toc['toc'],
            "isArticleBookmarked" => $isArticleBookmarked,
        ]);
    }

    public function archive()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $data = $this->downloadService->getMonthlyMagazineArchive($year, $month);

        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives",
            'data' => [$data[0], $data[1]]
        ]);
    }
}
