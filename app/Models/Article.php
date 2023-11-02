<?php

namespace App\Models;

use App\Traits\HasComments;
use Guava\FilamentDrafts\Concerns\HasDrafts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

/**
 * @method isFeatured()
 */

class Article extends Model implements HasMedia
{
    use HasFactory, Searchable, HasSlug, HasTags, HasSEO, HasComments, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'featured_image',
        'excerpt',
        'read_time',
        'views',
        'visibility',
        'language',
        'featured',
        'uuid',
        'published_at',
        'is_published',
        'is_current',
        'publisher_type',
        'publisher_id',
        'created_at',
        'updated_at',
        'author_id',
        'published_initiative_id',
        'initiative_topic_id'
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

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function publishedInitiative(): BelongsTo
    {
        return $this->belongsTo(PublishedInitiative::class, 'published_initiative_id');
    }

    public function getInitiativeIdAttribute()
    {
        if ($this->publishedInitiative) {
            $publishedInitiative = $this->publishedInitiative;
            if ($publishedInitiative->initiative) {
                return $publishedInitiative->initiative->id;
            }
        }
        return null;
    }

    public static function getByInitiativeId($initiativeId): Article|Builder
    {
        return self::whereHas('publishedInitiative', function ($query) use ($initiativeId) {
            $query->whereHas('initiative', function ($query) use ($initiativeId) {
                $query->where('id', $initiativeId);
            });
        });
    }

    public function relatedTerms(): BelongsToMany
    {
        return $this->belongsToMany(RelatedTerm::class);
    }

    public function relatedVideos(): HasMany
    {
        return $this->hasMany(RelatedVideo::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(InitiativeTopic::class, 'initiative_topic_id');
    }

    public function scopeIsFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }
}
