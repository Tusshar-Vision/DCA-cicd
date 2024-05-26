<?php

namespace App\Services;

use App\DTO\ArchiveDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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
                $query->select('id')->where('collection_name', '!=', 'article-featured-image');
            })
            ->with(['media' => function ($query) {
                $query->select(
                    'id',
                    'model_type',
                    'model_id',
                    'disk',
                    'file_name',
                    'collection_name'
                )->where('collection_name', '!=', 'article-featured-image');
            }, 'articles' => function ($subQuery) {
                $subQuery->select('slug', 'published_initiative_id', 'order_column')->orderBy('order_column');
            }])
            ->limit($limit)
            ->get(['id', 'initiative_id', 'name']);
    }

    public function getNewsTodayArchive($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->whereInitiative(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->language()
            ->isPublished()
            ->orderBy('published_at', 'desc');

        $years = $query->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $archive = $query->with('articles', function ($query) {
            $query->isPublished()->ordered();
        })->with('media', function ($query) {
            $query->where('collection_name', '=', 'news-today');
        })->groupByYearAndMonth();

        $archiveDTO = $archive->map(function ($yearGroup) {
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

    public function getNewsTodayByYearAndMonth($year, $month)
    {
        return $this->publishedInitiative
            ->whereInitiative(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->language()
            ->isPublished()
            ->whereYear('published_at', $year)
            ->whereMonth('published_at', $month)
            ->with('articles', function ($query) {
                $query->isPublished()->ordered();
            })
            ->with('media', function ($query) {
                $query->where('collection_name', '=', 'news-today');
            })
            ->get()
            ->map(function ($package) {
                $currentArticle = $package->articles?->first();
                $media = $package->media?->first();
                // Select only the desired columns
                return collect([
                    'url' => $currentArticle !== null ?
                                ArticleService::getArticleUrlFromSlug($currentArticle->slug) :
                                route('news-today.archive', ['media' => $media->id]),
                    'formatted_published_at' => Carbon::parse($package->published_at)->format('d M Y'),
                    'media' => ($media !== null ? $media->id : false)
                ]);
            });
    }

    public function getWeeklyFocusArchive($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->whereInitiative(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
            ->language()
            ->isPublished()
            ->orderBy('published_at', 'desc');

        $years = $query->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $data = $query->with('articles', function ($query) {
            $query->isPublished()->ordered();
        })->with('media', function ($query) {
            $query->where('collection_name', '=', 'weekly-focus');
        })->groupByYearAndMonth();

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

    public function getMonthlyMagazineArchive($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
            ->whereInitiative(InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
            ->language()
            ->isPublished()
            ->orderByDesc('published_at');

        $years = $query->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $articles = $query->with('articles', function ($query) {
            $query->isPublished()->ordered();
        })->with('media', function ($query) {
            $query->where('collection_name', '=', 'monthly-magazine');
        })
            ->groupByYear();

        $data = [];

        foreach ($articles as $year => $groupedInitiatives) {
            $publishedInitiatives = [];

            foreach ($groupedInitiatives as $initiative) {
                $publishedInitiatives[] = ArchiveDTO::fromArray($initiative);
            }
            $data[$year] = $publishedInitiatives;
        }

        return [$years, $data];
    }

    public function getDownloadableResources($initiative_id, $year = null, $month = null): Collection|array
    {
        $query = $this->publishedInitiative
            ->whereInitiative($initiative_id)
            ->language()
            ->isPublished()
            ->has('media')
            ->orderBy('published_at', 'desc');

        $years = $query->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->with('media')->groupByYear();

        return [$years, $result];
    }
}
