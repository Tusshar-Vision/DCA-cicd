<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TopicSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'topic_id'
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(InitiativeTopic::class, 'topic_id');
    }

    public function subSection(): HasMany
    {
        return $this->hasMany(TopicSubSection::class, 'section_id');
    }
}
