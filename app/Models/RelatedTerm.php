<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class RelatedTerm extends Model
{
    use Searchable;

    protected $fillable = [
        'term',
        'description'
    ];
}
