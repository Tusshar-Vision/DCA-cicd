<?php

namespace App\Models;

use App\Traits\HasComments;
use Digikraaft\ReviewRating\Traits\HasReviewRating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use LaracraftTech\LaravelDateScopes\DateScopes;

/**
 * @method isFeatured()
 */

class Article extends Model implements HasMedia, Sortable
{
    use Searchable, InteractsWithMedia, DateScopes, SortableTrait;

    use HasFactory,  HasSlug, HasTags, HasSEO, HasComments,  HasReviewRating,  HasStatuses;

    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'excerpt',
        'read_time',
        'views',
        'visibility',
        'language',
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
        'order_column'
    ];

    protected $casts = [
        'sources' => 'array',
        'is_published' => 'bool',
        'published_at' => 'datetime'
    ];

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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    // Define the relationships with other models

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

    public function content(): HasMany
    {
        return $this->hasMany(ArticleContent::class);
    }

    public function relatedTerms(): HasMany
    {
        return $this->hasMany(RelatedTerm::class);
    }

    public function relatedVideos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function infographics(): HasMany
    {
        return $this->hasMany(Infographic::class);
    }

    public function scopeIsFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->currentStatus('Published');
    }

    public function scopeLanguage(Builder $query): Builder
    {
        return $query->where('language', config("settings.language." . app()->getLocale()));
    }
}
