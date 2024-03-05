<?php

namespace App\DTO;

use App\Models\Student;
use Spatie\LaravelData\Data;

class StudentDTO extends Data
{
    public function __construct(
        private readonly int|null $id,
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $mobile_number,
        public string|null $email_verified_at
    )
    {}

    public function getID(): int
    {
        return $this->id;
    }

    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function fromModel(Student $student): StudentDTO {
        return new self (
            $student->id,
            $student->first_name,
            $student->last_name,
            $student->email,
            $student->mobile_number,
            $student->email_verified_at
        );
    }

    public static function fromAwsResult($userData): StudentDTO {
        return new self (
            null,
            explode(' ', $userData[2]['Value'])[0],
            explode(' ', $userData[2]['Value'])[1],
            $userData[5]['Value'],
            $userData[4]['Value'],
            null
        );
    }
}
