<?php

namespace App\Models;

use App\DTO\StudentDTO;
use Illuminate\Foundation\Auth\User;
use Spatie\LaravelData\WithData;

class Student extends User
{
    use WithData;
    protected string $dataClass = StudentDTO::class;

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
