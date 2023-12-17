<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
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
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::PT_365);
    }

    public function index() {

        $downloadableFiles = $this->publishedInitiativeService->getDownloads($this->initiativeId);

        return View('pages.pt-365', [
            "title" => "PT 365",
            'downloadableFiles' => $downloadableFiles
        ]);
    }
}
