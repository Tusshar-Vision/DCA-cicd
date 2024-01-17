<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedTerm extends Model
{
    protected $fillable = [
        'term',
        'description'
    ];
}
