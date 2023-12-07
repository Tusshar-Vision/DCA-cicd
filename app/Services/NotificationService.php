<?php

namespace App\Services;

use App\Helpers\InitiativesHelper;
use App\Models\Announcement;
use App\Models\Article;

class NotificationService
{
    public function __construct(
        private readonly Announcement $announcement,
        private readonly Article $article
    )
    {}

    public function getAnnouncementsForToday($limit = 3)
    {
        return $this->announcement->isVisible()->latest()->limit($limit)->get();
    }

    public function getNewsUpdatesForToday($limit = 6)
    {
        return $this->article
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID('NEWS_TODAY'))
            ->isPublished()
            ->latest()
            ->limit($limit)
            ->get(['title', 'slug']);
    }
}
