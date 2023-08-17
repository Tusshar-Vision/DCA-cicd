<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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
    ];

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

    public function tableOfContents()
    {
        return $this->hasOne(TableOfContents::class);
    }
}
