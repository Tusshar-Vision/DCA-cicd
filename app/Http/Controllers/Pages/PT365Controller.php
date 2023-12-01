<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\PublishedInitiativeService;
use Illuminate\Http\Request;

class PT365Controller extends Controller
{

    private int $initiativeId;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService
    )
    {
        $this->initiativeId = InitiativesHelper::getInitiativeID('PT_365');
    }

    public function index() {

        $downloadableFiles = $this->publishedInitiativeService->getDownloads($this->initiativeId);

        return View('pages.pt-365', [
            "title" => "PT 365",
            'downloadableFiles' => $downloadableFiles
        ]);
    }
}
