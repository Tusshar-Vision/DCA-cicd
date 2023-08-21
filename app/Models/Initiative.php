<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function publishedVersions()
    {
        return $this->hasMany(PublishedInitiative::class, 'initiative_id');
    }
}
