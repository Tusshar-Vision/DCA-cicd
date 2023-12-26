<?php

namespace App\Livewire\Widgets;

use App\Services\DownloadService;
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
        $this->latestDownloads = $downloadService->getLatestDownloads();
    }

    public function render()
    {
        return view('livewire.widgets.latest-downloads');
    }
}
