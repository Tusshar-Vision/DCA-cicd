<?php

namespace App\DTO\Menu;

use Illuminate\Support\Carbon;
use Livewire\Wireable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class MainMenuDTO extends Data implements Wireable
{
    use WireableData;
    public function __construct(
        public string $name,
        public string $publishedAt,
        public string|null $publicationDate,
        #[DataCollectionOf(SideMenuDTO::class)]
        public DataCollection $article
    ) {
    }

    public static function fromArray($payloads): static
    {
        return new self(
            $payloads['name'],
            $payloads['published_at'] ?? $payloads['publishedAt'],
            $payloads['publication_date'] ?? $payloads['publicationDate'],
            SideMenuDTO::collection($payloads['articles'] ?? $payloads['article'])
        );
    }
}
