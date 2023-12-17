<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicSubSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section_id'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(TopicSection::class, 'section_id');
    }

}
