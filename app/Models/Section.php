<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function tableOfContents()
    {
        return $this->belongsTo(TableOfContents::class);
    }
}
