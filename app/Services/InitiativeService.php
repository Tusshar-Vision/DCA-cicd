<?php

namespace App\Services;

use App\Exceptions\InitiativeNotFoundException;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class InitiativeService
{
    public function __construct(
        private readonly PublishedInitiative $publishedInitiatives,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function getMenuData(string $initiativeName): array
    {
        $initiativeId = InitiativesHelper::getInitiativeID($initiativeName);

        throw_unless($initiativeId, new InitiativeNotFoundException($initiativeName . ' not present in database'));

        return match ($initiativeName) {
            'NEWS_TODAY' => $this->getMenuDataForNewsToday($initiativeId),
            'MONTHLY_MAGAZINE' => $this->getMenuDataForMonthlyMagazine($initiativeId),
            'WEEKLY_FOCUS' => $this->getMenuDataForWeeklyFocus($initiativeId),
            default => throw (new InitiativeNotFoundException('Initiative get data function does not exist')),
        };
    }

    protected function getMenuDataForNewsToday($initiativeId): array
    {

        $mainMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as published_at')
            ->groupBy('published_at')
            ->limit(10)
            ->orderByDesc('published_at')
            ->get();

        $dateData = $mainMenuData->pluck('published_at')->toArray();

        $menuData = [];

        foreach ($dateData as $date) {
            $menuData[$date->format('Y-m')] = $date->daysInMonth;
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForMonthlyMagazine($initiativeId): array
    {

        $mainMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y") as published_at')
            ->groupBy('published_at')
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        $yearsData = $mainMenuData->pluck('published_at')->unique()->toArray();

        $sideDropDownMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as published_at')
            ->whereIn(DB::raw('YEAR(published_at)'), $yearsData)
            ->groupBy('published_at')
            ->get()
            ->unique()
            ->toArray();

        $menuData = [];

        foreach ($yearsData as $year) {
            $year = $year->format('Y');
            $menuData[$year] = array_values(array_filter($sideDropDownMenuData, function ($item) use ($year) {
                return str_contains($item['published_at'], $year);
            }));
        }

        $returnData =  [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];

        return $returnData;
    }

    protected function getMenuDataForWeeklyFocus($initiativeId): array
    {
        $mainMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as published_at')
            ->groupBy('published_at')
            ->limit(10)
            ->orderByDesc('published_at')
            ->get();

        $dateData = $mainMenuData->pluck('published_at')->toArray();

        $sideDropDownMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->where('initiative_id', '=', $initiativeId)
            ->with(['articles.topic'])
            ->where(function ($query) use ($dateData) {
                foreach ($dateData as $date) {
                    $query->orWhereYear('published_at', '=', $date->year);
                    $query->orWhereMonth('published_at', '=', $date->month);
                }
            })
            ->get();

        $articles = [];

        foreach ($sideDropDownMenuData as $data) {
            foreach ($data->articles as $article) {
                $articles[] = $article->toArray();
            }
        }

        $menuData = [];

        foreach ($dateData as $date) {
            $date = $date->format('Y-m');
            $menuData[$date] = array_values(array_filter($articles, function ($article) use ($date) {
////                dd($item);
//                return str_contains($article['published_at']->format('Y-m'), $date);
            }));
        }

        $returnData =  [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];

        return $returnData;
    }
}
