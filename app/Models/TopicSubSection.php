<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicSubSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section_id'
    ];

}
