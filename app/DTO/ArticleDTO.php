<?php

namespace App\DTO;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Support\Collection;
use Livewire\Wireable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ArticleDTO extends Data implements Wireable
{
    use WireableData;
    public function __construct(
        private readonly int $id,
        public string $title,
        public string $topic,
        public string $slug,
        public ?string $excerpt,
        public ?string $content,
        public int $readTime,
        public int               $views,
        public string            $visibility,
        public string            $language,
        public bool              $isFeatured,
        public array|Collection  $tags,
        public array|string|null $sources,
        public ?string        $publishedAt,
        public ?string        $createdAt,
        public ?string        $updatedAt,

        private readonly int  $initiativeID,
        private readonly int  $initiativeTopicID,
        private readonly ?int $topicSectionID,
        private readonly ?int $topicSubSectionID,
        private readonly int  $publishedInitiativeID,
        private readonly int  $author,
        private readonly ?int $reviewer
    ) {}

    public function getID(): int
    {
        return $this->id;
    }

    public function getInitiativeID(): int
    {
        return $this->initiativeID;
    }

    public function getTopicID(): int
    {
        return $this->initiativeTopicID;
    }

    public function getSectionID(): ?int
    {
        return $this->topicSectionID;
    }

    public function getSubSectionID(): ?int
    {
        return $this->topicSubSectionID;
    }

    public static function fromModel(Article $article): self
    {
        return new self(
            $article->id,
            $article->title,
            str_replace(' ', '-', strtolower($article->topic->name)),
            $article->slug,
            $article->excerpt,
            $article->content->content,
            $article->read_time,
            $article->views,
            $article->visibility,
            $article->language,
            $article->featured,
            $article->tags,
            $article->sources,
            $article->published_at,
            $article->created_at,
            $article->updated_at,

            $article->initiative_id,
            $article->initiative_topic_id,
            $article->topic_section_id,
            $article->topic_sub_section_id,
            $article->published_initiative_id,
            $article->author_id,
            $article->reviewer_id,
        );
    }
}
