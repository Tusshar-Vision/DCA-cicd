<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RelatedArticle extends Pivot
{
    protected $table = 'related_articles';

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function related(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'related_article_id');
    }
}
