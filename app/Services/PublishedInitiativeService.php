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

    public function getLatest($initiativeId): PublishedInitiative|null
    {
        return $this->publishedInitiatives
                    ->where('initiative_id', '=', $initiativeId)
                    ->isPublished()
                    ->latest('published_at')
                    ->with('articles', function ($article) {
                        $article->language()->isPublished()->Ordered()->with('topic');
                    })
                    ->first();
    }

    public function getByDate($initiativeId, $date): PublishedInitiative|null
    {
        return $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->isPublished()
            ->whereDate('published_at', '=', Carbon::parse($date)->format('Y-m-d'))
            ->with('articles', function ($article) {
                $article->language()->isPublished()->Ordered()->with('topic');
            })
            ->first();
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
                                ->whereDate(
                                    'published_at',
                                    '=',
                                    Carbon::parse($published_at)->format('Y-m-d')
                                )
                                ->get();

        return $publishedRecords->isNotEmpty();
    }
}
