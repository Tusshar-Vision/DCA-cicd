<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\ReadHistory;
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
}
