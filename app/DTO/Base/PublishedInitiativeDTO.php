<?php

namespace App\DTO\Base;

use App\DTO\ArticleDTO;
use App\Exceptions\ArticleNotFoundException;
use App\Models\PublishedInitiative;
use App\Models\Video;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

abstract class PublishedInitiativeDTO extends Data
{
    public function __construct(
        public string                     $name,
        public bool                       $isPublished,
        public int                        $initiative_id,
        #[DataCollectionOf(ArticleDTO::class)]
        public DataCollection             $articles,
        #[DataCollectionOf(ArticleDTO::class)]
        public DataCollection             $shortArticles,
        public string                     $publishedAt,
        public string                     $createdAt,
        public string                     $updatedAt,
        public ?Video                     $video,
        public null|Media                 $media
    ) {
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function getArticleFromSlug($slug): ArticleDTO
    {
        return $this->articles->where('slug', '=', $slug)->first() ?? throw new ArticleNotFoundException('There are no articles');
    }

    public function getShortNewsArticles()
    {
        return $this->shortArticles->first();
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
            $publishedInitiative->initiative->id,
            ArticleDTO::collection($publishedInitiative->articles),
            ArticleDTO::collection($publishedInitiative->shortArticles),
            Carbon::parse($publishedInitiative->published_at)->format('Y-m-d'),
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at,
            $publishedInitiative->video,
            $publishedInitiative->media->first()
        );
    }
}
