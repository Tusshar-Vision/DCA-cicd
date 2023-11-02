<?php

namespace App\Livewire\Widgets;

use App\Services\MediaService;
use Livewire\Component;

class LatestDownloads extends Component
{
    public $latestDownloads;

    public function mount($latestDownloads): void
    {
        $this->latestDownloads = $latestDownloads;
    }

    public function getData(MediaService $mediaService): void
    {
        $this->latestDownloads = $mediaService->getLatestDownloads();
    }

    public function render()
    {
        return view('livewire.widgets.latest-downloads');
    }
}
