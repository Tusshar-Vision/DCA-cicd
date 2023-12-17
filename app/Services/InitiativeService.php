<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Exceptions\InitiativeNotFoundException;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

readonly class InitiativeService
{
    public function __construct(
        private PublishedInitiative $publishedInitiatives,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function getMenuData(Initiatives $initiative): array
    {
        $initiativeId = InitiativesHelper::getInitiativeID($initiative);

        throw_unless($initiativeId, new InitiativeNotFoundException($initiative->name . ' not present in database'));

        return match ($initiative->name) {
            Initiatives::NEWS_TODAY->name => $this->getMenuDataForNewsToday($initiativeId),
            Initiatives::MONTHLY_MAGAZINE->name => $this->getMenuDataForMonthlyMagazine($initiativeId),
            Initiatives::WEEKLY_FOCUS->name => $this->getMenuDataForWeeklyFocus($initiativeId),
            Initiatives::MORE->name => $this->getMenuDataForMore($initiativeId),
            default => throw (new InitiativeNotFoundException('Initiative get data function does not exist')),
        };
    }

    protected function getMenuDataForNewsToday($initiativeId): array
    {
        $mainMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as date')
            ->groupBy('date')
            ->limit(10)
            ->orderByDesc('date')
            ->get();

        $dateData = $mainMenuData->pluck('date')->toArray();

        $menuData = [];

        foreach ($dateData as $date) {
            $menuData[$date] = Carbon::parse($date)->daysInMonth;
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForMonthlyMagazine($initiativeId): array
    {

        $mainMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y") as year')
            ->groupBy('year')
            ->orderByDesc('year')
            ->limit(10)
            ->get();

        $yearsData = $mainMenuData->pluck('year')->toArray();

        $sideDropDownMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as year')
            ->whereIn(DB::raw('DATE_FORMAT(published_at, "%Y")'), $yearsData)
            ->groupBy('year')
            ->get()
            ->toArray();

        $menuData = [];

        foreach ($yearsData as $year) {
            $menuData[$year] = array_values(array_filter($sideDropDownMenuData, function ($item) use ($year) {
                return str_contains($item['year'], $year);
            }));
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForWeeklyFocus($initiativeId): array
    {
        $mainMenuData = $this->publishedInitiatives->where('initiative_id', '=', $initiativeId)
            ->selectRaw('DATE_FORMAT(published_at, "%Y-%m") as date')
            ->groupBy('date')
            ->limit(10)
            ->orderByDesc('date')
            ->get();

        $dateData = $mainMenuData->pluck('date')->toArray();

        $sideDropDownMenuData = $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->with(['articles.topic'])
            ->whereIn(DB::raw('DATE_FORMAT(published_at, "%Y-%m")'), $dateData)
            ->get();

        $articles = [];

        foreach ($sideDropDownMenuData as $data) {
            foreach ($data->articles as $article) {
                $articles[] = $article->toArray();
            }
        }

        $menuData = [];

        foreach ($dateData as $date) {
            $menuData[$date] = array_values(array_filter($articles, function ($article) use ($date) {
                return str_contains(Carbon::parse($article['published_at'])->format('Y-m'), $date);
            }));
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForMore($initiativeId): array
    {

        $menuData = [
            "Economic Survey and Budget",
            "Weekly Round Table",
            "Animated Shorts",
            "PYQs",
            "Value Added Material",
            "Value Added Material Optional"
        ];

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }
}
