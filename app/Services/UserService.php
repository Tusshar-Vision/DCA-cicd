<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserScore;

class UserService
{
    public function __construct(
        private readonly User $users,
        private readonly UserScore $userScores
    )
    {}

    public function getScoreBoard($limit = 5) {
        return $this->userScores->orderBy('score', 'desc')->with('user')->limit($limit)->get();
    }
}
