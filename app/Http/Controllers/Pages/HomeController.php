<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly ArticleService $articleService)
    {}
    public function index() {

        $featuredArticles = $this->articleService->getFeatured();
        $latestNewsArticles = $this->articleService->getLatestNews();

        return View('pages.home', [
            'featuredArticles' => $featuredArticles,
            'latestNewsArticles' => $latestNewsArticles
        ]);
    }
}
