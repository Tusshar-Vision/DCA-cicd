<?php

namespace App\DTO;

use App\Models\PublishedInitiative;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NewsTodayDTO extends Data
{
    public function __construct(
        public string $name,
        public bool $is_published,
        #[DataCollectionOf(ArticleDTO::class)]
        public DataCollection $articles,
        public string $published_at,
        public string $created_at,
        public string $updated_at
    )
    {}

    public static function fromModel(PublishedInitiative $publishedInitiative)
    {
        return new self(
            $publishedInitiative->name,
            $publishedInitiative->is_published,
            ArticleDTO::collection($publishedInitiative->articles),
            $publishedInitiative->published_at,
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at
        );
    }
}
