<?php

namespace App\DTO\Menu;

use Illuminate\Support\Carbon;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class SideMenuDTO extends Data implements Wireable
{
    use WireableData;
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
            is_string($payloads['topic']) ? $payloads['topic'] : $payloads['topic']['name']
        );
    }
}
