<?php

namespace App\Services;

use App\Models\Infographic;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class MediaService
{
    public function __construct(
        private Media $media,
        private Infographic $infographic
    )
    {}

    public function getLatestDownloads(int $limit = 6): Collection|array {
        return $this->media->where('mime_type', 'application/pdf')->latest()->limit($limit)->get();
    }

    public function getLatestVideos(int $limit = 2): Collection|array {
        return $this->media->where('mime_type', 'like', 'video%')->latest()->limit($limit)->get();
    }

    public function getAllInfographics() {
        return $this->infographic->latest()->limit(10)->get();
    }
}
