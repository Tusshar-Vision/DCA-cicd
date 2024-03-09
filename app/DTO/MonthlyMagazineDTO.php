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
    private Collection $sortedArticlesWithoutTopic;

    private function sortArticlesWithTopic(): void
    {
        $articlesCollection = collect($this->articles->all())->merge($this->shortArticles->all());
        $this->sortedArticlesWithTopic = $articlesCollection->groupBy('topic');
        $this->sortedArticlesWithoutTopic = collect();

        $this->sortedArticlesWithTopic->map(function ($topic) {
           $this->sortedArticlesWithoutTopic = $this->sortedArticlesWithoutTopic->merge($topic->all());
        });

        $this->articles = ArticleDTO::collection($this->sortedArticlesWithoutTopic);
    }

    public function getArticleIndexFromSlug($slug): int|null
    {
        $foundIndex = null;

        $this->sortedArticlesWithoutTopic->each(function ($article, $index) use ($slug, &$foundIndex) {
            if ($article->slug === $slug) {
                $foundIndex = $index;
                return false; // Stop the iteration once the article is found
            }
        });

        return $foundIndex;
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
