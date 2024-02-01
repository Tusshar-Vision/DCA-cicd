<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\DownloadService;

class DownloadsController extends Controller
{
    public function __construct(
        private readonly DownloadService $downloadService,
    ) {
    }

    public function index()
    {
        return response()->redirectToRoute('monthly-magazine.archive');
    }

    public function renderMains365()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getMains365($year, $month);

        return View('pages.archives.mains-365', [
            "title" => "Mains 365 Archive",
            "data" => $medias
        ]);
    }

    public function renderPT365()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getPT365($year, $month);

        return View('pages.archives.pt-365', [
            "title" => "PT 365 Archive",
            "data" => $medias
        ]);
    }

    public function renderEconomicSurvey()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getEconomicSurvey($year, $month);

        return View('pages.archives.economic-survey', [
            "title" => "Economic Survey Archive",
            "data" => $medias
        ]);
    }

    public function renderBudget()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getBudget($year, $month);

        return View('pages.archives.budget', [
            "title" => "Budget Archive",
            "data" => $medias
        ]);
    }

    public function renderValueAddedMaterial()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getValueAddedMaterial($year, $month);

        return View('pages.archives.value-added-material', [
            "title" => "Value Added Material Archive",
            "data" => $medias
        ]);
    }

    public function renderValueAddedMaterialOptional()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getValueAddedMaterialOptional($year, $month);

        return View('pages.archives.value-added-material-optional', [
            "title" => "Value Added Material Optional Archive",
            "data" => $medias
        ]);
    }

    public function renderQuarterlyRevisionDocument()
    {
        $year = request()->input('year');
        $month = request()->input('month');

        $medias = $this->downloadService->getQuarterlyRevisionDocument($year, $month);

        return View('pages.archives.quarterly-revision-document', [
            "title" => "Quarterly Revision Document Archive",
            "data" => $medias
        ]);
    }
}
