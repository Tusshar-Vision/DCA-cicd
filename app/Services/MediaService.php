<?php

namespace App\Services;

use App\Models\Infographic;
use App\Models\PublishedInitiative;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class MediaService
{
    public function __construct(
        private Media $media,
        private Infographic $infographic,
        private PublishedInitiative $publishedInitiative
    ) {
    }

    public function getLatestDownloads(int $limit = 6): Collection|array
    {
        return $this->media
            ->where('mime_type', 'application/pdf')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getLatestVideos(int $limit = 2): Collection|array
    {
        return $this->publishedInitiative
            ->isPublished()
            ->whereHas('video', function ($query) {
                $query->select('id');
            })
            ->orderByDesc('published_at')
            ->limit($limit)
            ->with(['video' => function ($query) {
                $query->select('id', 'title', 'is_url', 'url');
            }])
            ->get([
                'id', 'name', 'published_at', 'video_id'
            ]);
    }

    public function getAllVideos(int $limit = 9): Collection|array|Paginator
    {
        return $this->publishedInitiative
            ->select([
                'id', 'name', 'published_at', 'video_id'
            ])
            ->isPublished()
            ->whereHas('video', function ($query) {
                $query->select('id');
            })
            ->orderByDesc('published_at')
            ->with(['video' => function ($query) {
                $query->select('id', 'title', 'is_url', 'url');
            }])
            ->simplePaginate($limit);
    }

    public function getVideos($initiativeId, int $limit = 9): Collection|array|Paginator
    {
        return $this->publishedInitiative
            ->whereInitiative($initiativeId)
            ->isPublished()
            ->has('video')
            ->with('video.media')
            ->orderByDesc('published_at')
            ->simplePaginate($limit);
    }

    public function getAllInfographics($limit): Collection|array
    {
        return $this->infographic->latest()->limit($limit)->get();
    }
}
