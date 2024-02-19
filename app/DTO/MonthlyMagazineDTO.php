<?php

namespace App\DTO;

use App\DTO\Base\PublishedInitiativeDTO;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MonthlyMagazineDTO extends PublishedInitiativeDTO
{
    public array $topics;
    public Collection $sortedArticlesWithTopic;

    private function sortArticlesWithTopic(): void
    {
        $articlesCollection = collect($this->articles->all());

        $this->sortedArticlesWithTopic = $articlesCollection->groupBy('topic');
    }

    public static function fromModel(PublishedInitiative $publishedInitiative): MonthlyMagazineDTO
    {
        $dto = new MonthlyMagazineDTO(
            $publishedInitiative->name,
            $publishedInitiative->is_published,
            ArticleDTO::collection($publishedInitiative->articles),
            Carbon::parse($publishedInitiative->published_at)->format('Y-m-d'),
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at,
            $publishedInitiative->video?->url
        );

        foreach ($dto->articles as $article) {
            $dto->topics[] = $article->topic;
        }

        $dto->topics = array_unique($dto->topics);
        $dto->sortArticlesWithTopic();

        return $dto;
    }
}
