<div class="w-full">
<div class="pt-[25px] border-t-2">
    <div class="flex w-full items-center justify-end space-x-4 mb-[25px]">
        <p>Filter</p>
        <livewire:widgets.filter />
    </div>
</div>

<!-- Daily News section -->

@foreach ($articles as $year => $months)
    <div class="archiveWrapper mb-[15px] border-b-2 mt-[20px]" x-data="{ expanded: false }" @click="expanded = ! expanded">
    <div class="flex justify-between items-center archiveHeader cursor-pointer mb-[20px]">
        <h4 class="text-[#040404] text-[32px] font-normal">{{$year}} <span id="month"></span></h4>
        <div>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
            <svg class="hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 archiveContent border-b-2 mb-[35px] pb-[35px]" id="news-today-container">
    </div>
    @foreach ($months as $month)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 archiveContent pb-[30px]" onclick="showArticleCards('{{$year}}','{{$month}}')" x-show="expanded === true">
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</p>
                    <div class="progress-bar">
                        <div class="bar" style="width:35%; background-color: #89D38C;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach

</div>

<script>

function showArticleCards(year, month) {
    let url = "{{url('news-today')}}";
    url += `/getbymonth?year=${year}&month=${month}`;
    document.getElementById("month").innerHTML = "- " + "{{ date('F', mktime(0, 0, 0, $month, 1)) }}"
    getData(url).then(res => {
          let html = ""
         console.log("data", res);
         res.map(article => {
            html += `<div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>News Today - <span>${article.formatted_published_at}</span></p>
                    <div class="progress-bar">
                        <div class="bar" style="width:35%; background-color: #89D38C;">
                        </div>
                    </div>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href=${article.url} class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>`
         })
          document.getElementById("news-today-container").innerHTML = html
    })
}
</script>