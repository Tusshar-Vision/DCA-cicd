<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\InitiativeTopic;
use App\Models\Note;
use App\Models\Paper;
use App\Models\ReadHistory;
use App\Models\TopicSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $read_histories = Auth::guard('cognito')->user()->readHistories()->join('articles', 'read_histories.article_id', '=', 'articles.id')->select('articles.title', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))->get();
        return view('pages.user.home', ['readHistories' => $read_histories]);
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
        // $read_histories = Auth::guard('cognito')->user()->readHistories()->join('articles', 'read_histories.article_id', '=', 'articles.id')->select('articles.title', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))->get();
        return view('pages.user.bookmarks');
    }

    public function addBookmark()
    {
        //
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
}
