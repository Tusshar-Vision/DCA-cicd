<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct(private readonly SearchService $searchService)
    {
    }

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
            ->get()
            ->map(function ($article) {
                $article->url = ArticleService::getArticleURL($article);

                return $article->only(['title', 'url']);
            });

        return response()->json($suggestions);
    }
}
