<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Student extends User
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'email_verified_at',
        'password',
        'is_disabled',
        'remember_token'
    ];

    public function readHistories()
    {
        return $this->hasMany(ReadHistory::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
