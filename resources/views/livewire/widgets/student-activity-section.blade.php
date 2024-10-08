<div class="vigrid-wide">
<div class="vi-profile-tab-container tabc-activity">
    <div class="activity-tab-wrapper flex flex-col lg:flex-row gap-[32px]">
        <div class="activity-tab-left-itmes w-full lg:w-2/6">
            <div class="flex justify-between relative">
                <p class="vi-tab-title">Reading History</p>
                <div class="student-search-field-container relative">
                    <input id="history-searchbox" type="search" placeholder="Search" class="student-search-field border-[#686E70] dark:text-white">
                    <span class="absolute left-[-38px] top-0 z-10 w-[38px]">
                        <img src="{{asset('images/search.svg')}}" alt=""/>
                    </span>
                </div>
            </div>
            <div id="histories-container" class="vi-left-child-item-list max-h-[250px] lg:max-h-[450px] overflow-y-auto">
                <!-- Single card -->
                @foreach ($readHistories as $history)
                    @if($history!=null)
                        <div class="vi-article-card vi-inline flex items-start gap-[12px]">
                            {{-- <a href="#" class="vi-article">
                                <img src="{{$history['img'] ?? URL::asset('images/card-image-small.png') }}" alt="">
                            </a> --}}
                            <a wire:navigate href="{{$history['url']}}" class="vi-article">
                                <p class="vi-article-date-name">{{ $history['read_at'] }}</p>
                                <p>{{ $history['title'] }}</p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="activity-tab-right-itmes w-full lg:w-4/6">
            <div class="graph-box-title-wrap">
                <p class="vi-tab-title">Content Consumption</p>
                <div class="graph-represent-list con-squares">
                    <li data-level="1" data-complete="Completed"></li>
                    <li data-level="2" data-complete="In Progress"></li>
                    <li data-level="3" data-complete="Not Started"></li>
                    <li data-level="4" data-complete="NO ARTICLE FOUND"></li>
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
    var searchField = document.querySelector('.student-search-field');
    var showlist = document.querySelector('.student-search-field-container');
    var searchBox = document.getElementById("history-searchbox");

    searchField.addEventListener("focus", () => {
        showlist.classList.add("absoluteSearch");
    });

    searchField.addEventListener("blur", () => {
        showlist.classList.remove("absoluteSearch");
    });

    function showDailyNews() {
        var dailyNewsSquare = document.getElementById('daily-news');

        @foreach ($newsTodayConsumption as $day => $value)
            <?php
                $level = null;
                $text = null;
                if($value != null && isset($value['total_read']) && isset($value['total_article'])) {
                    if ($value['total_read'] == $value['total_article']) {
                        $level = 1;
                        $text = "Completed";
                    }
                    else if ($value['total_read'] < $value['total_article']) {
                        $level = 2;
                        $text = "In Progress";
                    }
                } else {
                    if($value == null) {
                        $level =4;
                        $text = "No Articles for this day";
                    }
                    else {
                        $level = 3;
                        $text = "Not Started";
                    }
                }
            ?>

            dailyNewsSquare.innerHTML += `<li data-level="{{$level}}" data-complete="{{$text}}"></li>`
        @endforeach
    }

    function showWeeklyFocus() {
        var weeklyFocusSquare = document.getElementById('weekly-focus');

        @foreach ($weeklyFocusConsumption as $week => $value)
            <?php
            $level = null; $text = null;
            if($value != null && isset($value['total_read']) && isset($value['total_article'])) {
               if($value['total_read'] > 0) {
                $level = 1;
                $text = "Completed";
               }
               else if($value['total_read'] < $value['total_article']) {
                $level = 2;
                 $text = "In Progress";
               }
            } else {
                if($value == null) {
                    $level =4;
                     $text = "No Weekly Focus for this Week";
                }
                else {
                    $level = 3;
                     $text = "Not Started";
                }
            }
            ?>

            weeklyFocusSquare.innerHTML += `<li data-level="${<?php  echo $level ?>}" data-complete="{{$text}}"></li>`
        @endforeach
    }

    function showMonthlyMagazine() {
        var monthlyMagazineSquare = document.getElementById('monthly-magazine');
        @foreach ($montlyMagazineConsumption as $month => $value)
            <?php
                $level = null;
                $text = null;
                if ($value != null && isset($value['total_read']) && isset($value['total_article'])) {
                    if($value['total_read'] == $value['total_article']) {
                        $level = 1;
                        $text = "Completed";
                    }
                    else if ($value['total_read'] < $value['total_article']) {
                        $level = 2;
                        $text = "In Progress";
                    }
                } else {
                    if($value == null) {
                        $level = 4;
                         $text = "No Magazine for this month";
                    }
                    else {
                        $level = 3;
                         $text = "Not Started";
                    }
                }
            ?>

            monthlyMagazineSquare.innerHTML += `<li data-level="${<?php  echo $level ?>}" data-complete="{{$text}}"></li>`
        @endforeach
    }

    showDailyNews();
    showWeeklyFocus();
    showMonthlyMagazine();

    searchBox.addEventListener("change", function() {
        const query = searchBox.value;
        var url = "{{ route('user.search-read-history') }}";
        url += `/${query}`;

        fetch(url)
        .then(response => response.json())
        .then(data => {
            const histories = data.data;
            let html = "";
            histories.map(history => {
              if(history!=null) {
                html += `<div class="vi-article-card vi-inline flex items-start gap-[12px]">
                    <a href="${history['url']}" class="vi-article">
                        <p class="vi-article-date-name">${history['read_at']}</p>
                        <p>${history['title']}</p>
                    </a>
                  </div>`
              }
            });

            document.getElementById("histories-container").innerHTML = html;
        })
    });
</script>
