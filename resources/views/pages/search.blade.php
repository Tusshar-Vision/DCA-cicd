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
            <input id="searchInput" type="text" class="vi-search-bar" placeholder="Hydrid Warfare" required=""
                value="{{ $query }}" onchange="redirect(this)">
        </div>
        <div class="eco-menu">
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
                <li value="">All Results 1</li>
                <li value="">All Results 2</li>
                <li value="">All Results 3</li>
            </ul>
        </div>
        <div class="filter-select-wrap ml-[15px]">
            <button onclick="togglelist2()" class="dropbtn">All Results</button>
            <ul id="all" class="dropdown-content">
                <li value="">All Results 1</li>
                <li value="">All Results 2</li>
                <li value="">All Results 3</li>
            </ul>
        </div>
        <div class="filter-select-wrap ml-[15px]">
            <button onclick="togglelist3()" class="dropbtn">Any time</button>
            <ul id="anytime" class="dropdown-content">
                <li value="">All Results 1</li>
                <li value="">All Results 2</li>
                <li value="">All Results 3</li>
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

        <<
        << << < HEAD
        document.getElementById('searchInput').addEventListener('input', function() {
            let query = this.value;
            console.log("valuee", query);

            let url = "{{ url('search') }}";
            url += `/${query}`

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log("Data", data)
                })
                .catch(error => console.error('Error fetching suggestions:', error));
        }); ===
        === =

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
            } >>>
            >>> > dff46ad974721e6784e15def9d310f3419038c27
    </script>
@endsection
