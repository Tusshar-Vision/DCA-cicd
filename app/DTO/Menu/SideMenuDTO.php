<?php

namespace App\DTO\Menu;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class SideMenuDTO extends Data
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $topic
    )
    {}

    public static function fromArray($payloads): static
    {
        return new self(
            $payloads['title'],
            $payloads['slug'],
            $payloads['topic']['name']
        );
    }
}
