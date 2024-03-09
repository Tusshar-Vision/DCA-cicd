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
            $publishedInitiative->initiative->id,
            ArticleDTO::collection($publishedInitiative->articles),
            ArticleDTO::collection($publishedInitiative->shortArticles),
            Carbon::parse($publishedInitiative->published_at)->format('Y-m-d'),
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at,
            $publishedInitiative->video,
            $publishedInitiative->media->first()
        );

        foreach ($dto->articles as $article) {
            $dto->topics[] = $article->topic;
        }

        $dto->topics = array_unique($dto->topics);
        $dto->sortArticlesWithTopic();

        return $dto;
    }
}
