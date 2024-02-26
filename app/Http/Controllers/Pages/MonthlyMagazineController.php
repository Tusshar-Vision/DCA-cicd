<?php

namespace App\Http\Controllers\Pages;

use App\Actions\Contents;
use App\DTO\Menu\MainMenuDTO;
use App\DTO\MonthlyMagazineDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use Illuminate\Support\Facades\Auth;


class MonthlyMagazineController extends Controller
{
    private int $initiativeId;
    private MonthlyMagazineDTO $monthlyMagazine;

    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly PublishedInitiative        $publishedInitiatives,
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
                'topic' => $this->monthlyMagazine->articles->first()->topic,
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

        $contents = new Contents();
        $temporaryContent = $contents->fromText($article->content ?? '')->getHandledText();
        $tableOfContent = $contents->getContentsArray();

        if (!empty($tableOfContent)) {
            $article->content = $temporaryContent;
        }

        return View('pages.monthly-magazine', [
            "publishedDate" => $this->monthlyMagazine->publishedAt,
            "articles" => $this->monthlyMagazine,
            "article" => $article,
            "topics" => $this->monthlyMagazine->topics,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "sortedArticlesWithTopics" => $this->monthlyMagazine->sortedArticlesWithTopic,
            "tableOfContent" => $tableOfContent,
            "isArticleBookmarked" => $isArticleBookmarked,
        ]);
    }

    public function archive()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $query = $this->publishedInitiatives
            ->whereInitiative(config('settings.initiatives.MONTHLY_MAGAZINE'))
            ->isPublished();


        $years = $query->orderByDesc('published_at')->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $articles = $query->with('articles.topic')
            ->orderByDesc('published_at')
            ->groupByYear();

        $data = [];

        foreach ($articles as $year => $groupedInitiatives) {
            $publishedInitiatives = [];

            foreach ($groupedInitiatives as $initiative) {
                $publishedInitiatives[] = MainMenuDTO::fromArray($initiative);
            }
            $data[$year] = $publishedInitiatives;
        }

        // $data = collect($data);
        $data = json_encode($data);



        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives",
            'data' => [$years, $data]
        ]);
    }
}
