<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaService
{
    public function __construct(
        private readonly Media $media
    )
    {}

    public function getLatestDownloads(int $limit = 6): Collection|array {
        return $this->media->where('mime_type', 'application/pdf')->latest()->limit($limit)->get();
    }

    public function getLatestVideos(int $limit = 2): Collection|array {
        return $this->media->where('mime_type', 'like', 'video%')->latest()->limit($limit)->get();
    }
}
