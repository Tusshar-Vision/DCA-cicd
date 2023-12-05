<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\MediaService;
use App\Services\PublishedInitiativeService;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{

    private int $initiativeId;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
    )
    {
        $this->initiativeId = InitiativesHelper::getInitiativeID('DOWNLOADS');
    }

    public function index() {

        $downloadableFiles = $this->publishedInitiativeService->getDownloads();

        return View('pages.downloads', [
            'title' => 'Downloads',
            'downloadableFiles' => $downloadableFiles
        ]);
    }
}
