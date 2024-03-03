<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class RelatedArticle extends Model implements Sortable
{
    use SortableTrait;
    protected $table = 'related_articles';

    protected $fillable = [
        'article_id',
        'related_article_id',
        'order_column'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order_column', 'asc');
        });
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function relatedArticle(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'related_article_id')->where('is_short', false);
    }
}
