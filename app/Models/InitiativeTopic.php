<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InitiativeTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function paper(): BelongsTo
    {
        return $this->belongsTo(Paper::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(TopicSection::class, 'topic_id');
    }
}
