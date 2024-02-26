<div class="vigrid-wide"> 
<div class="vi-profile-tab-container tabc-activity">
    <div class="activity-tab-wrapper flex flex-col lg:flex-row gap-[32px]">
        <div class="activity-tab-left-itmes w-full lg:w-2/6">
            <div class="flex justify-between relative">
                <p class="vi-tab-title">Reading History</p>
                <div class="student-search-field-container">
                    <input type="search" placeholder="Search" class="student-search-field">
                </div>
                {{-- <div class="my-content-search w-[150px]">
                    <div class="search-bar-wrapper">
                        <input type="search" class="vi-search-bar search-focus" placeholder="Search" required="">
                        <span class="vi-icons search"></span>
                        <ul
                            class="w-full absolute left-0 top-[40px] py-2 border-[#ddd] border-2 rounded hidden bg-white focus-show">
                            <li class="px-[10px] cursor-pointer hover:bg-[#F4F6FC]">Search 1</li>
                            <li class="px-[10px] cursor-pointer hover:bg-[#F4F6FC]">Search 2</li>
                            <li class="px-[10px] cursor-pointer hover:bg-[#F4F6FC]">Search 3</li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="vi-left-child-item-list">
                <!-- Single card -->
                @foreach ($readHistories as $history)
                    <div class="vi-article-card vi-inline flex items-start gap-[12px]">
                        <a href="#" class="vi-article">
                            <img src="{{ URL::asset('images/card-image-small.png') }}" alt="">
                        </a>
                        <a href="{{$history['url']}}" class="vi-article">
                            <p class="vi-article-date-name">{{ $history['published_at'] }}</p>
                            <p>{{ $history['title'] }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="activity-tab-right-itmes w-full lg:w-4/6">
            <div class="graph-box-title-wrap">
                <p class="vi-tab-title">Content Consumption</p>
                <div class="graph-represent-list">
                    <li data-level="1"></li>
                    <li data-level="2"></li>
                    <li data-level="3"></li>
                    <li data-level="4"></li>
                </div>
            </div>
            <div class="vi-right-child-item-list">
                <!-- Daily Content Consumption graph -->
                <p class="con-title">Daily News</p>
                <div class="con-graph">
                    <ul class="con-months">
                        <li>Jan</li>
                        <li>Feb</li>
                        <li>Mar</li>
                        <li>Apr</li>
                        <li>May</li>
                        <li>Jun</li>
                        <li>Jul</li>
                        <li>Aug</li>
                        <li>Sep</li>
                        <li>Oct</li>
                        <li>Nov</li>
                        <li>Dec</li>
                    </ul>
                    <ul class="con-squares" id="daily-news">
                    </ul>
                </div>

                <p class="con-title">Weekly Focus</p>
                <div class="weekly-con-graph">
                    <ul class="con-months">
                        <li>Jan</li>
                        <li>Feb</li>
                        <li>Mar</li>
                        <li>Apr</li>
                        <li>May</li>
                        <li>Jun</li>
                        <li>Jul</li>
                        <li>Aug</li>
                        <li>Sep</li>
                        <li>Oct</li>
                        <li>Nov</li>
                        <li>Dec</li>
                    </ul>
                    <ul class="con-squares" id="weekly-focus">
                    </ul>
                </div>

                <p class="con-title">Monthly magazine</p>
                <div class="monthly-con-graph">
                    <ul class="con-months">
                        <li>Jan</li>
                        <li>Feb</li>
                        <li>Mar</li>
                        <li>Apr</li>
                        <li>May</li>
                        <li>Jun</li>
                        <li>Jul</li>
                        <li>Aug</li>
                        <li>Sep</li>
                        <li>Oct</li>
                        <li>Nov</li>
                        <li>Dec</li>
                    </ul>

                    <ul class="con-squares" id="monthly-magazine">
                    </ul>
                </div>


            </div>
        </div>

    </div>
</div>
</div>


<script>
    const onfocus = document.querySelector('.student-search-field');
    const showlist = document.querySelector('.student-search-field-container');

    onfocus.addEventListener("focus", () => {
        showlist.classList.add("absoluteSearch");
    });

    onfocus.addEventListener("blur", () => {
        showlist.classList.remove("absoluteSearch");
    });

 function showDailyNews() {
                                  const square = document.getElementById('daily-news');
                                 @foreach ($newsTodayConsumption as $day => $value)
    
                                <?php 
                                $level = null; 
                                if($value != null && isset($value['total_read']) && isset($value['total_article'])) {
                                   if($value['total_read'] == $value['total_article']) $level = 1;
                                   else if($value['total_read'] < $value['total_article']) $level = 2;
                                } else {
                                    if($value == null) $level =4;
                                    else $level = 3;
                                }
                                ?>
                               
                                square.innerHTML += `<li data-level="{{$level}}" data-complete="{{$level == 4 ? "NO ARTICLE FOUND FOR THIS MONTH" : ""}}"></li>`
                                        
                                @endforeach
 }

 function showWeeklyFocus() {
    const square = document.getElementById('weekly-focus');

                                
                                @foreach ($weeklyFocusConsumption as $week => $value)
                                <?php 
                                $level = null; 
                                if($value != null && isset($value['total_read']) && isset($value['total_article'])) {
                                   if($value['total_read'] == $value['total_article']) $level = 1;
                                   else if($value['total_read'] < $value['total_article']) $level = 2;
                                } else {
                                    if($value == null) $level =4;
                                    else $level = 3;
                                }
                                ?>

                                square.innerHTML += `<li data-level="${<?php  echo $level ?>}" data-complete="{{$level == 4 ? "NO WEEKLY FOCUS FOUND FOR THIS WEEK" : ""}}"></li>`
                                @endforeach
 }

 function showMonthlyMagazine() {
                                    const square = document.getElementById('monthly-magazine');

                                @foreach ($montlyMagazineConsumption as $month => $value)
                                <?php 
                                $level = null; 
                                if($value != null && isset($value['total_read']) && isset($value['total_article'])) {
                                   if($value['total_read'] == $value['total_article']) $level = 1;
                                   else if($value['total_read'] < $value['total_article']) $level = 2;
                                } else {
                                    if($value == null) $level =4;
                                    else $level = 3;
                                }
                                ?>

                                square.innerHTML += `<li data-level="${<?php  echo $level ?>}" data-complete="{{$level == 4 ? "NO MAGAZINE FOUND FOR THIS MONTH" : ""}}"></li>`
                                @endforeach
}

 showDailyNews()
 showWeeklyFocus()
 showMonthlyMagazine()

</script>
