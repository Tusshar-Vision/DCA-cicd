<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Exceptions\ArticleNotFoundException;
use App\Exceptions\PublishedInitiativeNotFoundException;
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
    protected $articles;

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
        $latestNewsToday = $this->publishedInitiativeService->getLatest($this->initiativeId);

        throw_if(
            $latestNewsToday === null,
            new PublishedInitiativeNotFoundException('There is no latest PublishedInitiative for ' . Initiatives::NEWS_TODAY->value)
        );

        $articles = $latestNewsToday->articles;

        throw_if(
            $articles->isEmpty(),
            new ArticleNotFoundException('There are no articles for ' . Initiatives::NEWS_TODAY->value)
        );

        $article_slug = $articles[0]->slug;
        $article_topic = $articles[0]->topic->name;
        $date =  Carbon::parse($articles[0]->published_at)->format('Y-m-d');

        return redirect()->route('news-today-date-wise.article', ['date' => $date, 'topic' => $article_topic, 'article_slug' => $article_slug]);

    }

    public function getArticlesDateWise($date)
    {
        $latestPublishedInitiative = $this->publishedInitiativeService->getLatestById($this->initiativeId, $date);

        if (!$latestPublishedInitiative) {
            return View('pages.no-news-today');
        }

        $article_no = 1;

        if ($page_no = request()->query('page'))
            $article_no = $page_no;

        $articles = $latestPublishedInitiative->articles->where('language', config("settings.language." . app()->getLocale()));

        if ($articles->isEmpty()) {
            return View('pages.no-news-today');
        }

        $article = $articles[$article_no - 1];

        if ($page_no)
            return Redirect::to(route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]) . "?page=$page_no");
        else
            return Redirect::to(route('news-today-date-wise.article', ['date' => $date, 'topic' => $article->topic->name, 'article_slug' => $article->slug]));
    }

    public function renderArticles($date, $topic, $slug)
    {
        $latestPublishedInitiative = $this->publishedInitiativeService->getLatest($this->initiativeId);
        $articles = $latestPublishedInitiative->articles;
        $article = $this->articleService->getArticleBySlug($slug);
        $relatedArticles = $this->articleService->getRelatedArticles($article);

        $topics = [];

        foreach ($articles as $a) {
            $topics[] = $a->topic;
        }

        $topics = array_unique($topics);

        usort($topics, function ($a, $b) {
            return $a->id - $b->id;
        });

        $sortedArticles = [];

        foreach ($topics as $topic) {
            foreach ($articles as $a) {
                if ($a->topic === $topic) {
                    $sortedArticles[] = $a;
                }
            }
        }

        $articles = $sortedArticles;

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
            "topics" => $topics,
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
