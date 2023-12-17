<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Announcement;
use App\Models\Article;

readonly class NotificationService
{
    public function __construct(
        private Announcement $announcement,
        private Article      $article
    )
    {}

    public function getAnnouncementsForToday($limit = 3)
    {
        return $this->announcement->isVisible()->latest()->limit($limit)->get();
    }

    public function getNewsUpdatesForToday($limit = 6)
    {
        return $this->article
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->isPublished()
            ->latest()
            ->limit($limit)
            ->get(['title', 'slug']);
    }
}
