@extends('layouts.base')
@section('title', 'Home | Current Affairs')

@section('content')

<div>
    <!-- search filter -->
    <!-- <label class="mb-[10px] text-[#5A7184] text-sm flex">Paper</label>
    <div class="relative w-[100%]">
        <input type="search" placeholder="Paper" class="w-[100%] px-[20px] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('paper')" onblur="onSearchblur('paper')">
        <div id="paper" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">GS - 1</p>
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">GS - 2</p>
        </div>
    </div>
    
    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Subject</label>
    <div class="relative w-[100%]">
        <input type="search" placeholder="Subject" class="w-[100%] px-[20px] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('subject')" onblur="onSearchblur('subject')">
        <div id="subject" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">Economy</p>
        </div>
    </div>
    
    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Section</label>
    <div class="relative w-[100%]">
        <input type="search" placeholder="Section" class="w-[100%] px-[20px] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('section')" onblur="onSearchblur('section')">
        <div id="section" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">Government Budgeting and Financial Interme...</p>
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">Labour, Employment and Skill Development</p>
        </div>
    </div> -->
    <!-- search filter -->


    <!-- my content section -->
 <div class="vi-profile-tab-container">
    <div class="my-content-tab-wrapper rounded">
        <div class="my-contnet-tab-filter justify-between">
            <div class="my-content-search">
                <div class="search-bar-wrapper">
                    <span class="vi-icons search"></span>
                    <input type="search" class="vi-search-bar" placeholder="Search by article name"
                        required="">
                    <div class="absolute left-0 top-[40px] bg-white rounded-md w-[100%] border-[#8F93A3] border-[1px] z-10 hidden showsearch">
                        <p class="p-[10px] cursor-pointer text-[#5A7184] hover:bg-[#F4F6FC]">Search result<p>
                    </div>
                </div>
            </div>
            <div class="my-content-sort relative">
                <button class="clear-filter">Clear Filter</button>
                <button class="cont-filter">Filter</button>
                <div class="vi-dropdown">
                    <div class="vi-dropbtn">Time<span class="vi-icons vi-drop-arrow"></span></div>
                    <div class="vi-dropdown-content" id="dw">
                        <a href="javascript:void(0)">This Year</a>
                        <a href="javascript:void(0)">Last 7 days</a>
                        <a href="javascript:void(0)">Last 15 days</a>
                        <a href="javascript:void(0)">This month</a>
                        <a href="javascript:void(0)">Last Month</a>
                        <a href="javascript:void(0)" onclick="onCalendarShow('cal')">Custom</a>
                    </div>
                </div>
                <div class="mt-5 hidden absolute right-[73px] top-[30px] z-10" id="cal">
                    <input type="text" name="daterange" value="" placeholder="Select date" class="rounded border-[#8F93A3] text-[#8F93A3]" />
                </div>
                <div class="change-view-wrap">
                    <!-- <a href="javascript:void(0)"><img src="{{ URL::asset('images/grid.svg') }}"></a> -->
                    <a href="javascript:void(0)"><img src="{{ URL::asset('images/list.svg') }}"></a>
                </div>
            </div>
        </div>
        <div class="breadcrumb-wrapper">
            <ul>
                <li><a href="javascript:void(0)">Paper</a></li>
                <li><a href="javascript:void(0)">GS-1</a></li>
                <li><a href="javascript:void(0)">Economics</a></li>
                <li><a href="javascript:void(0)" class="active">Labour</a></li>
            </ul>
        </div>
        <div class="vi-tab-acc-list">
            <!-- Accordian -->
            <div class="vi-acrticle-highligh-coll active">
                <!-- add class and remove class 'grid-view' -->
                <div class="ci-tab-acc-content">
                    <div class="vi-note-and-high-list">
                        <!-- single card -->
                        <div class="vi-note">
                            <div class="vi-card-corner">
                                <div class="vi-card-corner-triangle"></div>
                            </div>
                            <p class="vi-note-title">Article Name - <span class="vi-note-name">Note 1</span></p>
                            <div class="note-content">
                                <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis feugiat vivamus at augue eget arcu.</p>
                                <p class="vi-text-dark">Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
                            </div>
                            <div class="vi-note-action">
                                <a href="javascript:void(0)" class="vi-icons note-delete"></a>
                                <a href="javascript:void(0)" class="vi-icons note-edit"></a>
                            </div>
                        </div>

                        <div class="vi-note">
                            <div class="vi-card-corner">
                                <div class="vi-card-corner-triangle"></div>
                            </div>
                            <p class="vi-note-title">Article Name - <span class="vi-note-name">Note 1</span></p>
                            <div class="note-content">
                                <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis feugiat vivamus
                                    at augue eget arcu.</p>
                                <p class="vi-text-dark">Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
                            </div>
                            <div class="vi-note-action">
                                <a href="javascript:void(0)" class="vi-icons note-delete"></a>
                                <a href="javascript:void(0)" class="vi-icons note-edit"></a>
                            </div>
                        </div>

                        <div class="vi-note">
                            <div class="vi-card-corner">
                                <div class="vi-card-corner-triangle"></div>
                            </div>
                            <p class="vi-note-title">Article Name - <span class="vi-note-name">Note 1</span></p>
                            <div class="note-content">
                                <p class="vi-text-light">A scelerisque purus semper eget duis. Dignissim cras tincidunt lobortis feugiat vivamus at augue eget arcu.</p>
                                <p class="vi-text-dark">Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
                            </div>
                            <div class="vi-note-action">
                                <a href="javascript:void(0)" class="vi-icons note-delete"></a>
                                <a href="javascript:void(0)" class="vi-icons note-edit"></a>
                            </div>
                        </div>

                        <div class="vi-note">
                            <div class="vi-card-corner">
                                <div class="vi-card-corner-triangle"></div>
                            </div>
                            <p class="vi-note-title">Article Name - <span class="vi-note-name">Highlight 1</span></p>
                            <div class="note-content">
                                <p class="vi-text-dark vi-yellow-text">Dignissim enim sit amet venenatis urna cursus eget nunc. Dignissim enim sit amet venenatis urna cursus eget nunc. Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
                            </div>
                            <div class="vi-note-action">
                                <a href="javascript:void(0)" class="vi-icons note-delete"></a>
                            </div>
                        </div>

                        <div class="vi-note">
                            <div class="vi-card-corner">
                                <div class="vi-card-corner-triangle"></div>
                            </div>
                            <p class="vi-note-title">Article Name - <span class="vi-note-name">Highlight 1</span></p>
                            <div class="note-content">
                                <p class="vi-text-dark vi-yellow-text">Dignissim enim sit amet venenatis urna cursus eget nunc. Dignissim enim
                                    sit amet venenatis urna cursus eget nunc. Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
                            </div>
                            <div class="vi-note-action">
                                <a href="javascript:void(0)" class="vi-icons note-delete"></a>
                            </div>
                        </div>

                        <div class="vi-note">
                            <div class="vi-card-corner">
                                <div class="vi-card-corner-triangle"></div>
                            </div>
                            <p class="vi-note-title">Article Name - <span class="vi-note-name">Highlight 1</span></p>
                            <div class="note-content">
                                <p class="vi-text-dark vi-yellow-text">Dignissim enim sit amet venenatis urna cursus eget nunc. Dignissim enim
                                    sit amet venenatis urna cursus eget nunc. Dignissim enim sit amet venenatis urna cursus eget nunc.</p>
                            </div>
                            <div class="vi-note-action">
                                <a href="javascript:void(0)" class="vi-icons note-delete"></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- my content section -->

</div>


<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>

function onCalendarShow(id) {
    var x = document.getElementById(id);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, 
  function(start, end, label) {
    start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY');
  });
});
</script>

<!-- <script>

function onSearchfocus(id) {
    var x = document.getElementById(id);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function onSearchblur(id) {
    var x = document.getElementById(id);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
}

</script> -->

@endsection
