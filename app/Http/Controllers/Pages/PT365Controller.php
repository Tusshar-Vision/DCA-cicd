<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\DownloadService;
use App\Services\PublishedInitiativeService;
use Illuminate\Http\Request;

class PT365Controller extends Controller
{

    private int $initiativeId;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService,
        private readonly DownloadService $downloadService

    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::PT_365);
    }

    public function index()
    {

        $downloadableFiles = $this->publishedInitiativeService->getDownloads($this->initiativeId);

        return View('pages.pt-365', [
            "title" => "PT 365",
            'downloadableFiles' => $downloadableFiles
        ]);
    }

    public function archive()
    {

        $medias = $this->downloadService->getArchivePT365();

        // dd($medias);

        return View('pages.archives.pt-365', [
            "title" => "PT 365 Archive",
            "data" => $medias
        ]);
    }
}
