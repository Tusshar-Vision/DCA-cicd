<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'content',
        'published_at',
        'visible',
        'visible_till'
    ];

    public function scopeIsVisible(Builder $query): Builder
    {
        return $query->where('visible', true);
    }

}
