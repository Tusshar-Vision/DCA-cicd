<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'article_id'];

    // Define the relationships with other models

    public function user()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
