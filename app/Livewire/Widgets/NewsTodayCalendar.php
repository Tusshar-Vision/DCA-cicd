<?php

namespace App\Livewire\Widgets;

use App\DTO\Menu\NewsTodayMenuDTO;
use App\DTO\NewsTodayDTO;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Services\InitiativeService;
use App\Services\PublishedInitiativeService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class NewsTodayCalendar extends Component
{
    public NewsTodayMenuDTO $calendarData;
    public $selectedDate;
    public $selectedMonth;
    public $selectedYear;

    public function mount(NewsTodayMenuDTO $calendarData): void
    {
        $this->calendarData = $calendarData;
        $currentUrl = Request::url();

        // Parse the URL and extract the date part
        $segments = explode('/', parse_url($currentUrl, PHP_URL_PATH));
        $datePart = $segments[2];

        $this->selectedDate = $datePart;
        $this->selectedMonth = $calendarData->currentMonth;
        $this->selectedYear = $calendarData->currentYear;
    }

    public function nextMonth(): void
    {
        $this->selectedMonth = Carbon::createFromFormat(
            'Y-F-d',
            $this->selectedYear . '-' . $this->selectedMonth . '-1'
        )->addMonth()->format('F');
    }

    public function previousMonth(): void
    {
        $this->selectedMonth = Carbon::createFromFormat(
            'Y-F-d',
            $this->selectedYear . '-' . $this->selectedMonth . '-1'
        )->subMonth()->format('F');
    }

    public function render(): View
    {
        return view('livewire.widgets.news-today-calendar');
    }
}
