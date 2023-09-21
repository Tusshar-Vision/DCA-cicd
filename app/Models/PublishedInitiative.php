<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedInitiative extends Model
{
    use HasFactory;

    protected $fillable = [
        'initiative_id',
        'published_at',
        'magazine_pdf_url'
    ];

    public function initiative()
    {
        return $this->belongsTo(Initiative::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }
}
