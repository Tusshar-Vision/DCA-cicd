<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Announcement;
use App\Models\Article;
use Illuminate\Support\Collection;

readonly class NotificationService
{
    public function __construct(
        private Announcement $announcement,
        private ArticleService $articleService
    )
    {}

    public function getAnnouncementsForToday($limit = 10): Collection
    {
        return $this->announcement->isVisible()->latest()->limit($limit)->get();
    }

    public function getNewsUpdatesForToday(): Collection
    {
        return $this->articleService->getLatestNews(6);
    }
}
