<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
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
            ->language()
            ->latest()
            ->has('media')
            ->with('media')
            ->limit($limit)
            ->get();
    }

    public function getWeeklyFocusArchive($year, $month): Collection|array
    {

        $query = $this->publishedInitiative
            ->isPublished()
            ->hasPublishedArticle()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));
        // ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $query->with('media');

        $data = $query->select(
            DB::raw('YEAR(published_at) as year'),
            DB::raw('MONTH(published_at) as month'),
            DB::raw('COUNT(*) as article_count'),
            'published_initiatives.name as published_initiative_name',
            'published_initiatives.id as id'
        )
            ->groupBy('year', 'month', 'published_initiative_name', 'id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $organizedData = [];

        foreach ($data as $item) {
            $year = $item->year;
            $month = $item->month;

            $organizedData[$year][$month][] = [
                'name' => $item->published_initiative_name,
                'id' => $item->id,
            ];
        }

        return [$years, $organizedData];
    }

    public function getMains365($year, $month): Collection|array
    {

        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::MAINS_365))
            ->has('media')
            ->orderBy('published_at', 'desc');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getPT365($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::PT_365))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getEconomicSurvey($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::ECONOMIC_SURVEY))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getBudget($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::BUDGET))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getValueAddedMaterial($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getValueAddedMaterialOptional($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL_OPTIONAL))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getQuarterlyRevisionDocument($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::QUARTERLY_REVISION_DOCUMENTS))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }

    public function getYearEndReviews($year)
    {
        $query = $this->publishedInitiative
            ->isPublished()
            ->language()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::YEAR_END_REVIEW))
            ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        $query->with('media');

        if ($year) $query->whereYear('published_at', $year);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            });

        return [$years, $result];
    }
}
