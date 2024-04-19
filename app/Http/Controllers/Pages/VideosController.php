<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function __construct(
        public MediaService $mediaService
    ) {
    }
    public function index()
    {
        $allVideos = $this->mediaService->getAllVideos();

        return View('pages.videos', [
            'allVideos' => $allVideos
        ]);
    }
}
