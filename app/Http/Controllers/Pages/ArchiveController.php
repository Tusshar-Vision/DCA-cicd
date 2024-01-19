<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\DownloadService;
use App\Services\PublishedInitiativeService;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function __construct(
        private readonly DownloadService $downloadService
    ) {
        //
    }

    public function economicSurvery()
    {

        $medias = $this->downloadService->getArchiveEconomicSurvey();

        return View('pages.archives.economic-survey', [
            "data" => $medias
        ]);
    }
}
