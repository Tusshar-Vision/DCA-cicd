<?php

namespace App\Livewire\Widgets;

use App\DTO\Menu\NewsTodayMenuDTO;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class NewsTodayCalendar extends Component
{
    public NewsTodayMenuDTO $calendarData;
    public $selectedDate;
    public function mount(NewsTodayMenuDTO $calendarData): void
    {
        $this->calendarData = $calendarData;
        $currentUrl = Request::url();

        // Parse the URL and extract the date part
        $segments = explode('/', parse_url($currentUrl, PHP_URL_PATH));
        $datePart = $segments[2];

        $this->selectedDate = $datePart;
    }
    public function render(): View
    {
        return view('livewire.widgets.news-today-calendar');
    }
}
