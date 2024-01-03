<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\InitiativeTopic;
use App\Models\Note;
use App\Models\Paper;
use App\Models\ReadHistory;
use App\Models\TopicSection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $read_histories = Auth::guard('cognito')->user()->readHistories()->join('articles', 'read_histories.article_id', '=', 'articles.id')->select('articles.title', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))->get();

        // content consumption

        // news today
        $newsTodayConsumption = Auth::guard('cognito')->user()->readHistories()->whereHas('article', function ($articleQuery) {
            $articleQuery->where('initiative_id', config('settings.initiatives.NEWS_TODAY'));
        })
            ->select(DB::raw('DAYOFYEAR(article_published_at) as day'), DB::raw('CEIL(AVG(read_percent)) as percent_read'))
            ->groupBy(DB::raw('DAYOFYEAR(article_published_at)'))
            ->get();

        $year = now()->year;
        $numberOfDaysInYear = Carbon::createFromDate($year, 12, 31)->dayOfYear;

        $allDayNumbers = range(1, $numberOfDaysInYear);

        $dayNumbersWithRecords = Article::where('initiative_id', config('settings.initiatives.NEWS_TODAY'))
            ->select(DB::raw('DAYOFYEAR(published_at) as day_number'))
            ->whereYear('published_at', $year)
            ->groupBy(DB::raw('DAYOFYEAR(published_at)'))
            ->get()
            ->pluck('day_number')
            ->toArray();

        $dayNumbersWithoutRecords = array_values(array_diff($allDayNumbers, $dayNumbersWithRecords));

        logger("da", [$dayNumbersWithoutRecords]);

        $newsTodayAverages = array_fill(1, $numberOfDaysInYear, 0);
        $newsTodayConsumption->each(function ($item) use (&$newsTodayAverages) {
            $newsTodayAverages[$item->day] = $item->percent_read;
        });

        foreach ($dayNumbersWithoutRecords as $record) $newsTodayAverages[$record] = null;

        logger("asdf", [$newsTodayAverages]);

        // weekly focus
        $weeklyFocusConsumption = Auth::guard('cognito')->user()->readHistories()->whereHas('article', function ($articleQuery) {
            $articleQuery->where('initiative_id', config('settings.initiatives.WEEKLY_FOCUS'));
        })
            ->select(DB::raw('WEEK(article_published_at, 1) as week'), DB::raw('CEIL(AVG(read_percent)) as percent_read'))
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

        $weeksWithRecords = Article::where('initiative_id', config('settings.initiatives.WEEKLY_FOCUS'))
            ->select(DB::raw('WEEK(published_at, 1) as week'))
            ->groupBy(DB::raw('WEEK(published_at, 1)'))
            ->whereBetween('published_at', [$startDate, $endDate])
            ->get()
            ->pluck('week')
            ->toArray();

        $weeksWithoutRecords = array_values(array_diff($allWeeks, $weeksWithRecords));

        $weeklyAverages = array_fill(1, 52, 0);
        $weeklyFocusConsumption->each(function ($item) use (&$weeklyAverages) {
            $weeklyAverages[$item->week] = $item->percent_read;
        });

        foreach ($weeksWithoutRecords as $record) $weeklyAverages[$record] = null;

        // monthly magazine
        $montlyMagazineConsumption = Auth::guard('cognito')->user()->readHistories()->whereHas('article', function ($articleQuery) {
            $articleQuery->where('initiative_id', config('settings.initiatives.MONTHLY_MAGAZINE'));
        })
            ->select(DB::raw('MONTH(article_published_at) as month'), DB::raw('CEIL(AVG(read_percent)) as percent_read'))
            ->groupBy(DB::raw('MONTH(article_published_at)'))
            ->get();

        $allMonths = range(1, 12);
        $monthsWithRecords = Article::where('initiative_id', config('settings.initiatives.MONTHLY_MAGAZINE'))
            ->select(DB::raw('MONTH(published_at) as month'))
            ->groupBy(DB::raw('MONTH(published_at)'))
            ->get()
            ->pluck('month')
            ->toArray();
        $monthsWithoutRecords = array_diff($allMonths, $monthsWithRecords);

        $monthlyAverages = array_fill(1, 12, 0);
        $montlyMagazineConsumption->each(function ($item) use (&$monthlyAverages) {
            $monthlyAverages[$item->month] = $item->percent_read;
        });

        foreach ($monthsWithoutRecords as $record) $monthlyAverages[$record] = null;

        return view('pages.user.home', ['readHistories' => $read_histories, 'monthly_magazine_consumption' => $monthlyAverages, 'weekly_focus_consumption' => $weeklyAverages, 'news_today_consumption' => $newsTodayAverages]);
    }

    public function updateReadHistory(Request $request)
    {
        $inputs = $request->all();

        $history = ReadHistory::where('article_id', $inputs['article_id'])->where('student_id', $inputs['student_id'])->first();

        if (!$history) ReadHistory::create($inputs);
        return response()->json(['status' => 201]);
    }

    public function bookmarks()
    {
        $bookmarks = Auth::guard('cognito')->user()->bookmarks()->join('articles', 'bookmarks.article_id', '=', 'articles.id')->select('articles.title', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))->get();
        return view('pages.user.bookmarks', ['bookmarks' => $bookmarks]);
    }

    public function addBookmark()
    {
        $inputs =  request()->all();
        $bookmark = Bookmark::where('student_id', Auth::guard('cognito')->user()->id)->where('article_id', $inputs['article_id'])->first();
        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['status' => 201]);
        }
        $bookmark = Bookmark::create($inputs);
        return response()->json(['status' => 201]);
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
                    $articles = Note::where('user_id', Auth::guard('cognito')->user()->id)->where('topic_section_id', $sid)->get();
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

        $notes = Note::search($query)->where('user_id', Auth::guard('cognito')->user()->id)->get();

        // $notes = Note::where('user_id', Auth::guard('cognito')->user()->id)->where('title', 'like', "$query%")
        //     ->join('initiative_topics', 'articles.initiative_topic_id', '=', 'initiative_topics.id')
        //     ->join('initiatives', 'articles.initiative_id', '=', 'initiatives.id')
        //     ->select('articles.title', 'articles.slug', 'articles.published_at', 'initiative_topics.name', 'initiatives.path', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))
        //     ->get();;

        return response()->json($notes);
    }
}
