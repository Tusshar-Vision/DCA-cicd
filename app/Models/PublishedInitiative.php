<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PublishedInitiative extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'initiative_id',
        'published_at',
        'is_published'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($publishedInitiative) {
            if ($publishedInitiative->is_published) {
                $publishedInitiative->published_at = now();
            }
        });
    }

    public function initiative(): BelongsTo
    {
        return $this->belongsTo(Initiative::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
