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
        $this->sortedArticlesWithTopic->transform(function ($topic) {
            // Filter out the short articles but keep the first one
            $shortArticles = $topic->where('is_short', true);
            if ($shortArticles->isNotEmpty()) {
                $firstShortArticle = $shortArticles->first();
                // Update the first short article with custom slug and title
                $firstShortArticle->slug = '/monthly-magazine/' . $this->publishedAt . '/' . $firstShortArticle->topic . '/news-in-shorts';

                // Remove other short articles except the first one
                $topic = $topic->filter(function ($article) use ($firstShortArticle) {
                    return !$article->is_short || $article->getID() === $firstShortArticle->getID();
                });
            }

            return $topic;
        });

        $sortedArticlesWithoutTopic = collect();
        $this->sortedArticlesWithTopic->map(function ($topic) use (&$sortedArticlesWithoutTopic) {
            $sortedArticlesWithoutTopic = $sortedArticlesWithoutTopic->merge($topic->all());
        });

        $this->articles = ArticleDTO::collection($sortedArticlesWithoutTopic);
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

        $articlesCollection = collect($dto->articles->all())->merge($dto->shortArticles->all());
        $dto->sortedArticlesWithTopic = $articlesCollection->groupBy('topic');

        $dto->topics = $dto->sortedArticlesWithTopic->keys()->toArray();
        $dto->sortArticlesWithTopic();

        return $dto;
    }
}
