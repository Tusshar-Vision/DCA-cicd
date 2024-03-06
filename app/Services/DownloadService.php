<?php

namespace App\Services;

use App\DTO\ArchiveDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
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
                $query->where('collection_name', '!=', 'article-featured-image');
            })
            ->with('media')
            ->limit($limit)
            ->get();
    }

    public function getWeeklyFocusArchive($year, $month): Collection|array
    {
        $query = $this->publishedInitiative
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
            ->orderBy('published_at', 'desc');

        $years = $query->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $data = $query->groupByYearAndMonth();

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

    public function getDownloadableResources($initiative_id, $year = null, $month = null): Collection|array
    {
        $query = $this->publishedInitiative
            ->whereInitiative($initiative_id)
            ->language()
            ->isPublished()
            ->has('media')
            ->with('media')
            ->orderBy('published_at', 'desc');

        $years = $query->groupByYear()->keys();

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->groupByYear();

        return [$years, $result];
    }
}
