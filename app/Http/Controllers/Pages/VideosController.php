<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
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

        return View('pages.videos.index', [
            'allVideos' => $allVideos
        ]);
    }

    public function renderDailyNews()
    {
        $allVideos = $this->mediaService->getVideos(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY));

        return View('pages.videos.index', [
            'allVideos' => $allVideos
        ]);
    }

    public function renderInConversation()
    {
        $allVideos = $this->mediaService->getAllVideos();

        return View('pages.videos.index', [
            'allVideos' => $allVideos
        ]);
    }

    public function renderSimplifiedByVisionIAS()
    {
        $allVideos = $this->mediaService->getAllVideos();

        return View('pages.videos.index', [
            'allVideos' => $allVideos
        ]);
    }

    public function renderPersonalityInFocus()
    {
        $allVideos = $this->mediaService->getAllVideos();

        return View('pages.videos.index', [
            'allVideos' => $allVideos
        ]);
    }

    public function renderSchemeInFocus()
    {
        $allVideos = $this->mediaService->getAllVideos();

        return View('pages.videos.index', [
            'allVideos' => $allVideos
        ]);
    }
}
