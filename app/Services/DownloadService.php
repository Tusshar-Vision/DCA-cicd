<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class DownloadService
{
    public function __construct(
        private Media $media
    )
    {}

    public function getLatestDownloads(int $limit = 6): Collection|array {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '!=', 'infographic')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getSingleDownloadFile() {

    }
}
