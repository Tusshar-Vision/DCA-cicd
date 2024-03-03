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
                $query->language()->ordered()->isPublished();
            }])
            ->limit(10)
            ->orderByDesc('published_at')
            ->groupByMonth();

        $menuData = [];

        foreach ($data as $month => $groupedInitiatives) {
            $daysArray = [];

            $totalDays = Carbon::parse($month)->daysInMonth;
            // Loop through each day of the month
            for ($day = 1; $day <= $totalDays; $day++) {
                // Create a Carbon instance for the current date
                $date = Carbon::createFromFormat('d F Y', $day . ' ' . $month);

                // Add the date as a key and the weekday as the value to the array
                $daysArray[$date->format('j')]['day_name'] = $date->format('l');

                $initiatives = $groupedInitiatives->where('published_at', '=', $date->format('Y-m-d') . ' ' . '00:00:00');
                $daysArray[$date->format('j')]['menu'] = collect();
                if ($initiatives->count() !== 0) {
                    $daysArray[$date->format('j')]['menu']->push(MainMenuDTO::fromArray($initiatives->first()));
                }
            }
            $menuData[$month]['diffInDays'] = Carbon::parse($month)->firstOfMonth()->previous(Carbon::SUNDAY)->diffInDays(Carbon::parse($month)->firstOfMonth());
            $menuData[$month]['days'] = $daysArray;
        }

        return $menuData;
    }

    protected function getMenuDataForWeeklyFocus($initiativeId): array
    {
        $data = $this->publishedInitiatives
            ->whereInitiative($initiativeId)
            ->language()
            ->isPublished()
            ->hasPublishedArticle()
            ->with(['articles' => function ($query) {
                // Eager load published articles
                $query->language()->ordered()->isPublished();
            }])
            ->limit(10)
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
            ->hasPublishedArticle()
            ->with(['articles' => function ($query) {
                // Eager load published articles
                $query->language()->ordered()->isPublished();
            }])
            ->limit(10)
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
}
