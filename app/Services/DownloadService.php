<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class DownloadService
{
    public function __construct(
        private Media $media
    ) {
    }

    public function getLatestDownloads(int $limit = 6): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '!=', 'infographic')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getArchiveMains365(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', 'mains-365')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getSingleDownloadFile()
    {
    }
}
