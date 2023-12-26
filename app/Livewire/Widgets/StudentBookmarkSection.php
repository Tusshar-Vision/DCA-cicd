<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class StudentBookmarkSection extends Component
{
    public $bookmarks;

    public function mount($bookmarks)
    {
        $this->bookmarks = $bookmarks;
    }

    public function render()
    {
        return view('livewire.widgets.student-bookmark-section');
    }
}
