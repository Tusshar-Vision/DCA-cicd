@php
    use App\Services\ArticleService;
@endphp
<div x-data="{ isCalendarOpen: false }" class="calendar-wrapper border-1 border-color-C3CAD9 bg-white border rounded relative dark:bg-dark373839 z-10">
    <div x-show="isCalendarOpen" @click.away="isCalendarOpen = false" class="calender-wrap absolute left-0 top-0 mt-[23px] w-full bar" x-cloak>
        <div class="vi-daily-news-card bg-white dark:bg-dark373839">
            <div class="flex justify-between items-center">
                <label>
                    <select wire:model.live="selectedYear" title="year" class="py-1 h-[28px] text-sm border-none border-[#C3CAD9] text-[#3d3d3d] cursor-pointer dark:bg-dark545557 dark:text-[#ccc]">
                        @foreach($calendarData->mainMenu as $year => $months)
                            <option value="{{ $year }}" {{ $selectedYear === $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <select wire:model.live="selectedMonth" title="month" class="py-1 h-[28px] text-sm border-none border-[#C3CAD9] text-[#3d3d3d] cursor-pointer dark:bg-dark545557 dark:text-[#ccc]">
                        @foreach($calendarData->mainMenu[$selectedYear] as $month => $data)
                            <option value="{{ $month }}" {{ $selectedMonth === $month ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <ul class="flex text-xl">
                    <li class="mr-2">
                        <a wire:click="previousMonth()" href="javascript:void(0)">
                            {!! \App\Helpers\SvgIconsHelper::getSvgIcon('calendar-back-button') !!}
                        </a>
                    </li>
                    <li class="ml-2">
                        <a wire:click="nextMonth()" href="javascript:void(0)">
                            {!! \App\Helpers\SvgIconsHelper::getSvgIcon('calendar-next-button') !!}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="vi-calender-grid-week">
                <a href="javascript:void(0)" class="cursor-default">SUN</a>
                <a href="javascript:void(0)" class="cursor-default">MON</a>
                <a href="javascript:void(0)" class="cursor-default">TUE</a>
                <a href="javascript:void(0)" class="cursor-default">WED</a>
                <a href="javascript:void(0)" class="cursor-default">THU</a>
                <a href="javascript:void(0)" class="cursor-default">FRI</a>
                <a href="javascript:void(0)" class="cursor-default">SAT</a>
            </div>
            <div class="vi-calender-grid">
                @for($count = 1; $count <= $calendarData->mainMenu[$selectedYear][$selectedMonth]['diffInDays']; $count++)
                    <a href="javascript:void(0)" data-status="" class="date-disabled"></a>
                @endfor

                @foreach($calendarData->mainMenu[$selectedYear][$selectedMonth]['days'] as $day => $menuData)
                    @if($menuData['menu']->isEmpty())
                        <a href="javascript:void(0)" data-status="" class="date-disabled">
                            {{ $day }}
                            <span class="shadow-xl rounded-md bg-[#fff] border-[1px] border-[#ccc] w-[100px] absolute left-[-75%] bottom-[-15px] z-[1]">No article</span>
                        </a>
                    @else
                        <a href="{{ ArticleService::getArticleUrlFromSlug($menuData['menu']->first()->article->first()->slug) }}"
                           wire:navigate
                           data-status=""
                           class="{{ ($calendarData->currentMonth === $selectedMonth && $calendarData->date == $day) ? 'font-bold' : '' }}"
                           style="{{ ($calendarData->currentMonth === $selectedMonth && $calendarData->date == $day) ? 'border-color: #8F93A3' : '' }}"
                        >
                            {{ $day }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <svg @click="isCalendarOpen = true" xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 27 24" fill="none" class="absolute right-[10px] top-[7px] z-0">
        <rect x="5.7793" y="6.24023" width="15.8769" height="13.2" rx="2" stroke="#8F93A3" stroke-width="1.1"/>
        <path d="M5.7793 10.4404H21.6562" stroke="#8F93A3" stroke-linecap="round"/>
        <path d="M9.74805 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
        <path d="M17.687 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
    </svg>
    <label for="showCalendar"></label>
    <input
        id="showCalendar"
        type="text"
        class="border-0 focus:outline-none focus:border-0 w-full dark:bg-dark373839"
        autocomplete="off"
        readonly
        wire:model="selectedDate"
        @click="isCalendarOpen = true"
    />
</div>
