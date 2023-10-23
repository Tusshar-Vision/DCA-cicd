<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(ArticleService $articleService) {

        $featuredArticles = $articleService->getFeatured();

        return View('pages.home', [
            'featuredArticles' => $featuredArticles
        ]);
    }
}
