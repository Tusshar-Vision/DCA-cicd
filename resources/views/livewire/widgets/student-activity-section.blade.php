<!-- activity tab start -->
<div class="vi-profile-tab-container tabc-activity">
                <div class="activity-tab-wrapper">
                    <div class="activity-tab-left-itmes">
                        <p class="vi-tab-title">Reading History</p>
                        <div class="vi-left-child-item-list">
                            <!-- Single card -->
                            <div class="vi-article-card vi-inline">
                                <a href="#" class="vi-article">
                                    <img src="{{ URL::asset('images/card-image-small.png') }}" alt="">
                                </a>
                                <a href="#" class="vi-article">
                                    <p class="vi-article-date-name">John Jacob - 11/11/23</p>
                                    <p>Amet luctus venenatis lectus magna fringilla urna porttitor rhoncus.</p>
                                </a>
                            </div>
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
                                                squares.insertAdjacentHTML('beforeend', `<li data-level="${level}" data-complete="98% Read" aria-label="Friday Feb 27, 2023"></li>`);
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
                                                squares.insertAdjacentHTML('beforeend', `<li data-level="${level}" data-complete="98% Read" aria-label="Friday Feb 27, 2023"></li>`);
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
                                <ul class="con-squares">
                                    <!-- added via javascript -->
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const squares = document.querySelector('.monthly-con-graph .con-squares');
                                            for (var i = 1; i <= 12; i++) {
                                                const level = Math.floor(Math.random() * 5);
                                                squares.insertAdjacentHTML('beforeend', `<li data-level="${level}" data-complete="98% Read" aria-label="Friday Feb 27, 2023"></li>`);
                                            }
                                        });
                                    </script>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- activity tab start -->