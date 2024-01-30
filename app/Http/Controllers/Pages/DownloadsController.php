<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\DownloadService;

class DownloadsController extends Controller
{
    public function __construct(
        private readonly DownloadService $downloadService,
    )
    {}

    public function index() {
        return response()->redirectToRoute('monthly-magazine.archive');
    }

    public function renderMains365()
    {
        $medias = $this->downloadService->getMains365();

        return View('pages.archives.mains-365', [
            "title" => "Mains 365 Archive",
            "data" => $medias
        ]);
    }

    public function renderPT365()
    {
        $medias = $this->downloadService->getPT365();

        return View('pages.archives.pt-365', [
            "title" => "PT 365 Archive",
            "data" => $medias
        ]);
    }

    public function renderEconomicSurvey()
    {
        $medias = $this->downloadService->getEconomicSurvey();

        return View('pages.archives.economic-survey', [
            "title" => "Economic Survey Archive",
            "data" => $medias
        ]);
    }

    public function renderBudget()
    {
        $medias = $this->downloadService->getBudget();

        return View('pages.archives.budget', [
            "title" => "Budget Archive",
            "data" => $medias
        ]);
    }

    public function renderValueAddedMaterial()
    {
        $medias = $this->downloadService->getValueAddedMaterial();

        return View('pages.archives.value-added-material', [
            "title" => "Value Added Material Archive",
            "data" => $medias
        ]);
    }

    public function renderValueAddedMaterialOptional()
    {
        $medias = $this->downloadService->getValueAddedMaterialOptional();

        return View('pages.archives.value-added-material-optional', [
            "title" => "Value Added Material Optional Archive",
            "data" => $medias
        ]);
    }

    public function renderQuarterlyRevisionDocument()
    {
        $medias = $this->downloadService->getQuarterlyRevisionDocument();

        return View('pages.archives.quarterly-revision-document', [
            "title" => "Quarterly Revision Document Archive",
            "data" => $medias
        ]);
    }
}
