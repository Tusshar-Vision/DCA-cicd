<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paper extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(InitiativeTopic::class, 'paper_topic', 'paper_id', 'initiative_topic_id');
    }
}
