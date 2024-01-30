<?php

namespace App\Livewire\Navigation;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArchiveSidebar extends Component
{
    public function render(): View
    {
        return view('livewire.navigation.archive-sidebar');
    }
}
