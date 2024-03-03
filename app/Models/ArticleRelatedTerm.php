<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ArticleRelatedTerm extends Model implements Sortable
{
    use SortableTrait;
    protected $table = 'article_related_term';

    protected $fillable = [
        'article_id',
        'related_term_id',
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

    public function term(): BelongsTo
    {
        return $this->belongsTo(RelatedTerm::class, 'related_term_id');
    }
}
