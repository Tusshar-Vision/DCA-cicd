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

    public function getLatestById($initiativeId)
    {
        return $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->where('is_published', '=', true)
            ->latest('published_at')
            ->limit(1)
            ->with('articles', function ($article) {
                $article->with('topic');
            })->get();
    }

    public function getByMonthAndYear($month)
    {

        $year =  Carbon::parse($month)->year;
        $month = Carbon::parse($month)->month;
        logger("monthyear", [$year, $month]);

        $magazines = PublishedInitiative::whereYear('published_at', '=', $year)
            ->whereMonth('published_at', '=', 11)
            // ->whereRaw('extract(month from published_at) = ?', ["$month"])
            ->latest('published_at')
            ->with('articles', function ($article) {
                $article->with('topic');
            })
            ->first();

        return $magazines;
    }
}
