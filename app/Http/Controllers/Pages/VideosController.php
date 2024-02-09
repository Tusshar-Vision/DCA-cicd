<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function __construct(
        public MediaService $mediaService
    )
    {}
    public function index()
    {
        $latestVideos = $this->mediaService->getLatestVideos(12);

        return View('pages.videos', [
            'latestVideos' => $latestVideos
        ]);
    }
}
