<?php

namespace App\View\Components\Widgets;

use App\Services\NotificationService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HighlightsSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $announcements;
    public $newsUpdates;

    public function __construct(
        private readonly NotificationService $notificationService
    )
    {
        $this->announcements = $this->notificationService->getAnnouncementsForToday();
        $this->newsUpdates = $this->notificationService->getNewsUpdatesForToday();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.highlights-sidebar');
    }
}
