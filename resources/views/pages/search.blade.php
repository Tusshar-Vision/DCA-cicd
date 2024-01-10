@extends('layouts.base')
@section('title', 'Search Results')

@section('content')
    <!-- <div class="grid grid-cols-3 gap-4">
                                                                                                                                                                                                                                                                @foreach ($searchResults as $result)
    <x-cards.article :article="$result"/>
    @endforeach
                                                                                                                                                                                                                                                            </div> -->
    <!-- <section class="vi-magzin-header-section"> -->
    <!-- <div class="vigrid-wide"> -->
    <?php $query = $_GET['query']; ?>
    <div class="ecosystem-wrap">
        <div class="search-bar-wrapper">
            <span class="vi-icons search"></span>
            <input type="text" class="vi-search-bar focus" placeholder="Hydrid Warfare" required="" value="{{ $query }}"
                onchange="redirect(this)">
            <ul class="w-full absolute left-0 top-[40px] py-2 border-[#ddd] border-2 rounded bg-white hidden updatedText">
                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 1</li>
                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 2</li>
                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 3</li>
                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 4</li>
            </ul>
        </div>
        <div class="eco-menu">
            <a href="javascript:void(0)" class="mr-[15px] relative top-[-12px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none" class="inline-block">
                <path d="M3.05 6.364L8 11.314L6.586 12.728L0.222 6.364L6.586 -6.18079e-08L8 1.414L3.05 6.364Z" fill="#8F93A3"/>
                </svg>
            </a>
            <ul>
                <li><a href="{{ route('search') . "?query=$query" }}" class="active">All</a></li>
                <li><a href="{{ route('search') . "?query=$query&initiative=1" }}">News Today</a></li>
                <li><a href="{{ route('search') . "?query=$query&initiative=2" }}">Monthly Magazine</a></li>
                <li><a href="{{ route('search') . "?query=$query&initiative=3" }}">Weekly Focus</a></li>
                <li><a href="#">Notes</a></li>
                <li><a href="#">Images</a></li>
                <li><a href="#">Others</a></li>
            </ul>
            <a href="javascript:void(0)" class="hybrid-filter" onclick="toggleFilter()">Filter</a>
        </div>
    </div>
    <div class="divider mt-[-2px]"></div>
    <div class="filter-row  mt-[17px]" id="filter-row-show">
        <div class="filter-select-wrap">
            <button onclick="togglelist()" class="dropbtn">Most relevant</button>
            <ul id="relevent" class="dropdown-content">
                <li value="">Most recent</li>
                <li value="">Most relevant</li>
            </ul>
        </div>
        <div class="filter-select-wrap ml-[15px]">
            <button onclick="togglelist2()" class="dropbtn">All Results</button>
            <ul id="all" class="dropdown-content">
                <li value="">All results</li>
                <li value="">Verbatim</li>
            </ul>
        </div>
        <div class="filter-select-wrap ml-[15px]">
            <button onclick="togglelist3()" class="dropbtn">Any time</button>
            <ul id="anytime" class="dropdown-content">
                <li value="">Any time</li>
                <li value="">Past hour</li>
                <li value="">Past 24 hour</li>
                <li value="">Past week</li>
                <li value="">Past month</li>
                <li value="">Past year</li>
                <li value="">Custom range</li>
            </ul>
        </div>
    </div>
    <!-- hybrid body section start -->
    <div class="hybrid-text-wrapper">
        <div class="hybrid-left-panel">
            {{-- <div class="hybrid-img-wrapper">
                <div class="hybrid-img-row">
                    <h3>Images Section</h3>
                    <ul>
                        <li>
                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">
                            <p>Hybrid Warfare : A New Face of Warfare</p>
                        </li>
                        <li>
                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">
                            <p>Hybrid Warfare : A New Face of Warfare</p>
                        </li>
                        <li>
                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">
                            <p>Hybrid Warfare : A New Face of Warfare</p>
                        </li>
                        <li>
                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">
                            <p>Hybrid Warfare : A New Face of Warfare</p>
                        </li>
                    </ul>
                </div>
            </div> --}}
            @foreach ($searchResults as $result)
                <?php $published_at = Carbon\Carbon::parse($result->published_at)->format('Y-m-d');
                $topic = $result->topic->name;
                $slug = $result->slug;
                ?>
                <div class="hybrid-text-row">
                    <a href="{{ url($result->initiative->path . '/' . $published_at . '/' . $topic . '/' . $slug) }}">
                        <h3>
                            {{ $result->title }}</h3>
                    </a>
                    <p class="result-content"> {{ html_entity_decode(substr(strip_tags($result->content), 0, 500)) }}</p>
                    <span>{{ $result->initiative->name }} |
                        {{ Carbon\Carbon::parse($result->published_at)->format('Y-m-d') }}</span>
                </div>
            @endforeach
        </div>
        {{-- <div class="hybrid-right-panel">
            <div class="video-cont-wrapper mb-6">
                <h4>Hybrid Warfare</h4>
                <p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim
                    asperiores </p>
                <div class="hybrid-video"></div>
            </div>
            <div class="video-cont-wrapper mb-6">
                <h4>Hybrid Warfare</h4>
                <p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim
                    asperiores </p>
                <div class="hybrid-video"></div>
            </div>
        </div> --}}
    </div>
    <!-- </div> -->
    <!-- </section> -->


    <script>
        function redirect(ele) {
            const val = ele.value;
            let url = "{{ route('search') }}";
            url += `?query=${val}`;
            window.location.href = url;
        }

    /* on focus show dropdown */
    const onfocus = document.querySelector('.focus');
    const showlist = document.querySelector('.updatedText');

    onfocus.addEventListener("focus", () => {
      showlist.style.display = 'block';
    });

    onfocus.addEventListener("blur", () => {
      showlist.style.display = 'none';
    });


    /* toggle dropdown menu */   
    function togglelist() {
        document.getElementById("relevent").classList.toggle("show");
        document.getElementById("all").classList.remove("show");
        document.getElementById("anytime").classList.remove("show");
    }
    function togglelist2() {
        document.getElementById("all").classList.toggle("show");
        document.getElementById("relevent").classList.remove("show");
        document.getElementById("anytime").classList.remove("show");
    }
    function togglelist3() {
        document.getElementById("anytime").classList.toggle("show");
        document.getElementById("all").classList.remove("show");
        document.getElementById("relevent").classList.remove("show");
    }

    function toggleFilter() {
        document.getElementById("filter-row-show").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
            }
        }
    }
    </script>
@endsection
