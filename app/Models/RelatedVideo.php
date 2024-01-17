<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RelatedVideo extends Pivot
{
    protected $table = 'article_video_relation';

    protected $fillable = [
        'article_id',
        'video_id',
        'order_column'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
