<?php

namespace App\Services;

use App\DTO\ArchiveDTO;
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
        private PublishedInitiative $publishedInitiative
    ) {
    }

    public function getLatest(int $limit = 6): Collection|array
    {
        return $this->publishedInitiative
            ->isPublished()
            ->language()
            ->latest()
            ->whereHas('media', function ($query) {
                $query->where('collection_name', '!=', 'article-featured-image');
            })
            ->with('media')
            ->limit($limit)
            ->get();
    }

    public function getWeeklyFocusArchive($year, $month): Collection|array
    {
        $data = $this->publishedInitiative
            ->whereInitiative(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
            ->language()
            ->isPublished()
            ->hasPublishedArticle()
            ->with('articles', function ($query) {
                $query->isPublished()->ordered();
            })
            ->with('media', function ($query) {
                $query->where('collection_name', '=', 'weekly-focus');
            })
            ->orderBy('published_at', 'desc')
            ->groupByYearAndMonth();

        $years = $data->keys();

        if ($year) $data->whereYear('published_at', $year);
        if ($month) $data->whereMonth('published_at', $month);

        $archiveDTO = $data->map(function ($yearGroup) {
            return $yearGroup->map(function ($monthGroup) {
                return $monthGroup->map(function ($item) {
                    return ArchiveDTO::fromArray([
                        'id' => $item->id,
                        'name' => $item->name,
                        'published_at' => $item->published_at,
                        'media' => $item->media,
                        'articles' => $item->articles // Assuming articles relation is loaded
                    ]);
                });
            });
        });

        return [$years, $archiveDTO];
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
