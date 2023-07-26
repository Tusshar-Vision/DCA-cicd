<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSource extends Model
{
    use HasFactory;

    protected $table = 'article_sources';

    protected $fillable = [
        'article_id',
        'sources',
    ];

    protected $casts = [
        'sources' => 'json',
    ];

    // Define the relationship with the 'Article' model
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
