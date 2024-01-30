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

    public function getLatest(int $limit = 6): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '!=', 'infographic')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getMains365(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.Mains365'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getPT365(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.PT365'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getEconomicSurvey(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.EconomicSurvey'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getBudget(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.Budget'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getValueAddedMaterial(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.ValueAddedMaterial'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getValueAddedMaterialOptional(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.ValueAddedMaterialOptional'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getQuarterlyRevisionDocument(): Collection|array
    {
        return $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.QuarterlyRevisionDocument'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }
}
