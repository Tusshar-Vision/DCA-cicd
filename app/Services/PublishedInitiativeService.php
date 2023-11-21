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

    public function getLatestById($initiativeId, $date)
    {
        return $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->whereDate('published_at', $date)
            ->where('is_published', '=', true)
            ->latest('published_at')
            ->limit(1)
            ->with('articles', function ($article) {
                $article->with('topic');
            })->first();
    }

    public function getByMonthAndYear($month)
    {

        $year =  Carbon::parse($month)->year;
        $month = Carbon::parse($month)->month;

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
