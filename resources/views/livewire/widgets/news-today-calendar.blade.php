@php
    use App\Services\ArticleService;
@endphp
<div x-data="{ isCalendarOpen: false }" class="calendar-wrapper border-1 border-color-C3CAD9 bg-white border rounded relative dark:bg-dark373839">
    <div x-show="isCalendarOpen" @click.away="isCalendarOpen = false" class="calender-wrap absolute left-0 top-0 mt-[23px] w-full bar" x-cloak>
        <div class="vi-daily-news-card bg-white dark:bg-dark373839">
            <div class="flex justify-between items-center">
                <label>
                    <select wire:model.live="selectedMonth" title="month" class="py-1 h-[28px] text-sm border-none border-[#C3CAD9] text-[#3d3d3d] cursor-pointer dark:bg-dark545557 dark:text-[#ccc]">
                        @foreach($calendarData->mainMenu as $month => $data)
                            <option value="{{ $month }}" {{ $selectedMonth === $month ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <ul class="flex text-xl">
                    <li class="mr-2">
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M3.96923 6.96468L10.7147 0.221495C11.0106 -0.0737429 11.4902 -0.0737429 11.7869 0.221495C12.0829 0.516732 12.0829 0.996275 11.7869 1.29151L5.57653 7.49966L11.7862 13.7078C12.0822 14.003 12.0822 14.4826 11.7862 14.7786C11.4902 15.0738 11.0099 15.0738 10.7139 14.7786L3.96849 8.03545C3.67705 7.74326 3.67705 7.25618 3.96923 6.96468Z" fill="#3D3D3D"/>
                            </svg>
                        </a>
                    </li>
                    <li class="ml-2">
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M11.0308 6.96468L4.28534 0.221495C3.98935 -0.0737429 3.50981 -0.0737429 3.21308 0.221495C2.91709 0.516732 2.91709 0.996275 3.21308 1.29151L9.42347 7.49966L3.21382 13.7078C2.91784 14.003 2.91784 14.4826 3.21382 14.7786C3.50981 15.0738 3.9901 15.0738 4.28608 14.7786L11.0315 8.03545C11.323 7.74326 11.323 7.25618 11.0308 6.96468Z" fill="#3D3D3D"/>
                            </svg>
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
                @for($count = 1; $count <= $calendarData->mainMenu[$selectedMonth]['diffInDays']; $count++)
                    <a href="javascript:void(0)" data-status="" class="date-disabled"></a>
                @endfor

                @foreach($calendarData->mainMenu as $month => $data)
                    @if($month == $selectedMonth)
                        @foreach($data['days'] as $day => $menuData)
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
