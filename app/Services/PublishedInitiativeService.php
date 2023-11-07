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
            ->where('is_published', '=', true)
            ->latest('published_at')
            ->limit(1)
            ->with('articles', function ($article) {
                $article->with('topic');
            })->get();
    }
}
