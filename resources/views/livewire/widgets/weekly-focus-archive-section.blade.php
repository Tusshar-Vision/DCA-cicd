<div class="w-full">
<div class="pt-[25px] border-t-2">
    <div class="flex w-full items-center justify-end space-x-4 mb-[25px]">
        <p>Filter</p>
        <livewire:widgets.filter />
    </div>
</div>

<!-- Weekly Focus section -->

@foreach ($data as $year => $yearData)
    <div class="archiveWrapper mb-[15px] border-b-2"  x-data="{ expanded: false }" @click="expanded = ! expanded">
    <div class="flex justify-between items-center archiveHeader cursor-pointer">
        <h4 class="text-[#040404] text-[32px] font-normal mb-[15px]"> Weekly Focus - {{$year}}</h4>
        <div>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
            <svg class="hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>
    
    @foreach ($yearData as $month => $monthData)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 archiveContent pb-[30px]" x-show="expanded === true">
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-month-name">{{$month}}</div>
            <div class="weekly-focus-progress-list">

                @foreach ($monthData as $week => $weekData)
                   @foreach ($weekData as $article)
                        <div class="weekly-focus-progress-single-bar border-b-2 pb-[15px]">
                    <p>{{$article['title']}}</p>
                    <div class="progress-bar">
                        <div class="bar" style="width:35%;background-color: #89D38C;">
                        </div>
                    </div>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="{{url('weekly-focus'). "/". $article['published_at']. "/". $article['topic']."/". $article['slug']}}" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
                   @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endforeach


</div>
@endforeach


</div>