<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\DownloadService;
use App\Services\MediaService;
use App\Services\UserService;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly ArticleService $articleService,
        private readonly MediaService $mediaService,
        private readonly DownloadService $downloadService,
        private readonly UserService $userService
    ) {
    }
    public function index()
    {
        $featuredArticles = $this->articleService->getFeatured(10);
        $latestNewsArticles = $this->articleService->getLatestNews();
        $latestVideos = $this->mediaService->getLatestVideos();
        $latestDownloads = $this->downloadService->getLatestDownloads();
        $scoreBoard = $this->userService->getScoreBoard();

        return View('pages.home', [
            'featuredArticles' => $featuredArticles,
            'latestNewsArticles' => $latestNewsArticles,
            'latestVideos' => $latestVideos,
            'latestDownloads' => $latestDownloads,
            'scoreBoard' => $scoreBoard
        ]);
    }
}
