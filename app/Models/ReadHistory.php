<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadHistory extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'article_id', 'read_percent'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
