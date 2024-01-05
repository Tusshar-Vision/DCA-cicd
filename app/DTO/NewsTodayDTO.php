<?php

namespace App\DTO;

use App\Models\PublishedInitiative;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NewsTodayDTO extends Data
{
    public function __construct(
        public string $name,
        public bool $isPublished,

        #[DataCollectionOf(ArticleDTO::class)]
        public DataCollection|null|int $articles,

        public string $publishedAt,
        public string $createdAt,
        public string $updatedAt
    )
    {}

    public function getArticleFromSlug($slug): ArticleDTO
    {
        return $this->articles->where('slug', '=', $slug)->first();
    }

    public function getArticleIndexFromSlug($slug): int|null
    {
        $articles = $this->articles->all();

        foreach ($articles as $index => $article) {
            if ($article->slug === $slug) {
                return $index;
            }
        }

        return null;
    }

    public static function fromModel(PublishedInitiative $publishedInitiative): NewsTodayDTO
    {
        return new self(
            $publishedInitiative->name,
            $publishedInitiative->is_published,
            ArticleDTO::collection($publishedInitiative->articles),
            Carbon::parse($publishedInitiative->published_at)->format('Y-m-d'),
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at
        );
    }
}
