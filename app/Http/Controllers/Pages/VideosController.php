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
        $videos = $this->mediaService->getLatestVideos(10);

        return View('pages.videos.index', [
            'videos' => $videos,
            'title' => 'Latest Videos'
        ]);
    }

    public function renderDailyNews()
    {
        $videos = $this->mediaService->getVideos(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY));

        return View('pages.videos.daily-news', [
            'videos' => $videos,
            'title' => 'Daily News',
        ]);
    }

    public function renderInConversation()
    {
        $videos = $this->mediaService->getVideos(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));

        return View('pages.videos.in-conversation', [
            'videos' => $videos,
            'title' => 'In-Conversation',
        ]);
    }

    public function renderSimplifiedByVisionIAS()
    {
        $videos = $this->mediaService->getVideos(InitiativesHelper::getInitiativeID(Initiatives::SIMPLIFIED_BY_VISIONIAS));

        return View('pages.videos.simplified', [
            'videos' => $videos,
            'title' => 'Simplified by Vision IAS',
        ]);
    }

    public function renderPersonalityInFocus()
    {
        $videos = $this->mediaService->getVideos(InitiativesHelper::getInitiativeID(Initiatives::PERSONALITY_IN_FOCUS));

        return View('pages.videos.personality-in-focus', [
            'videos' => $videos,
            'title' => 'Personality In Focus',
        ]);
    }

    public function renderSchemeInFocus()
    {
        $videos = $this->mediaService->getVideos(InitiativesHelper::getInitiativeID(Initiatives::SCHEME_IN_FOCUS));

        return View('pages.videos.scheme-in-focus', [
            'videos' => $videos,
            'title' => 'Scheme In Focus',
        ]);
    }
}
