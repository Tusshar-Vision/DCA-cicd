<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Support\Collection;

readonly class PublishedInitiativeService
{
    public function __construct(
        private PublishedInitiative $publishedInitiatives
    ) {
    }

    public function getLatestById($initiativeId): PublishedInitiative|null
    {
        return $this->publishedInitiatives
                    ->where('initiative_id', '=', $initiativeId)
                    ->latest('published_at')
                    ->with('articles', function ($article) {
                        $article->with('topic');
                    })
                    ->first();
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

    public function checkIfExists($initiative_id, $published_at): bool
    {
        $publishedRecords = $this->publishedInitiatives
                                ->where('initiative_id', '=', $initiative_id)
                                ->whereDate('published_at', '=', $published_at)
                                ->get();

        return $publishedRecords->isNotEmpty();
    }
}
