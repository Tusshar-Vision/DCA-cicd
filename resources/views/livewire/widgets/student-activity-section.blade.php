<!-- activity tab start -->

{{-- <?php dd($readHistories); ?> --}}
<div class="vi-profile-tab-container tabc-activity">
    <div class="activity-tab-wrapper">
        <div class="activity-tab-left-itmes">
            <div class="flex justify-between">
                <p class="vi-tab-title">Reading History</p>
                <div class="my-content-search w-[150px]">
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
                </div>
            </div>
            <div class="vi-left-child-item-list">
                <!-- Single card -->
                @foreach ($readHistories as $history)
                    <div class="vi-article-card vi-inline">
                        <a href="#" class="vi-article">
                            <img src="{{ URL::asset('images/card-image-small.png') }}" alt="">
                        </a>
                        <a href="#" class="vi-article">
                            <p class="vi-article-date-name">{{ $history->published_at }}</p>
                            <p>{{ $history->title }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="activity-tab-right-itmes">
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
                    <ul class="con-squares">
                        <!-- added via javascript -->
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const squares = document.querySelector('.con-squares');
                                for (var i = 1; i < 365; i++) {
                                    const level = Math.floor(Math.random() * 5);
                                    squares.insertAdjacentHTML('beforeend',
                                        `<li data-level="${level}" data-complete="98% Read" aria-label="Friday Feb 27, 2023"></li>`);
                                }
                            });
                        </script>
                    </ul>
                </div>
                <!-- Weekly Content Consumption graph -->
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
                    <ul class="con-squares">
                        <!-- added via javascript -->
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const squares = document.querySelector('.weekly-con-graph .con-squares');
                                for (var i = 1; i <= 52; i++) {
                                    const level = Math.floor(Math.random() * 5);
                                    squares.insertAdjacentHTML('beforeend',
                                        `<li data-level="${level}" data-complete="98% Read" aria-label="Friday Feb 27, 2023"></li>`);
                                }
                            });
                        </script>
                    </ul>
                </div>
                <!-- Monthly Content Consumption graph -->
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
                    @foreach ($montlyMagazineConsumption as $month => $percent)
                     <?php   echo $month." ". $percent; ?>
                    @endforeach
                    <ul class="con-squares">
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const squares = document.querySelector('.monthly-con-graph .con-squares');

                                @foreach ($montlyMagazineConsumption as $month => $percent)
                                <?php $level = null; 
                                if($percent === 100) $level = 1; 
                                else if($percent > 0) $level = 2;
                                else if($percent === 0) $level = 3;
                                else $level = 4;
                                ?>

                                squares.insertAdjacentHTML('beforeend',
                                        `<li data-level="${<?php  echo $level ?>}" data-complete="98% Read" aria-label="Friday Feb 27, 2023"></li>`);
                                @endforeach
                            });
                        </script>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- activity tab start -->

<script>
    /* on focus show dropdown */
    const onfocus = document.querySelector('.search-focus');
    const showlist = document.querySelector('.focus-show');

    onfocus.addEventListener("focus", () => {
        showlist.style.display = 'block';
    });

    onfocus.addEventListener("blur", () => {
        showlist.style.display = 'none';
    });
</script>
