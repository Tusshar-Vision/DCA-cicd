<?php

namespace App\DTO;

use App\Models\Article;
use Illuminate\Support\Collection;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class ArticleDTO extends Data implements Wireable
{
    use WireableData;
    public function __construct(
        public string                $title,
        public ?string               $shortTitle,
        public string                $topic,
        public string                $slug,
        public ?string               $excerpt,
        public ?string               $content,
        public int                   $readTime,
        public int                   $views,
        public bool                  $isFeatured,
        public int                   $is_short,
        public array|Collection|null $tags,
        public array|Collection|null $relatedTerms,
        public array|Collection|null $relatedArticles,
        public array|Collection|null $relatedVideos,
        public array|string|null     $sources,
        public ?string               $updatedAt,

        public  readonly int         $id,
        private readonly int         $initiativeID,
        private readonly int         $initiativeTopicID,
        private readonly ?int        $topicSectionID,
        private readonly ?int        $topicSubSectionID,
        private readonly int         $publishedInitiativeID,
        private readonly int         $author,
        private readonly ?int        $reviewer,
        private readonly ?Article    $articleInstance
    ) {
    }

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

    public function loadContent(): string
    {
        if (!$this->content) {
            $this->content = $this->loadContentFromDatabase();
            $this->tags = $this->loadTags();
            $this->relatedTerms = $this->loadRelatedTerms();
            $this->relatedArticles = $this->loadRelatedArticles();
            $this->relatedVideos = $this->loadRelatedVideos();
        }
        return $this->content;
    }

    // Method to load content from the database
    private function loadContentFromDatabase(): string
    {
        return $this->articleInstance->content->content ?? '';
    }

    private function loadTags(): Collection
    {
        return $this->articleInstance->tags;
    }

    private function loadRelatedTerms(): Collection
    {
        return $this->articleInstance->relatedTerms;
    }

    private function loadRelatedArticles(): Collection
    {
        return $this->articleInstance->relatedArticles;
    }

    private function loadRelatedVideos(): Collection
    {
        return $this->articleInstance->relatedVideos;
    }

    public static function fromModel(Article $article): self
    {
        return new self(
            $article->title,
            $article->short_title,
            str_replace(' ', '-', strtolower($article->topic->name)),
            $article->slug,
            $article->excerpt,
            '',
            $article->read_time,
            $article->views,
            $article->featured,
            $article->is_short,
            [],
            collect(),
            collect(),
            collect(),
            $article->sources ?? [],
            $article->updated_at,

            $article->id,
            $article->initiative_id,
            $article->initiative_topic_id,
            $article->topic_section_id,
            $article->topic_sub_section_id,
            $article->published_initiative_id,
            $article->author_id,
            $article->reviewer_id,
            $article
        );
    }
}
