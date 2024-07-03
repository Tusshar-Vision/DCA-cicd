<?php

namespace App\Livewire\Widgets;

use App\Services\DownloadService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LatestDownloads extends Component
{
    public $latestDownloads;

    public function mount($latestDownloads): void
    {
        $this->latestDownloads = $latestDownloads;
    }

    public function getData(DownloadService $downloadService): void
    {
        $this->latestDownloads = $downloadService->getLatest();
    }

    public function render(): View
    {
        return view('livewire.widgets.latest-downloads');
    }
}
