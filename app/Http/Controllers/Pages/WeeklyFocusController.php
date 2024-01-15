<?php

namespace App\Http\Controllers\Pages;

use App\Actions\Contents;
use App\DTO\WeeklyFocusDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Note;
use App\Services\ArticleService;
use App\Services\MediaService;
use App\Services\PublishedInitiativeService;
use Illuminate\Support\Facades\Auth;


class WeeklyFocusController extends Controller
{
    private int $initiativeId;
    private WeeklyFocusDTO $weeklyFocus;

    public function __construct(
        private readonly ArticleService $articleService,
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly MediaService $mediaService
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
    public function renderArticle($date, $topic, $slug, Contents $contents)
    {
        $this->weeklyFocus = WeeklyFocusDTO::fromModel(
            $this->publishedInitiativeService
                ->getLatest($this->initiativeId, $date)
        );

        $article = $this->weeklyFocus->getArticleFromSlug($slug);
        $relatedArticles = $this->articleService->getRelatedArticles($article);
        $relatedVideos = $this->mediaService->getRelatedVideos($article);

        $noteAvailable = null;
        $note = null;
        $isArticleBookmarked = false;

        if (Auth::guard('cognito')->check()) {
            $noteAvailable = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->count() > 0;
            $note = Note::where("user_id", Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            $bookmark =  Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $article->getID())->first();
            if ($bookmark) $isArticleBookmarked = true;
        }

        $article->content = $contents->fromText($article->content)->getHandledText();
        $tableOfContent = $contents->getContentsArray();


        return View('pages.weekly-focus', [
            "articles" => $this->weeklyFocus,
            "article" => $article,
            "noteAvailable"  => $noteAvailable,
            "note" => $note,
            "tableOfContent" => $tableOfContent,
            "isArticleBookmarked" => $isArticleBookmarked,
            "relatedArticles" => $relatedArticles,
            "relatedVideos" => $relatedVideos
        ]);
    }

    public function archive()
    {
        return View('pages.archives.weekly-focus', [
            "title" => "Weekly Focus Archive"
        ]);
    }
}
