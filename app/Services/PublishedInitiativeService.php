<?php

namespace App\Services;

use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PublishedInitiativeService
{
    public function __construct(
        private readonly PublishedInitiative $publishedInitiatives
    ) {
    }

    public function getLatestById($initiativeId, $date = null)
    {
        $query = $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId);
        // The is_published check will be enabled once the publish flow from the admin panel is working
//            ->where('is_published', '=', true)
//            ->whereHas('articles', function ($articleQuery) {
//                    $articleQuery->where('is_published', '=', true);
//            });

        if ($date) {
            $query->whereDate('published_at', $date);
        }

        return $query->latest('published_at')
            ->limit(1)
            ->with('articles', function ($article) {
                $article->with('topic');
            })->first();
    }

    public function getByMonthAndYear($initiativeId, $date)
    {
        $year =  Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;

        $magazines = $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->where('is_published', '=', true)
            ->whereRaw("YEAR(published_at) = $year && MONTH(published_at) = $month")
            ->latest('published_at')
            ->with('articles', function ($article) {
                $article->with('topic');
            })
            ->first();

        return $magazines;
    }

    public function getDownloads($initiative_id, $year = null, $month = null) : array | Collection
    {
        $query = $this->publishedInitiatives->where('initiative_id', '=', $initiative_id)->where('is_published', '=', true);

        if ($year) {
            $query->whereRaw("YEAR(published_at) = $year");
        }

        return $query->with('media')->groupByYear();
    }
}
