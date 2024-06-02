<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class PublishedInitiative extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, HasTags;

    protected $fillable = [
        'initiative_id',
        'name',
        'published_at',
        'publication_date',
        'language_id',
        'is_published',
        'initiative_topic_id',
        'topic_section_id',
        'topic_sub_section_id',
        'infographics_id',
        'video_id',
        'sources',
        'references'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'publication_date' => 'date',
        'is_published' => 'bool',
        'sources' => 'array',
        'references' => 'array',
    ];

    public function initiative(): BelongsTo
    {
        return $this->belongsTo(Initiative::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class)->where('is_short', false);
    }

    public function shortArticles(): HasMany
    {
        return $this->hasMany(Article::class)->where('is_short', true);
    }

    /**
     * Scope a query to group records by the year they were published.
     *
     * @param Builder $query
     * @param string $column
     * @return Collection
     */
    public function scopeGroupByYear(Builder $query, string $column = 'published_at'): Collection
    {
        return $query->get()->groupBy(function ($item) use ($column) {
            return $item->{$column}?->format('Y');
        });
    }

    /**
     * Builder method to fetch and group records by the month they were published.
     *
     * @param  Builder  $query
     * @return Collection
     */
    public static function scopeGroupByMonth(Builder $query): Collection
    {
        return $query->get()->groupBy(function ($item) {
            return $item->published_at->format('F Y');
        });
    }

    public static function scopeGroupByYearAndMonth(Builder $query): Collection
    {
        return $query->get()->groupBy(function ($item) {
            // First group by year
            return $item->published_at->format('Y');
        })->map(function ($yearGroup) {
            // Then within each year group, group by month
            return $yearGroup->groupBy(function ($item) {
                return $item->published_at->format('F');
            });
        });
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
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

    public function infographic(): BelongsTo
    {
        return $this->belongsTo(Infographic::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function scopeHasPublishedArticle(Builder $query): Builder
    {
        return $query->whereHas('articles', function ($query) {
            $query->currentStatus('Published');
        });
    }

    public function scopeLanguage(Builder $query): Builder
    {
        return $query->where('language_id', config("settings.language." . app()->getLocale()));
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
