<?php

namespace App\Livewire\Widgets;

use App\Services\MediaService;
use Livewire\Component;

class LatestVideos extends Component
{
    public $latestVideos;

    public function mount($latestVideos): void
    {
        $this->latestVideos = $latestVideos;
    }

    public function getData(MediaService $mediaService): void
    {
        $this->latestVideos = $mediaService->getLatestVideos();
    }

    public function render()
    {
        return view('livewire.widgets.latest-videos');
    }
}
