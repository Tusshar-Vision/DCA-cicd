<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct(private readonly SearchService $searchService)
    {}

    public function index(Request $request)
    {
        $query = $request->get('query');

        $initiative_id = $request->get('initiative');
        $date = $request->get('date');

        $searchResults = $this->searchService->search($query, $initiative_id, $date);

        return View('pages.search', [
            'query' => $query,
            'searchResults' => $searchResults
        ]);
    }

    public function searchQuery($query)
    {
        $suggestions = Article::where('title', 'like', "$query%")
            ->join('initiative_topics', 'articles.initiative_topic_id', '=', 'initiative_topics.id')
            ->join('initiatives', 'articles.initiative_id', '=', 'initiatives.id')
            ->select('articles.title', 'articles.slug', 'articles.published_at', 'initiative_topics.name', 'initiatives.path', DB::raw('DATE_FORMAT(articles.published_at, "%Y-%m-%d") as published_at'))
            ->get();

        return response()->json($suggestions);
    }
}
