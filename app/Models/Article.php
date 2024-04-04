<?php

namespace App\Models;

use App\DTO\ArticleDTO;
use App\Traits\HasComments;
use Digikraaft\ReviewRating\Traits\HasReviewRating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStatus\HasStatuses;
use Spatie\ModelStatus\Status;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use LaracraftTech\LaravelDateScopes\DateScopes;

/**
 * @method isFeatured()
 */

class Article extends Model implements HasMedia, Sortable
{
    use Searchable, InteractsWithMedia, DateScopes, SortableTrait, WithData, SoftDeletes;
    use HasFactory,  HasSlug, HasTags, HasSEO, HasComments,  HasReviewRating,  HasStatuses;

    protected string $dataClass = ArticleDTO::class;

    protected $fillable = [
        'title',
        'short_title',
        'slug',
        'featured_image',
        'excerpt',
        'read_time',
        'views',
        'visibility',
        'featured',
        'published_at',
        'created_at',
        'updated_at',
        'author_id',
        'published_initiative_id',
        'initiative_topic_id',
        'topic_section_id',
        'topic_sub_section_id',
        'reviewer_id',
        'initiative_id',
        'sources',
        'references',
        'order_column',
        'is_short'
    ];

    protected $casts = [
        'sources' => 'array',
        'references' => 'array',
        'published_at' => 'datetime',
        'is_short' => 'bool'
    ];

    protected $with = ['topic', 'statuses'];

    // This method will automatically be called when creating or updating an article.
    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($article) {
            $article->read_time = self::calculateReadingTime($article->content);
        });

        static::updating(function ($article) {
            $article->read_time = self::calculateReadingTime($article->content);
        });
    }

    protected static function booted(): void
    {
        static::retrieved(function ($article) {
            $article->sources = $article->sources ?? [];
            $article->sources = is_string($article->sources) ? explode(',', $article->sources) : $article->sources;

            $article->references = $article->references ?? [];
            $article->references = is_string($article->references) ? explode(',', $article->references) : $article->references;
        });
    }

    // Calculate reading time based on content length and average reading speed
    private static function calculateReadingTime($content, $readingSpeed = 200): int
    {
        $wordCount = str_word_count(strip_tags($content));
        return ceil($wordCount / $readingSpeed);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function shouldBeSearchable(): bool
    {
        return $this->status === 'Published' && $this->publishedInitiative !== null;
    }

    // Define the relationships with other models

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class)->latest();
    }

    public function tableOfContent(): HasOne
    {
        return $this->hasOne(TableOfContent::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function initiative(): BelongsTo
    {
        return $this->belongsTo(Initiative::class, 'initiative_id');
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(InitiativeTopic::class, 'initiative_topic_id');
    }

    public function topicSection(): BelongsTo
    {
        return $this->belongsTo(TopicSection::class, 'topic_section_id');
    }

    public function topicSubSection(): BelongsTo
    {
        return $this->belongsTo(TopicSubSection::class, 'topic_sub_section_id');
    }

    public function publishedInitiative(): BelongsTo
    {
        return $this->belongsTo(PublishedInitiative::class, 'published_initiative_id');
    }

    public function content(): HasOne
    {
        return $this->hasOne(ArticleContent::class);
    }

    public function relatedTerms(): HasMany
    {
        return $this->hasMany(ArticleRelatedTerm::class);
    }

    public function relatedVideos(): HasMany
    {
        return $this->hasMany(RelatedVideo::class);
    }

    public function relatedArticles(): HasMany
    {
        return $this->hasMany(RelatedArticle::class);
    }

    public function relatedToArticle(): HasMany
    {
        return $this->hasMany(RelatedArticle::class, 'related_article_id');
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function readHistories(): HasMany
    {
        return $this->hasMany(ReadHistory::class);
    }

    public function infographics(): HasOne
    {
        return $this->hasOne(Infographic::class);
    }

    public function scopeIsFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->currentStatus('Published');
    }

    public function scopeIsShort(Builder $query): Builder
    {
        return $query->where('is_short', true);
    }

    public function scopeIsNotShort(Builder $query): Builder
    {
        return $query->where('is_short', false);
    }

    public function whereInitiative($initiative_ids): Builder
    {
        // Check if $initiative_ids is an array
        if (is_array($initiative_ids)) {
            return $this->whereIn('initiative_id', $initiative_ids);
        }

        // If it's a single id, use where condition
        return $this->where('initiative_id', '=', $initiative_ids);
    }
}
