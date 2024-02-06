<?php

namespace App\Services;

use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class DownloadService
{
    public function __construct(
        private Media $media,
        private PublishedInitiative $publishedInitiative
    ) {
    }

    public function getLatest(int $limit = 6): Collection|array
    {
        return $this->publishedInitiative
            ->isPublished()
            ->latest()
            ->has('media')
            ->with('media')
            ->limit($limit)
            ->get();
    }

    public function getMains365($year, $month): Collection|array
    {
        $query =  $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.Mains365'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getPT365($year, $month): Collection|array
    {
        $query = $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.PT365'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $result = $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

        return $result;
    }

    public function getEconomicSurvey($year, $month): Collection|array
    {
        $query =  $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.EconomicSurvey'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        return $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getBudget($year, $month): Collection|array
    {
        $query =  $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.Budget'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        return  $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getValueAddedMaterial($year, $month): Collection|array
    {
        $query =  $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.ValueAddedMaterial'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        return $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getValueAddedMaterialOptional($year, $month): Collection|array
    {
        $query = $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.ValueAddedMaterialOptional'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        return $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }

    public function getQuarterlyRevisionDocument($year, $month): Collection|array
    {
        $query = $this->media->where('mime_type', 'application/pdf')
            ->where('collection_name', '=', config('settings.media_collections_type.QuarterlyRevisionDocument'));

        if ($year) $query->whereYear('created_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        return $query->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });
    }
}
