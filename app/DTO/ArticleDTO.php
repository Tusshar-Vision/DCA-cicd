<?php

namespace App\DTO;

use App\Models\Article;
use Spatie\LaravelData\Data;

class ArticleDTO extends Data
{
    public function __construct(
        private int $id,
        public string $title,
        public string $slug,
        private int $initiativeID,
        private int $initiativeTopicID,
        private ?int $topicSectionID,
        private ?int $topicSubSectionID,
        public ?string $excerpt,
        public ?string $content,
        public int $readTime,
        private int $views,
        private string $visibility,
        public string $language,
        public bool $isFeatured,
        public array|string|null $sources,
        private int $publishedInitiativeID,
        private UserDTO $author,
        private ?UserDTO $reviewer,
        public ?string $publishedAt,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    public static function fromModel(Article $article): self
    {
        return new self(
            $article->id,
            $article->title,
            $article->slug,
            $article->initiative_id,
            $article->initiative_topic_id,
            $article->topic_section_id,
            $article->topic_sub_section_id,
            $article->excerpt,
            $article->content->content,
            $article->read_time,
            $article->views,
            $article->visibility,
            $article->language,
            $article->featured,
            $article->sources,
            $article->published_initiative_id,
            UserDTO::fromModel($article->author),
            ($article->reviewer_id !== null) ? UserDTO::fromModel($article->reviewer) : null,
            $article->published_at,
            $article->created_at,
            $article->updated_at
        );
    }
}
