<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
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

    public function renderMains365($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;


        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::MAINS_365), $year, $month);

        return View('pages.archives.mains-365', [
            "title" => "Mains 365 Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderPT365($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::PT_365), $year, $month);

        return View('pages.archives.pt-365', [
            "title" => "PT 365 Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderEconomicSurvey($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::ECONOMIC_SURVEY), $year, $month);

        return View('pages.archives.economic-survey', [
            "title" => "Economic Survey Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderBudget($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }


        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::BUDGET), $year, $month);

        return View('pages.archives.budget', [
            "title" => "Budget Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderValueAddedMaterial($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }


        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL), $year, $month);

        return View('pages.archives.value-added-material', [
            "title" => "Value Added Material Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderValueAddedMaterialOptional($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }


        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL_OPTIONAL), $year, $month);

        return View('pages.archives.value-added-material-optional', [
            "title" => "Value Added Material Optional Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderQuarterlyRevisionDocument($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::QUARTERLY_REVISION_DOCUMENTS), $year, $month);

        return View('pages.archives.quarterly-revision-document', [
            "title" => "Quarterly Revision Document Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderYearEndReviews($intiative_id = null)
    {
        $year = request()->input('year');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::YEAR_END_REVIEW), $year);

        return View('pages.archives.year-end-reviews', [
            "title" => "Year End Reviews Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderPlanetVision($intiative_id = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        if ($intiative_id) {
            $pdfUrl = $this->downloadService->getDownloadableResourceUrl($intiative_id);
        }

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::PLANET_VISION), $year, $month);

        return View('pages.archives.quarterly-revision-document', [
            "title" => "The Planet Vision",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }
}
