<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Infographic extends Model implements HasMedia
{
    use Searchable, InteractsWithMedia, HasTags, SoftDeletes;

    protected $fillable = [
        'title',
        'views',
        'language_id',
        'author_id',
        'initiative_topic_id',
        'topic_section_id',
        'topic_sub_section_id'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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

    public function publishedInitiatives(): HasMany
    {
        return $this->hasMany(PublishedInitiative::class);
    }
}
