<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
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
            ->where('initiative_id', '=', $initiativeId)
            ->isPublished()
            ->whereHas('articles', function ($articleQuery) {
                    $articleQuery->isPublished();
            });

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
            ->isPublished()
            ->whereRaw("YEAR(published_at) = $year && MONTH(published_at) = $month")
            ->latest('published_at')
            ->with('articles', function ($article) {
                $article->with('topic');
            })
            ->first();

        return $magazines;
    }

    public function getDownloads($initiative_id = null, $year = null, $month = null) : array | Collection
    {
        if($initiative_id)
            $query = $this->publishedInitiatives->where('initiative_id', '=', $initiative_id)->isPublished();
        else
            $query = $this->publishedInitiatives->whereIn('initiative_id', [
                InitiativesHelper::getInitiativeID(Initiatives::MAINS_365),
                InitiativesHelper::getInitiativeID(Initiatives::PT_365),
                InitiativesHelper::getInitiativeID(Initiatives::DOWNLOADS)
                ])->isPublished();

        if ($year) {
            $query->whereRaw("YEAR(published_at) = $year");
        }

        return $query->with('media')->groupByYear();
    }
}
