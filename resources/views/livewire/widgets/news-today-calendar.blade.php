@php
    use App\Services\ArticleService;
@endphp
<div class="calendar-wrapper border-1 border-color-C3CAD9 bg-white border rounded relative">
    <div class="calender-wrap absolute left-0 top-0 mt-[23px] w-full bar hidden calendar">
        <div class="vi-daily-news-card">
            <div class="flex justify-between items-center">
                <label>
                    <select wire:model.live="selectedMonth" title="month" class="py-1 h-[28px] text-sm border-none border-[#C3CAD9] text-[#3d3d3d] cursor-pointer">
                        @foreach($calendarData->mainMenu as $month => $data)
                            <option value="{{ $month }}" {{ $selectedMonth === $month ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </label>
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
                                </a>
                            @else
                                <a href="{{ ArticleService::getArticleUrlFromSlug($menuData['menu']->first()->article->first()->slug) }}"
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
    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 27 24" fill="none" class="absolute right-[10px] top-[7px] z-0">
        <rect x="5.7793" y="6.24023" width="15.8769" height="13.2" rx="2" stroke="#8F93A3" stroke-width="1.1"/>
        <path d="M5.7793 10.4404H21.6562" stroke="#8F93A3" stroke-linecap="round"/>
        <path d="M9.74805 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
        <path d="M17.687 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
    </svg>
    <label for="showCalendar"></label>
    <input
        id="showCalendar"
        type="text"
        class="border-0 focus:outline-none focus:border-0 w-full"
        autocomplete="off"
        readonly
        wire:model="selectedDate"
    />
</div>

<script>
    document.addEventListener('livewire:init', () => {
        let input = document.getElementById('showCalendar');
        let calendar = document.getElementsByClassName('calendar')[0];
        let isCalendarVisible = false;

        input.addEventListener('focus', function() {
            calendar.style.display = 'block';
            isCalendarVisible = true;
            // Add click event to document to hide calendar on outside click
            document.addEventListener('click', handleOutsideClick);
            // Add touchstart event for mobile
            document.addEventListener('touchstart', handleOutsideClick);
        });

        Livewire.hook('morph.updated', ({ el, component }) => {
            calendar.style.display = 'block';
            isCalendarVisible = true;
            if (isCalendarVisible) {
                // Add click event to document to hide calendar on outside click
                document.addEventListener('click', handleOutsideClick);
                // Add touchstart event for mobile
                document.addEventListener('touchstart', handleOutsideClick);
            }
        });

        Livewire.hook('beforeDomUpdate', ({ el, component }) => {
            // Remove click and touchstart event listeners before Livewire update
            document.removeEventListener('click', handleOutsideClick);
            document.removeEventListener('touchstart', handleOutsideClick);
        });

        Livewire.hook('afterDomUpdate', ({ el, component }) => {
            if (isCalendarVisible) {
                // Re-add click and touchstart event listeners after Livewire update
                document.addEventListener('click', handleOutsideClick);
                document.addEventListener('touchstart', handleOutsideClick);
            }
        });

        function handleOutsideClick(event) {
            // Check if the clicked element is outside the calendar
            if (!calendar.contains(event.target) && event.target !== input) {
                calendar.style.display = 'none';
                // Remove click and touchstart event listeners when calendar is hidden
                document.removeEventListener('click', handleOutsideClick);
                document.removeEventListener('touchstart', handleOutsideClick);
            }
        }
    });
</script>
