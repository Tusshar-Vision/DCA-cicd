<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct(private readonly ArticleService $articleService)
    {
    }

    public function index(Request $request)
    {

        $query = $request->get('query');

        $initiative_id = $request->get('initiative');

        $searchResults = $this->articleService->search($query, $initiative_id);

        return View('pages.search', [
            'query' => $query,
            'searchResults' => $searchResults
        ]);
    }
}
