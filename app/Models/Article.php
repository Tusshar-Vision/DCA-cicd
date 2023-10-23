<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @method isFeatured()
 */

class Article extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'content',
        'publication_date',
        'url_slug',
        'featured_image',
        'excerpt',
        'read_time',
        'views',
        'likes',
        'status',
        'visibility',
        'language',
        'seo_meta_title',
        'seo_meta_description',
        'canonical_url',
        'featured',
        'rating',
        'last_updated',
        'tag_id',
        'comment_id',
        'author_id',
        'initiative_id',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    // Define the relationships with other models

    public function tag()
    {
        return $this->belongsTo(ArticleTag::class, 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function initiative()
    {
        return $this->belongsTo(Initiative::class, 'initiative_id');
    }

    public function publishedInitiative() {
        return $this->belongsTo(PublishedInitiative::class, 'published_initiative_id');
    }

    public function tableOfContents()
    {
        return $this->hasOne(TableOfContents::class);
    }

    public function relatedTerms()
    {
        return $this->belongsToMany(RelatedTerm::class);
    }

    public function relatedTags()
    {
        return $this->hasMany(RelatedTag::class);
    }

    public function relatedVideos()
    {
        return $this->hasMany(RelatedVideo::class);
    }

    public function topic()
    {
        return $this->belongsTo(InitiativeTopic::class, 'initiative_topic_id');
    }

    public function scopeIsFeatured(Builder $query) {
        return $query->where('featured', true);
    }
}
