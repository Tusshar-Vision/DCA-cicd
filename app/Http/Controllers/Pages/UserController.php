<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\InitiativeTopic;
use App\Models\Note;
use App\Models\Paper;
use App\Models\ReadHistory;
use App\Models\Student;
use App\Models\TopicSection;
use App\Services\ArticleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private Student $student;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->student = Auth::guard('cognito')->user();

            return $next($request);
        });
    }
    public function dashboard()
    {
        $read_histories = $this->student->readHistories()->orderBy('updated_at', 'desc')->with('article')->get()->map(function ($history) {
            if (!$history->article) return null;
            $history->title = $history->article->short_title ?? $history->article->title;
            $history->published_at = Carbon::parse($history->article->published_at)->format('Y-m-d');
            $history->url = ArticleService::getArticleUrl($history->article);
            $history->img = $history->article->getFirstMediaUrl("article-featured-image");
            $history->read_at = Carbon::parse($history->updated_at)->format('Y-m-d');

            return $history->only(['title', 'published_at', 'url', 'img', 'read_at']);
        });

        // content consumption

        $year = now()->year;

        // news today
        $newsTodayConsumption = $this->student->readHistories()
            ->whereYear('article_published_at', $year)
            ->whereHas('article', function ($articleQuery) {
                $articleQuery->where('initiative_id', config('settings.initiatives.NEWS_TODAY'));
            })
            ->select(DB::raw('DAYOFYEAR(article_published_at) as day'), DB::raw('COUNT(*) as total_read'))
            ->groupBy(DB::raw('DAYOFYEAR(article_published_at)'))
            ->get();


        $numberOfDaysInYear = Carbon::createFromDate($year, 12, 31)->dayOfYear;

        $allDayNumbers = range(1, $numberOfDaysInYear);

        $dailyArticles = Article::where('initiative_id', config('settings.initiatives.NEWS_TODAY'))
            ->select(DB::raw('DAYOFYEAR(published_at) as day'), DB::raw('COUNT(*) as total_article'))
            ->whereYear('published_at', $year)
            ->groupBy(DB::raw('DAYOFYEAR(published_at)'))
            ->get(['day', 'total_read']);

        $dayNumbersWithRecords = $dailyArticles->pluck('day')->toArray();

        $dayNumbersWithoutRecords = array_values(array_diff($allDayNumbers, $dayNumbersWithRecords));

        $newsTodayAverages = array_fill(1, $numberOfDaysInYear, []);
        $newsTodayConsumption->each(function ($item) use (&$newsTodayAverages) {
            $newsTodayAverages[$item->day]['total_read'] = $item->total_read;
        });

        $dailyArticles->each(function ($item) use (&$newsTodayAverages) {
            $newsTodayAverages[$item->day]['total_article'] = $item->total_article;
        });

        foreach ($dayNumbersWithoutRecords as $record) $newsTodayAverages[$record] = null;

        // weekly focus
        $weeklyFocusConsumption = $this->student->readHistories()
            ->whereYear('article_published_at', $year)
            ->whereHas('article', function ($articleQuery) {
                $articleQuery->where('initiative_id', config('settings.initiatives.WEEKLY_FOCUS'));
            })
            ->select(DB::raw('WEEK(article_published_at, 1) as week'), DB::raw('COUNT(*) as total_read'))
            ->groupBy(DB::raw('WEEK(article_published_at, 1)'))
            ->get();

        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        $allWeeks = [];
        $currentDate = clone $startDate;
        while ($currentDate->lte($endDate)) {
            $allWeeks[] = $currentDate->isoWeek();
            $currentDate->addWeek();
        }

        $weeklyArticleRecords = Article::where('initiative_id', config('settings.initiatives.WEEKLY_FOCUS'))
            ->whereYear('published_at', $year)
            ->select(DB::raw('WEEK(published_at, 1) as week'), DB::raw('COUNT(*) as total_article'))
            ->groupBy(DB::raw('WEEK(published_at, 1)'))
            ->whereBetween('published_at', [$startDate, $endDate])
            ->get(['week', 'total_article']);

        $weeksWithRecords = $weeklyArticleRecords->pluck('week')->toArray();

        $weeksWithoutRecords = array_values(array_diff($allWeeks, $weeksWithRecords));

        $weeklyAverages = array_fill(1, 52, []);
        $weeklyFocusConsumption->each(function ($item) use (&$weeklyAverages) {
            $weeklyAverages[$item->week]['total_read'] = $item->total_read;
        });

        $weeklyArticleRecords->each(function ($item) use (&$weeklyAverages) {
            $weeklyAverages[$item->week]['total_article'] = $item->total_article;
        });

        foreach ($weeksWithoutRecords as $record) $weeklyAverages[$record] = null;

        // monthly magazine
        $montlyMagazineConsumption = $this->student->readHistories()
            ->whereYear('article_published_at', $year)
            ->whereHas('article', function ($articleQuery) {
                $articleQuery->where('initiative_id', config('settings.initiatives.MONTHLY_MAGAZINE'));
            })
            ->select(DB::raw('MONTH(article_published_at) as month'), DB::raw('COUNT(*) as total_read'))
            ->groupBy(DB::raw('MONTH(article_published_at)'))
            ->get();

        $allMonths = range(1, 12);
        $articleRecords = Article::where('initiative_id', config('settings.initiatives.MONTHLY_MAGAZINE'))
            ->whereYear('published_at', $year)
            ->select(DB::raw('MONTH(published_at) as month'), DB::raw('COUNT(*) as total_article'))
            ->groupBy(DB::raw('MONTH(published_at)'))
            ->get(['month', 'total_article']);

        // $collection = collect($articleRecords);
        $monthsWithRecords = $articleRecords->pluck('month')->toArray();

        $monthsWithoutRecords = array_diff($allMonths, $monthsWithRecords);

        $monthlyAverages = array_fill(1, 12, []);
        $montlyMagazineConsumption->each(function ($item) use (&$monthlyAverages) {
            $monthlyAverages[$item->month]['total_read'] = $item->total_read;
        });

        $articleRecords->each(function ($item) use (&$monthlyAverages) {
            $monthlyAverages[$item->month]['total_article'] = $item->total_article;
        });

        foreach ($monthsWithoutRecords as $record) $monthlyAverages[$record] = null;

        return view('pages.user.home', ['readHistories' => $read_histories, 'monthly_magazine_consumption' => $monthlyAverages, 'weekly_focus_consumption' => $weeklyAverages, 'news_today_consumption' => $newsTodayAverages]);
    }

    public function updateReadHistory(Request $request)
    {
        $inputs = $request->all();

        $history = ReadHistory::where('article_id', $inputs['article_id'])->where('student_id', $inputs['student_id'])->first();
        // ReadHistory::updateOrCreate(['article_id' => $inputs['article_id'], 'student_id' => $inputs['student_id']], ['updated_at' => now()]);
        if (!$history) ReadHistory::create($inputs);
        else {
            $history->updated_at = now();
            $history->save();
        }
        return response()->json(['status' => 201]);
    }

    public function searchReadHistory($param)
    {
        $read_histories = $this->student->readHistories()->whereHas('article', function ($articleQuery) use ($param) {
            $articleQuery->where('short_title', 'like', "%$param%")->orWhere('title', 'like', "%$param%");
        })->with('article')->get()->map(function ($history) {
            if (!$history->article) return null;
            $history->title = $history->article->short_title ?? $history->article->title;
            $history->published_at = Carbon::parse($history->article->published_at)->format('Y-m-d');
            $history->url = ArticleService::getArticleUrl($history->article);
            $history->img = $history->article->getFirstMediaUrl("article-featured-image");
            $history->read_at = Carbon::parse($history->updated_at)->format('Y-m-d');

            return $history->only(['title', 'published_at', 'url', 'img', 'read_at']);
        });

        return response()->json(['data' => $read_histories]);
    }

    public function bookmarks()
    {
        $bookmarks = $this->student->bookmarks()->orderBy('created_at', 'desc')->with('article')->get()->map(function ($history) {
            if (!$history->article) return null;
            $history->title =  $history->article->short_title ?? $history->article->title;
            $history->published_at = Carbon::parse($history->article->published_at)->format('Y-m-d');
            $history->url = ArticleService::getArticleUrl($history->article);
            $history->img = $history->article->getFirstMediaUrl("article-featured-image");

            return $history->only(['title', 'published_at', 'url', 'img']);
        });

        return view('pages.user.bookmarks', ['bookmarks' => $bookmarks]);
    }

    public function addBookmark()
    {
        $inputs =  request()->all();
        $bookmark = Bookmark::where('student_id', $this->student->id)->where('article_id', $inputs['article_id'])->first();
        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['status' => 201]);
        }
        $bookmark = Bookmark::create($inputs);
        return response()->json(['status' => 201]);
    }

    public function searchBookmark($param)
    {
        $bookmarks = $this->student->bookmarks()->whereHas('article', function ($articleQuery) use ($param) {
            $articleQuery->where('short_title', 'like', "%$param%")->orWhere('title', 'like', "%$param%");
        })->orderBy('created_at', 'desc')->with('article')->get()->map(function ($history) {
            if (!$history->article) return null;
            $history->title = $history->article->short_title ?? $history->article->title;
            $history->published_at = Carbon::parse($history->article->published_at)->format('Y-m-d');
            $history->url = ArticleService::getArticleUrl($history->article);
            $history->img = $history->article->getFirstMediaUrl("article-featured-image");

            return $history->only(['title', 'published_at', 'url', 'img']);
        });

        return response()->json(['data' => $bookmarks]);
    }

    public function myContent($type = null)
    {
        $papers = null;
        $paper = null;
        $topics = null;
        $topic = null;
        $sections = null;
        $section = null;
        $articles = null;

        if ($type) {
            switch ($type) {
                case 'topics':
                    $pid = request()->input('pid');
                    $paper = Paper::find($pid)->name;
                    $topics = InitiativeTopic::where('paper_id', $pid)->get();
                    break;
                case 'sections':
                    $tid = request()->input('tid');
                    $topicObject = InitiativeTopic::find($tid);
                    $topic = $topicObject->name;
                    $paper = $topicObject->paper->name;
                    $sections = TopicSection::where('topic_id', $tid)->get();
                    logger("sections", [$sections]);
                    break;
                case 'articles':
                    $sid = request()->input('sid');
                    $sectionObject = TopicSection::find($sid);
                    $section = $sectionObject->name;
                    $topicObject = $sectionObject->subject;
                    $topic = $topicObject->name;
                    $paper = $topicObject->paper->name;
                    $articles = Note::where('user_id', $this->student->id)->where('topic_section_id', $sid)->get();
                    break;
                default:
                    break;
            }
        } else {
            $type = 'papers';
            $papers = Paper::all();
        }

        return view('pages.user.my-content', ['type' => $type, 'papers' => $papers, 'paper' => $paper, 'topics' => $topics, 'topic' => $topic, 'sections' => $sections, 'section' => $section, 'articles' => $articles]);
    }

    public function searchNotes(Request $request)
    {
        $query = $request->get('query');

        $notes = Note::search($query)->where('user_id', $this->student->id)->get();

        // $notes = Note::where('user_id', $this->student->id)->where('title', 'like', "$query%")
        //     ->join('initiative_topics', 'articles.initiative_topic_id', '=', 'initiative_topics.id')
        //     ->join('initiatives', 'articles.initiative_id', '=', 'initiatives.id')
        //     ->select('articles.title', 'articles.slug', 'articles.published_at', 'initiative_topics.name', 'initiatives.path', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))
        //     ->get();;

        return response()->json($notes);
    }
}
