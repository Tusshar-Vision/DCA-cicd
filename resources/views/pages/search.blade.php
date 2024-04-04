@extends('layouts.base')
@section('title', 'Search Results | Current Affairs')

@php
    use App\Services\ArticleService;
    use App\Helpers\InitiativesHelper;
    use App\Enums\Initiatives;
    use Carbon\Carbon;
@endphp
@section('content')
    <div x-data="{ query: '{{ $query }}' }" class="ecosystem-wrap w-full lg:w-auto">
        <div class="search-bar-wrapper">
            <span class="vi-icons search"></span>
            <label>
                <input @keydown.enter="navigateToSearchPage" x-model="query" type="text" class="vi-search-bar focus" placeholder="Search" value="{{ $query }}" required>
            </label>
{{--            <ul class="w-full absolute left-0 top-[40px] py-2 border-[#ddd] border-2 rounded bg-white hidden updatedText">--}}
{{--                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 1</li>--}}
{{--                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 2</li>--}}
{{--                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 3</li>--}}
{{--                <li class="py-1 cursor-pointer px-2 hover:bg-[#F4F6FC]">Search 4</li>--}}
{{--            </ul>--}}
        </div>
        <div class="eco-menu flex justify-start items-end lg:items-center mt-3 lg:mt-6">
            <a href="javascript:void(0)" class="mr-[15px] relative top-[-6px] xl:top-[-12px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13" fill="none" class="inline-block">
                <path d="M3.05 6.364L8 11.314L6.586 12.728L0.222 6.364L6.586 -6.18079e-08L8 1.414L3.05 6.364Z" fill="#8F93A3"/>
                </svg>
            </a>
            <ul class="whitespace-nowrap lg:whitespace-normal overflow-auto lg:overflow-x-hidden w-[80%] lg:w-auto">
                <li>
                    <a
                        href="{{ route('search') . "?query=$query" }}"
                        class="{{ request()->get('initiative') == null ? 'active' : '' }}"
                        wire:navigate
                    >
                        All
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('search') . "?query=$query&initiative=" . InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY) }}"
                        class="{{ request()->get('initiative') == InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY) ? 'active' : '' }}"
                        wire:navigate
                    >
                        News Today
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('search') . "?query=$query&initiative=" . InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS) }}"
                        class="{{ request()->get('initiative') == InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS) ? 'active' : '' }}"
                        wire:navigate
                    >
                        Weekly Focus
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('search') . "?query=$query&initiative=" . InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE) }}"
                        class="{{ request()->get('initiative') == InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE) ? 'active' : '' }}"
                        wire:navigate
                    >
                        Monthly Magazine
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="#">Images</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">Others</a>--}}
{{--                </li>--}}
{{--                @auth('cognito')--}}
{{--                    <li>--}}
{{--                        <a href="#">Notes</a>--}}
{{--                    </li>--}}
{{--                @endauth--}}
            </ul>
{{--            <a href="javascript:void(0)" class="hybrid-filter" onclick="toggleFilter()">Filter</a>--}}
        </div>
    </div>
    <div class="divider mt-[-2px]"></div>
    <div class="filter-row  mt-[17px]" id="filter-row-show">
        <div class="filter-select-wrap">
            <button onclick="togglelist()" class="dropbtn">Most relevant</button>
            <ul id="relevent" class="dropdown-content left-0">
                <li value="">Most recent</li>
                <li value="">Most relevant</li>
            </ul>
        </div>
        <div class="filter-select-wrap ml-[15px]">
            <button onclick="togglelist2()" class="dropbtn">All Results</button>
            <ul id="all" class="dropdown-content left-0">
                <li value="">All results</li>
                <li value="">Verbatim</li>
            </ul>
        </div>
        <div class="filter-select-wrap ml-[15px]">
            <button onclick="togglelist3()" class="dropbtn">Any time</button>
            <ul id="anytime" class="dropdown-content left-auto right-0">
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
    <div class="hybrid-text-wrapper flex flex-col lg:flex-row justify-between">
        <div class="hybrid-left-panel">
{{--             <div class="hybrid-img-wrapper">--}}
{{--                <div class="hybrid-img-row">--}}
{{--                    <h3>Images Section</h3>--}}
{{--                    <ul class="grid grid-cols-2 lg:grid-cols-4">--}}
{{--                        <li>--}}
{{--                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">--}}
{{--                            <p>Hybrid Warfare : A New Face of Warfare</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">--}}
{{--                            <p>Hybrid Warfare : A New Face of Warfare</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">--}}
{{--                            <p>Hybrid Warfare : A New Face of Warfare</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ URL::asset('images/hybrid-img.jpg') }}">--}}
{{--                            <p>Hybrid Warfare : A New Face of Warfare</p>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
            @foreach ($searchResults as $result)
                <div class="hybrid-text-row">
                    <a href="{{ ArticleService::getArticleUrlFromSlug($result->slug) }}" wire:navigate>
                        <h3>{{ $result->title }}</h3>
                    </a>
                    <p class="result-content">{{ $result->excerpt ?? 'No Description Available'}}</p>
                    <span>{{ $result->initiative->name }} | {{ Carbon::parse($result->publishedInitiative->published_at)->format('Y-m-d') }}</span>
                </div>
            @endforeach
        </div>
{{--         <div class="hybrid-right-panel ml-0 lg:ml-[40px] mt-4 lg:mt-0">--}}
{{--            <div class="video-cont-wrapper mb-6">--}}
{{--                <h4>Hybrid Warfare</h4>--}}
{{--                <p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim--}}
{{--                    asperiores </p>--}}
{{--                <div class="hybrid-video"></div>--}}
{{--            </div>--}}
{{--            <div class="video-cont-wrapper mb-6">--}}
{{--                <h4>Hybrid Warfare</h4>--}}
{{--                <p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim--}}
{{--                    asperiores </p>--}}
{{--                <div class="hybrid-video"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- </div> -->
    <!-- </section> -->


    <script>
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

    function navigateToSearchPage(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Get the current query value
        var queryValue = event.target.value.trim(); // Trim whitespace from the beginning and end
        if (queryValue.length < 2 || /^\s*$/.test(queryValue)) {
            // If query is less than two characters or contains only whitespace
            alert("Query must be at least two characters long.");
            return; // Stop further execution
        }
        var currentUrl = new URL(window.location);
        var searchParams = currentUrl.searchParams;
        searchParams.set('query', queryValue)
        currentUrl.search = searchParams.toString();

        // Navigate to the search page with the updated query
        Livewire.navigate(currentUrl.toString());
    }
    </script>
@endsection
