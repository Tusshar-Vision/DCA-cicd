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
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));
        // ->has('media');

        $years = $query->get()
            ->groupBy(function ($item) {
                return $item->published_at->format('Y');
            })->keys();

        logger("yeas", [$years]);

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        // $query->with('media');

        // $data = $query->select(
        //     DB::raw('YEAR(published_at) as year'),
        //     DB::raw('MONTHNAME(published_at) as month'),
        //     // DB::raw('WEEK(published_at) as week'),
        //     // 'articles.slug',
        //     // 'articles.title',
        //     // 'articles.published_at',
        //     // 'initiative_topics.name'
        // )
        //     // ->leftJoin('initiative_topics', 'articles.initiative_topic_id', '=', 'initiative_topics.id')
        //     ->groupBy('')
        //     ->orderBy('year')
        //     ->orderBy('month')
        //     // ->orderBy('week')
        //     ->get();

        $data = $query->select(DB::raw('YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as cnt'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        logger("dataa");
        logger($data);

        $organizedData = [];

        foreach ($data as $item) {
            $year = $item->year;
            $month = $item->month;
            $week = "Week " . $item->week;

            $organizedData[$year][$month][$week][] = [
                // 'slug' => $item->slug,
                // 'title' => $item->title,
                'published_at' => Carbon::parse($item->published_at)->format('Y-m-d'),
                // 'topic' => strtolower($item->name)
            ];
        }

        return $organizedData;
    }

    public function getMains365($year, $month): Collection|array
    {

        $query = $this->publishedInitiative
            ->isPublished()
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::MAINS_365))
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

    public function getPT365($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->isPublished()
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
