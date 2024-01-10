<?php

namespace App\DTO;

use App\Models\Article;
use App\Models\User;
use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email
    )
    {}

    public static function fromModel(User $user): self
    {
        return new self(
            $user->id,
            $user->name,
            $user->email,
        );
    }
}
