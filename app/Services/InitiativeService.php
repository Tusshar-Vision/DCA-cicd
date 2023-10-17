<?php

namespace App\Services;

use App\Exceptions\InitiativeNotFoundException;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class InitiativeService {

    public function __construct(protected PublishedInitiative $publishedInitiative)
    {
    }

    /**
     * @throws Throwable
     */
    public function getMenuData(string $initiativeName) : array {
        $initiativeId = InitiativesHelper::getInitiativeID($initiativeName);

        throw_unless($initiativeId, new InitiativeNotFoundException($initiativeName . ' not present in database'));

        return match ($initiativeName) {
            'NEWS_TODAY' => $this->getMenuDataForNewsToday($initiativeId),
            'MONTHLY_MAGAZINE' => $this->getMenuDataForMonthlyMagazine($initiativeId),
            'WEEKLY_FOCUS' => $this->getMenuDataForWeeklyFocus($initiativeId),
            default => throw (new InitiativeNotFoundException('Initiative get data function does not exist')),
        };
    }

    protected function getMenuDataForNewsToday($initiativeId) : array {

        $mainMenuData = PublishedInitiative::where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as published_at')
            ->groupBy('published_at')
            ->limit(10)
            ->get();

        $dateData = $mainMenuData->pluck('published_at')->toArray();

        $combinedData = [];

        foreach ($dateData as $date) {
            $carbonDate = Carbon::createFromFormat('Y-m', $date);
            $combinedData[$date] = $carbonDate->daysInMonth;
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $combinedData
        ];
    }

    protected function getMenuDataForMonthlyMagazine($initiativeId) : array {

        $mainMenuData = PublishedInitiative::where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y") as published_at')
            ->groupBy('published_at')
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        $yearsData = $mainMenuData->pluck('published_at')->toArray();

        $sideDropDownMenuData = PublishedInitiative::where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as published_at')
            ->whereIn(DB::raw('YEAR(published_at)'), $yearsData)
            ->groupBy('published_at')
            ->get()
            ->toArray();

        $combinedData = [];

        foreach ($yearsData as $year) {
            $combinedData[$year] = array_values(array_filter($sideDropDownMenuData, function ($item) use ($year) {
                return str_contains($item['published_at'], $year);
            }));
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $combinedData
        ];
    }

    protected function getMenuDataForWeeklyFocus($initiativeId) : array {

        $mainMenuData = PublishedInitiative::where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as published_at')
            ->groupBy('published_at')
            ->limit(10)
            ->get();

        $dateData = $mainMenuData->pluck('published_at')->toArray();

        $sideDropDownMenuData = Article::where('initiative_id', '=', $initiativeId)
            ->whereIn(DB::raw('DATE_FORMAT(publication_date, "%Y-%m")'), $dateData)
            ->get(['title', 'publication_date'])
            ->toArray();


        $combinedData = [];

        foreach ($dateData as $date) {
            $combinedData[$date] = array_values(array_filter($sideDropDownMenuData, function ($item) use ($date) {
                return str_contains($item['publication_date'], $date);
            }));
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $combinedData
        ];
    }
}
