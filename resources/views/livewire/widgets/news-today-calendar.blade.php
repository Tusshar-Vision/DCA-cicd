<div class="calendar-wrapper border-1 border-color-C3CAD9 bg-white border rounded relative">
    <div class="calender-wrap absolute left-0 top-0 mt-[23px] w-full bar hidden calendar">
        <div class="vi-daily-news-card">
            <div class="flex justify-between items-center">
                @dd($calendarData)
                <label>
                    <select class="py-1 h-[28px] text-sm border-none border-[#C3CAD9] text-[#3d3d3d] cursor-pointer">
                        <option>January 2024</option>
                        <option>February 2024</option>
                        <option>March 2024</option>
                    </select>
                </label>
                <ul class="flex text-xl">
                    <li class="mr-2"><a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M3.96923 6.96468L10.7147 0.221495C11.0106 -0.0737429 11.4902 -0.0737429 11.7869 0.221495C12.0829 0.516732 12.0829 0.996275 11.7869 1.29151L5.57653 7.49966L11.7862 13.7078C12.0822 14.003 12.0822 14.4826 11.7862 14.7786C11.4902 15.0738 11.0099 15.0738 10.7139 14.7786L3.96849 8.03545C3.67705 7.74326 3.67705 7.25618 3.96923 6.96468Z" fill="#3D3D3D"/>
                            </svg>
                        </a>
                    <li class="ml-2"><a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M11.0308 6.96468L4.28534 0.221495C3.98935 -0.0737429 3.50981 -0.0737429 3.21308 0.221495C2.91709 0.516732 2.91709 0.996275 3.21308 1.29151L9.42347 7.49966L3.21382 13.7078C2.91784 14.003 2.91784 14.4826 3.21382 14.7786C3.50981 15.0738 3.9901 15.0738 4.28608 14.7786L11.0315 8.03545C11.323 7.74326 11.323 7.25618 11.0308 6.96468Z" fill="#3D3D3D"/>
                            </svg>
                        </a>
                </ul>
            </div>
            <div class="vi-calender-grid-week">
                <a href="javascript:void(0)">SUN</a>
                <a href="javascript:void(0)">MON</a>
                <a href="javascript:void(0)">TUE</a>
                <a href="javascript:void(0)">WED</a>
                <a href="javascript:void(0)">THU</a>
                <a href="javascript:void(0)">FRI</a>
                <a href="javascript:void(0)">SAT</a>
            </div>
            <div class="vi-calender-grid">
                <a href="javascript:void(0)" data-status="lvl-0">1</a>
                <a href="javascript:void(0)" data-status="lvl-1">2</a>
                <a href="javascript:void(0)" data-status="lvl-2">3</a>
                <a href="javascript:void(0)" data-status="lvl-1">4</a>
                <a href="javascript:void(0)" data-status="lvl-1">5</a>
                <a href="javascript:void(0)" data-status="lvl-1">6</a>
                <a href="javascript:void(0)" data-status="lvl-1">7</a>
                <a href="javascript:void(0)" data-status="lvl-1">8</a>
                <a href="javascript:void(0)" data-status="lvl-1">9</a>
                <a href="javascript:void(0)" data-status="lvl-1">10</a>
                <a href="javascript:void(0)" data-status="lvl-1">11</a>
                <a href="javascript:void(0)" data-status="lvl-2">12</a>
                <a href="javascript:void(0)" data-status="lvl-2">13</a>
                <a href="javascript:void(0)" data-status="lvl-2">14</a>
                <a href="javascript:void(0)" data-status="lvl-2">15</a>
                <a href="javascript:void(0)" data-status="lvl-2">16</a>
                <a href="javascript:void(0)" data-status="lvl-2">17</a>
                <a href="javascript:void(0)" data-status="lvl-2">18</a>
                <a href="javascript:void(0)" data-status="lvl-2">19</a>
                <a href="javascript:void(0)" data-status="lvl-0">20</a>
                <a href="javascript:void(0)" data-status="lvl-0">21</a>
                <a href="javascript:void(0)" data-status="lvl-0">22</a>
                <a href="javascript:void(0)" data-status="lvl-0">23</a>
                <a href="javascript:void(0)" data-status="lvl-0">24</a>
                <a href="javascript:void(0)" data-status="lvl-0">25</a>
                <a href="javascript:void(0)" data-status="lvl-0">26</a>
                <a href="javascript:void(0)" data-status="lvl-0">27</a>
                <a href="javascript:void(0)" data-status="lvl-2">28</a>
                <a href="javascript:void(0)" data-status="lvl-2">29</a>
                <a href="javascript:void(0)" data-status="lvl-2">30</a>
                <a href="javascript:void(0)" data-status="lvl-2">31</a>
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
