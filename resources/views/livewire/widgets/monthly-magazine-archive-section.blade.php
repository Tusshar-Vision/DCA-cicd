<div class="w-full">
<div class="pt-[25px] border-t-2">
    <div class="flex w-full items-center justify-end space-x-4 mb-[25px]">
        <p>Filter</p>
        <livewire:widgets.filter />
    </div>
</div>

<!-- Monthly Magazine section -->

@foreach ($articles as $year => $article)
    <div class="archiveWrapper mb-[15px] border-b-2 mt-[100px]">
    <div class="flex justify-between items-center archiveHeader cursor-pointer mb-[20px]">
        <div class="flex space-x-4 items-center">
            <div class="vi-progress-bar-round"></div>
            <h4 class="text-[#040404] text-[32px] font-normal">{{$year}}</h4>
        </div>
        <div>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
            <svg class="hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>

    @foreach ($article as $a) 
       <?php
       logger("adf");
       logger($a);
        $date = Carbon\Carbon::parse($a['publishedAt'])->format('Y-m-d');
        $title = Carbon\Carbon::parse($a['publishedAt'])->monthName;
        $topic = $a['article'][0]['topic'];
        $slug = $a['article'][0]['slug'];
        ?> 
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 archiveContent pb-[30px]">
        <div class="weekly-focus-single-card">
            <div class="weekly-focus-progress-list mt-0">
                <div class="weekly-focus-progress-single-bar border-b-2">
                    <p>January</p>
                    <div class="progress-bar">
                        <div class="bar" style="width:35%; background-color: #89D38C;">
                        </div>
                    </div>
                    <ul class="flex justify-start space-x-4 mt-[15px]">
                        <li class="text-[#3362CC] text-sm font-normal"><a href="{{route(
                                    'monthly-magazine.article',
                                    [
                                        'date' => $date,
                                        'topic' => strtolower($topic),
                                        'article_slug' =>$slug
                                    ]
                                )}}" class="hover:underline">Read</a></li>
                        <li class="text-[#3362CC] text-sm font-normal"><a href="javascript:void(0)" class="hover:underline">Download</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endforeach        
</div>
@endforeach

</div>