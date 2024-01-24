<div class="calendar-wrapper border-1 border-color-C3CAD9 bg-white border rounded relative">
    <div class="calender-wrap absolute left-0 top-0 mt-[23px] w-full bar hidden calendar">
        <div class="vi-daily-news-card">
            <div class="flex justify-between items-center">
                @dd($calendarData)
                <label>
                    <select title="month" class="py-1 h-[28px] text-sm border-none border-[#C3CAD9] text-[#3d3d3d] cursor-pointer">
                        @foreach($calendarData->mainMenu as $month => $data)
                            <option value="{{ $month }}" {{ $calendarData->currentMonth === $month ? 'selected' : '' }}>{{ $month }}</option>
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
                @foreach($calendarData->mainMenu as $month => $data)
                    @for($i = 1; $i <= $data['days']; $i++)
                        <a href="javascript:void(0)" data-status="" class="date-disabled">{{ $i }}</a>
                    @endfor
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
    <input type="text" class="border-0 focus:outline-none focus:border-0 w-full" id="showCalendar"/>
</div>
@script
    <script>
        let input = document.getElementById('showCalendar');
        let calendar = document.getElementsByClassName('calendar')[0];

        input.addEventListener('focus', function() {
            calendar.style.display = 'block';
        });

        calendar.addEventListener('focusout', function () {
            calendar.style.display = 'none';
        });
    </script>
@endscript
