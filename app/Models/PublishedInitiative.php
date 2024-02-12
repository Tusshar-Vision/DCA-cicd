<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PublishedInitiative extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'initiative_id',
        'name',
        'published_at',
        'language_id',
        'is_published',
        'initiative_topic_id',
        'infographics_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'bool'
    ];

    public function initiative(): BelongsTo
    {
        return $this->belongsTo(Initiative::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Builder method to fetch and group records by the year they were published.
     *
     * @param  Builder  $query
     * @return Collection
     */
    public static function scopeGroupByYear(Builder $query): Collection
    {
        return $query->get()->groupBy(function ($item) {
            return $item->published_at->format('Y');
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
