<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::where('user_id', Auth::user()->id)
            ->where('highlight', '!=', null)->get();
        logger("highiligh", [$highlights]);
        return response()->json(['status' => 200, 'data' => $highlights], 200);
    }

    public function addHighlight(Request $request)
    {
        $inputs = $request->all();
        logger("inputs", [$inputs]);
        $fields = [];
        if ($user_id = Arr::get($inputs, 'user_id')) $fields['user_id'] = $user_id;
        if ($article_id = Arr::get($inputs, 'article_id')) $fields['article_id'] = $article_id;
        if ($highlight = Arr::get($inputs, 'highlight')) $fields['highlight'] = $highlight;
        if ($serializedData = Arr::get($inputs, 'serializedData')) $fields['serialized'] = $serializedData;

        $highlightData = Highlight::create($fields);

        return response()->json(['status' => 200, 'data' => $highlightData], 200);
    }

    public function serializedData($article_id)
    {
        $highlight = Highlight::where("user_id", Auth::user()->id)
            ->where("article_id", '=', $article_id)
            ->latest()
            ->first();

        return response()->json(['status' => 200, 'data' => $highlight], 200);
    }
}
