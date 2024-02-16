<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class DownloadService
{
    public function __construct(
        private Media $media,
        private PublishedInitiative $publishedInitiative
    ) {
    }

    public function getLatest(int $limit = 6): Collection|array
    {
        return $this->publishedInitiative
            ->isPublished()
            ->latest()
            ->has('media')
            ->with('media')
            ->limit($limit)
            ->get();
    }

    public function getMains365($year, $month): Collection|array
    {

        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::MAINS_365))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getPT365($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::PT_365))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getEconomicSurvey($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::ECONOMIC_SURVEY))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getBudget($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::BUDGET))
            ->has('media')
            ->with('media');

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getValueAddedMaterial($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getValueAddedMaterialOptional($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL_OPTIONAL))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getQuarterlyRevisionDocument($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::QUARTERLY_REVISION_DOCUMENTS))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getYearEndReviews($year)
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::YEAR_END_REVIEW))
            ->has('media')
            ->with('media');

        if ($year) $query->whereYear('created_at', $year);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }
}
