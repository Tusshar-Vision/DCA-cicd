<?php

namespace App\Services;

use App\Models\Infographic;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class MediaService
{
    public function __construct(
        private Media $media,
        private Infographic $infographic,
        private Video $video
    )
    {}

    public function getLatestDownloads(int $limit = 6): Collection|array {
        return $this->media->where('mime_type', 'application/pdf')->latest()->limit($limit)->get();
    }

    public function getLatestVideos(int $limit = 2): Collection|array {
        return $this->video->latest()->with('media')->limit($limit)->get();
    }

    public function getAllInfographics($limit): Collection|array  {
        return $this->infographic->latest()->limit($limit)->get();
    }
}
