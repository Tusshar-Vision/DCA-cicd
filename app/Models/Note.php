<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Note extends Model
{
    use HasFactory, HasTags;

    protected $fillable = [
        'user_id',
        'article_id',
        'content',
        'highlight_start_offset',
        'highlight_end_offset',
    ];

    // Define the relationships with other models

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
