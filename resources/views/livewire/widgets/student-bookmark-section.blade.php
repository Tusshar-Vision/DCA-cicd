<!-- bookmark content -->
<div class="vigrid-wide">
    <div class="vi-profile-tab-container">
        <div class="my-content-tab-wrapper">
            <div class="my-contnet-tab-filter">
                <div class="my-content-search">
                    <div class="search-bar-wrapper">
                        <input id="history-searchbox" type="search" class="vi-search-bar dark:bg-dark545557 border-[#686E70] dark:text-white" placeholder="Search by article name" required="">
                        <span class="vi-icons search"></span>
                    </div>
                </div>
            </div>
                    <div class="bookmark-list-wrap">
            <ul id="bookmarks-container">
                @foreach ($bookmarks as $bookmark)
                @if($bookmark!=null)
                    <li class="bg-[#F7F8F9] dark:bg-dark373839 text-black dark:text-white">
                        {{-- <img src="{{  $bookmark['img'] ?? URL::asset('images/card-image-small.png') }}" alt="" width='129' height='120'> --}}
                        <a href="{{$bookmark['url']}}" class="bookmark-cont">
                            <span>{{ $bookmark['published_at'] }}</span>
                            <p class="dark:text-white">{{ $bookmark['title'] }}</p>
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
        </div>

    </div>
</div>
<!-- bookmark content -->
<script>
const searchBox  = document.getElementById("history-searchbox");
 searchBox.addEventListener("change", function() {
    const query = searchBox.value;
    if(query == "") return;
    let url = "{{url("user/bookmarks/search")}}";
    url += `/${query}`;

    fetch(url)
    .then(response => response.json())
    .then(data => {
        const histories = data.data;
        let html = "";
        histories.map(bookmark => {
                  if(bookmark!=null) {
                    html += `<li>
                        <a href="${bookmark['url']}" class="bookmark-cont">
                            <span>${bookmark['published_at']}</span>
                            <p>${bookmark['title']}</p>
                        </a>
                    </li>`
                  }
        })
        
        document.getElementById("bookmarks-container").innerHTML = html;
    })
 })
</script>
