<?php

namespace App\Livewire\Widgets;

use App\DTO\Menu\NewsTodayMenuDTO;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class NewsTodayCalendar extends Component
{
    public NewsTodayMenuDTO $calendarData;
    public function mount(NewsTodayMenuDTO $calendarData): void
    {
        $this->calendarData = $calendarData;
    }
    public function render(): View
    {
        return view('livewire.widgets.news-today-calendar');
    }
}
