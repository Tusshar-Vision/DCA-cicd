<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    protected $fillable = ['content'];

    public function article(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
