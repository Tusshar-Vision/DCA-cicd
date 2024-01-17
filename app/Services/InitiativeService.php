<?php

namespace App\Services;

use App\DTO\Menu\MainMenuDTO;
use App\Enums\Initiatives;
use App\Exceptions\InitiativeNotFoundException;
use App\Helpers\InitiativesHelper;
use App\Models\Initiative;
use App\Models\PublishedInitiative;
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
            Initiatives::MONTHLY_MAGAZINE->name => $this->getMenuDataForMonthlyMagazine($initiativeId),
            Initiatives::WEEKLY_FOCUS->name => $this->getMenuDataForWeeklyFocus($initiativeId),
            Initiatives::MORE->name => $this->getMenuDataForMore($initiativeId),
            default => throw (new InitiativeNotFoundException('Initiative get data function does not exist')),
        };
    }

    protected function getMenuDataForWeeklyFocus($initiativeId): array
    {
        $data = $this->publishedInitiatives
            ->whereInitiative($initiativeId)
            ->isPublished()
            ->with('articles.topic')
            ->hasPublishedArticle()
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
            ->isPublished()
            ->with('articles.topic')
            ->hasPublishedArticle()
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
