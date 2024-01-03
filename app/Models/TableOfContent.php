<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TableOfContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'handled_text',
        'toc'
    ];

    protected $casts = [
        'toc' => 'json'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
