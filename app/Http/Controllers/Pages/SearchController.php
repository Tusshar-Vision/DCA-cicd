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
    {}

    public function index(Request $request)
    {
        $query = $request->get('query');
        $limit = 20;

        $initiative_id = $request->get('initiative');
        $date = $request->get('date');

        $searchResults = $this->searchService->search($query, $limit, $initiative_id, $date);

        return View('pages.search', [
            'query' => $query,
            'searchResults' => $searchResults
        ]);
    }

    public function searchQuery($query, $limit = 5)
    {
        $suggestions = $this->searchService->search($query, $limit)->map(function ($article) {
            $article->url = '';
            if (config('app.env') === 'production') {
                $article->url .= config('app.prefix_url');
            }
            $article->url .= ArticleService::getArticleURL($article);
            return $article->only(['title', 'url']);
        });

        return response()->json($suggestions);
    }
}
