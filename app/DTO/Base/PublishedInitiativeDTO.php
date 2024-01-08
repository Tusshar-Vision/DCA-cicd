<?php

namespace App\DTO\Base;

use App\DTO\ArticleDTO;
use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

abstract class PublishedInitiativeDTO extends Data
{
    public function __construct(
        public string $name,
        public bool $isPublished,
        #[DataCollectionOf(ArticleDTO::class)]
        public DataCollection $articles,
        public string $publishedAt,
        public string $createdAt,
        public string $updatedAt
    ) {}

    public function getArticleFromSlug($slug): ArticleDTO
    {
        return $this->articles->where('slug', '=', $slug)->first();
    }

    public function getArticleIndexFromSlug($slug): int|null
    {
        $foundIndex = null;

        $this->articles->each(function ($article, $index) use ($slug, &$foundIndex) {
            if ($article->slug === $slug) {
                $foundIndex = $index;
                return false; // Stop the iteration once the article is found
            }
        });

        return $foundIndex;
    }

    public static function fromModel(PublishedInitiative $publishedInitiative): PublishedInitiativeDTO
    {
        return new static(
            $publishedInitiative->name,
            $publishedInitiative->is_published,
            ArticleDTO::collection($publishedInitiative->articles),
            Carbon::parse($publishedInitiative->published_at)->format('Y-m-d'),
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at
        );
    }
}
