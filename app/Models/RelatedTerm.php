<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class RelatedTerm extends Model
{
    use Searchable;

    protected $fillable = [
        'term',
        'description'
    ];

    public function relatedArticles(): HasMany
    {
        return $this->hasMany(ArticleRelatedTerm::class);
    }
}
