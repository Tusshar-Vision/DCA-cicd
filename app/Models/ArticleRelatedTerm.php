<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleRelatedTerm extends Model
{
    protected $table = 'article_related_term';

    protected $fillable = [
        'article_id',
        'related_term_id',
        'order_column'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(RelatedTerm::class, 'related_term_id');
    }
}
