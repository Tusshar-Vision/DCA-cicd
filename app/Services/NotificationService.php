<?php

namespace App\Services;

use App\Models\Announcement;

class NotificationService
{
    public function __construct(private readonly Announcement $announcement)
    {}

    public function getAnnouncementsForToday()
    {
        return $this->announcement->isVisible()->get();
    }
}
