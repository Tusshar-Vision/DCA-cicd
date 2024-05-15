<?php

namespace App\Services;

use App\DTO\Menu\MainMenuDTO;
use App\Enums\Initiatives;
use App\Exceptions\InitiativeNotFoundException;
use App\Helpers\InitiativesHelper;
use App\Models\Initiative;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Throwable;

readonly class InitiativeService
{
    public function __construct(
        private PublishedInitiative $publishedInitiatives,
        private Initiative $initiative
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
            Initiatives::VIDEOS->name => $this->getMenuDataForVideos($initiativeId),
            default => throw (new InitiativeNotFoundException('Initiative get data function does not exist')),
        };
    }

    protected function getMenuDataForNewsToday($initiativeId): array
    {
        $data = $this->publishedInitiatives
            ->whereInitiative($initiativeId)
            ->language()
            ->isPublished()
            ->hasPublishedArticle()
            ->with(['articles' => function ($query) {
                // Eager load published articles
                $query->isPublished()->ordered();
            }])
            ->orderByDesc('published_at')
            ->groupByYearAndMonth();

        $menuData = [];

        foreach ($data as $year => $months) {
            for ($monthIndex = 1; $monthIndex <= 12; $monthIndex++) {
                // Format the month correctly (e.g., "January", "February", ...)
                $monthName = Carbon::createFromFormat('m', $monthIndex)->format('F');

                // Initialize an empty array for months that don't have any data
                if (!isset($months[$monthName])) {
                    $months[$monthName] = collect();
                }

                $groupedInitiatives = $months[$monthName];
                $daysArray = [];

                $totalDays = Carbon::create($year, $monthIndex)->daysInMonth;
                // Loop through each day of the month
                for ($day = 1; $day <= $totalDays; $day++) {
                    // Create a Carbon instance for the current date
                    $date = Carbon::createFromDate($year, $monthIndex, $day);

                    // Add the date as a key and the weekday as the value to the array
                    $daysArray[$date->format('j')]['day_name'] = $date->format('l');
                    $daysArray[$date->format('j')]['menu'] = collect();

                    // Since we've initialized all months, some might not have initiatives
                    if ($groupedInitiatives->isNotEmpty()) {
                        $initiatives = $groupedInitiatives->where('published_at', $date->format('Y-m-d') . ' 00:00:00');
                        if ($initiatives->count() !== 0) {
                            $daysArray[$date->format('j')]['menu']->push(MainMenuDTO::fromArray($initiatives->first()));
                        }
                    }
                }
                $menuData[$year][$monthName]['diffInDays'] = Carbon::createFromDate($year, $monthIndex)->firstOfMonth()->previous(Carbon::SUNDAY)->diffInDays(Carbon::createFromDate($year, $monthIndex)->firstOfMonth());
                $menuData[$year][$monthName]['days'] = $daysArray;
            }
        }

        return $menuData;
    }

    protected function getMenuDataForWeeklyFocus($initiativeId): array
    {
        $data = $this->publishedInitiatives
            ->whereInitiative($initiativeId)
            ->language()
            ->isPublished()
            ->select(['id', 'name', 'initiative_id', 'published_at'])
            ->hasPublishedArticle()
            ->with(['articles' => function ($query) {
                // Eager load published articles
                $query->isPublished()->ordered();
            }])
            ->orderByDesc('published_at')
            ->groupByMonth();

        $menuData = [];

        foreach ($data as $month => $groupedInitiatives) {
            $publishedInitiatives = [];

            foreach ($groupedInitiatives as $initiative) {
                $publishedInitiatives[] = MainMenuDTO::fromArray($initiative);
            }
            $menuData[$month] = $publishedInitiatives;
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForMonthlyMagazine($initiativeId): array
    {
        $data = $this->publishedInitiatives
            ->whereInitiative($initiativeId)
            ->language()
            ->isPublished()
            ->select(['id', 'name', 'initiative_id', 'published_at'])
            ->hasPublishedArticle()
            ->with(['articles' => function ($query) {
                // Eager load published articles
                $query->isPublished()->ordered();
            }])
            ->orderByDesc('published_at')
            ->groupByYear();

        $menuData = [];

        foreach ($data as $year => $groupedInitiatives) {
            $publishedInitiatives = [];

            foreach ($groupedInitiatives as $initiative) {
                $publishedInitiatives[] = MainMenuDTO::fromArray($initiative);
            }
            $menuData[$year] = $publishedInitiatives;
        }

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForMore($initiativeId): array
    {
        $menuData = $this->initiative
                    ->where(
                        'parent_id',
                        '=',
                        InitiativesHelper::getInitiativeID(Initiatives::MORE))
                    ->orderBy('order_column')
                    ->get()
                    ->pluck('name', 'path');

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }

    protected function getMenuDataForVideos($initiativeId): array
    {
        $menuData = $this->initiative
            ->where(
                'parent_id',
                '=',
                InitiativesHelper::getInitiativeID(Initiatives::VIDEOS))
            ->orderBy('order_column')
            ->get()
            ->pluck('name', 'path');

        return [
            'initiative_id' => $initiativeId,
            'data' => $menuData
        ];
    }
}
