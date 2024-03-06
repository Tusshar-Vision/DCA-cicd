<?php

namespace App\DTO;

use App\DTO\Menu\SideMenuDTO;
use Livewire\Wireable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArchiveDTO extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public                            $id,
        public                            $name,
        public                            $publishedAt,
        public Media|MediaCollection|null $media,
        #[DataCollectionOf(SideMenuDTO::class)]
        public DataCollection|null        $article
    ) {}

    public static function fromArray($payloads): ArchiveDTO
    {
        return new self(
            $payloads['id'],
            $payloads['name'],
            $payloads['published_at'],
            $payloads['media'],
            SideMenuDTO::collection($payloads['articles'])
        );
    }
}
