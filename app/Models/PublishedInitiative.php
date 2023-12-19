<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PublishedInitiative extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'initiative_id',
        'name',
        'published_at',
        'is_published'
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
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
