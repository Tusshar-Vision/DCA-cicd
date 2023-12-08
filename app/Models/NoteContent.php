<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteContent extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
