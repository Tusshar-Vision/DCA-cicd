<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Student extends User
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'token'];

    public function readHistories()
    {
        return $this->hasMany(ReadHistory::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
