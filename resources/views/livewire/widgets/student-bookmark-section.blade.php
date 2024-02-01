<!-- bookmark content -->
<div class="vigrid-wide">
    <div class="vi-profile-tab-container">
        <div class="my-content-tab-wrapper">
            <div class="my-contnet-tab-filter">
                <div class="my-content-search">
                    <div class="search-bar-wrapper">
                        <input type="search" class="vi-search-bar" placeholder="Search by article name" required="">
                        <span class="vi-icons search"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bookmark-list-wrap">
            <ul>
                @foreach ($bookmarks as $bookmark)
                    <li>
                        <img src="{{ URL::asset('images/card-image-small.png') }}">
                        <a href="{{$bookmark['url']}}" class="bookmark-cont">
                            <span>{{ $bookmark['published_at'] }}</span>
                            <p>{{ $bookmark['title'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- bookmark content -->
