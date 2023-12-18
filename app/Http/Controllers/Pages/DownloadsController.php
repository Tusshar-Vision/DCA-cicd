<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\PublishedInitiativeService;

class DownloadsController extends Controller
{

    private int $initiativeId;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
    )
    {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::DOWNLOADS);
    }

    public function index() {

        $downloadableFiles = $this->publishedInitiativeService->getDownloads();

        return View('pages.downloads', [
            'title' => 'Downloads',
            'downloadableFiles' => $downloadableFiles
        ]);
    }
}
