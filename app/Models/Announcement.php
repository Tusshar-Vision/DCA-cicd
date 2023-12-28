<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'is_visible',
        'content',
        'published_at',
        'visible_till',
        'user_id',
        'deleted_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'visible_till' => 'datetime'
    ];

    public function author(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function scopeIsVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

}
