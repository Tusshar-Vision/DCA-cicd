<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOfContent extends Model
{
    use HasFactory;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
