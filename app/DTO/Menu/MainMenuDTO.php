<?php

namespace App\DTO\Menu;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class MainMenuDTO extends Data
{
    public function __construct(
        public string $publishedAt,

        #[DataCollectionOf(SideMenuDTO::class)]
        public DataCollection $article
    ) {}

    public static function fromArray($payloads): static
    {
        return new self(
            $payloads['published_at'],
            SideMenuDTO::collection($payloads['articles'])
        );
    }
}
