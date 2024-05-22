<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\DownloadService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function renderMains365(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::MAINS_365), $year, $month);

        return View('pages.archives.mains-365', [
            "title" => "Mains 365 Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderPT365(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::PT_365), $year, $month);

        return View('pages.archives.pt-365', [
            "title" => "PT 365 Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderEconomicSurvey(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::ECONOMIC_SURVEY), $year, $month);

        return View('pages.archives.economic-survey', [
            "title" => "Economic Survey Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderBudget(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::BUDGET), $year, $month);

        return View('pages.archives.budget', [
            "title" => "Budget Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderValueAddedMaterial(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL), $year, $month);

        return View('pages.archives.value-added-material', [
            "title" => "Value Added Material Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderValueAddedMaterialOptional(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL_OPTIONAL), $year, $month);

        return View('pages.archives.value-added-material-optional', [
            "title" => "Value Added Material Optional Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderQuarterlyRevisionDocument(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::QUARTERLY_REVISION_DOCUMENTS), $year, $month);

        return View('pages.archives.quarterly-revision-document', [
            "title" => "Quarterly Revision Document Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderYearEndReviews(Media $media = null)
    {
        $year = request()->input('year');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::YEAR_END_REVIEW), $year);

        return View('pages.archives.year-end-reviews', [
            "title" => "Year End Reviews Archive",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }

    public function renderPlanetVision(Media $media = null)
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $pdfUrl = null;

        $pdfUrl = $media?->getTemporaryUrl(now()->add('minutes', 120));

        $medias = $this
            ->downloadService
            ->getDownloadableResources(InitiativesHelper::getInitiativeID(Initiatives::PLANET_VISION), $year, $month);

        return View('pages.archives.planet-vision', [
            "title" => "The Planet Vision",
            "data" => $medias,
            "pdfUrl" => $pdfUrl
        ]);
    }
}
