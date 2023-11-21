<?php

namespace App\Services;

use App\Models\PublishedInitiative;
use Carbon\Carbon;

class PublishedInitiativeService
{
    public function __construct(
        private readonly PublishedInitiative $publishedInitiatives
    ) {
    }

    public function getLatestById($initiativeId, $date = null)
    {
        $query =  $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->where('is_published', '=', true);

        if ($date) {
            $query->whereDate('published_at', $date);
        }

        return $query->latest('published_at')
            ->limit(1)
            ->with('articles', function ($article) {
                $article->with('topic');
            })->first();
    }

    public function getByMonthAndYear($initiativeId, $month)
    {
        logger("mongh", [$month]);
        $year =  Carbon::parse($month)->year;
        $month = Carbon::parse($month)->month;

        $magazines = $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->whereRaw("YEAR(published_at) = $year && MONTH(published_at) = $month")
            ->latest('published_at')
            ->with('articles', function ($article) {
                $article->with('topic');
            })
            ->first();

        logger("magaziness", [$magazines]);

        return $magazines;
    }
}
