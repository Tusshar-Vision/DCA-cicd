<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelatedArticle extends Model
{
    protected $table = 'related_articles';

    protected $fillable = [
        'article_id',
        'related_article_id',
        'order_column'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function relatedArticle(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'related_article_id');
    }
}
