<?php

namespace App\Services;

use App\Models\PublishedInitiative;

class PublishedInitiativeService
{
    public function __construct(
       private readonly PublishedInitiative $publishedInitiatives
    )
    {}

    public function getLatestById($initiativeId) {
        return $this->publishedInitiatives
            ->where('initiative_id', '=', $initiativeId)
            ->latest()
            ->limit(1)
            ->with('articles')
            ->get();
    }
}
