<?php

namespace App\Models;

use App\DTO\NoteDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\LaravelData\WithData;
use Spatie\Tags\HasTags;

class Note extends Model
{
    use HasTags, Searchable, WithData;

    protected string $dataClass = NoteDTO::class;

    protected $fillable = [
        'user_id',
        'article_id',
        'title',
        'topic_id',
        'topic_section_id',
        'topic_sub_section_id'
    ];

    // Define the relationships with other models

    public function user() : BelongsTo
    {
        return $this->belongsTo(Student::class, 'user_id');
    }

    public function article() : BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function noteContents() : HasMany
    {
        return $this->hasMany(NoteContent::class);
    }


    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
