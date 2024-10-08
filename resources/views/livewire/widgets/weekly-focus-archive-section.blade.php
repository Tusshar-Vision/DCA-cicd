<div class="w-full">
<div class="pt-[25px] border-t-2">
    {{-- <div class="flex w-full items-center justify-end space-x-4 mb-[25px]">
        <p>Filter</p>
        <livewire:widgets.filter />
    </div> --}}
    <div class="flex w-full items-center justify-between xl:justify-end space-x-4 mb-[25px]">
        <div class="block xl:hidden flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="16" viewBox="0 0 8 16" fill="none" onclick="myFunction()" class="cursor-pointer">
                <path d="M6.86719 15.0156L0.99998 8.49977" stroke="#242424" stroke-linecap="round"/>
                <line x1="0.5" y1="-0.5" x2="9.61301" y2="-0.5" transform="matrix(-0.654931 0.755689 0.654931 0.755689 7.65625 1.30469)" stroke="#242424" stroke-linecap="round"/>
            </svg>
            <h4 class="text-sm md:text-lg font-normal font-[#242424] ml-2 md:ml-4">Weekly Focus Archives</h4>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-sm md:text-base">Filter</p>
            <div class="block xl:hidden ml-4 cursor-pointer" onclick="openFilter()">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                    <path d="M0.46875 2.65157H7.60562C7.82071 3.63064 8.69505 4.36567 9.73778 4.36567C10.7805 4.36567 11.6549 3.63067 11.87 2.65157H14.5312C14.7901 2.65157 15 2.44169 15 2.18282C15 1.92396 14.7901 1.71407 14.5312 1.71407H11.8697C11.6542 0.735498 10.7787 0 9.73778 0C8.69634 0 7.82121 0.735381 7.60579 1.71407H0.46875C0.209883 1.71407 0 1.92396 0 2.18282C0 2.44169 0.209883 2.65157 0.46875 2.65157ZM8.49249 2.18405C8.49249 2.18238 8.49252 2.18068 8.49252 2.17901C8.49457 1.49443 9.05317 0.937529 9.73778 0.937529C10.4214 0.937529 10.9801 1.49367 10.983 2.17793L10.9831 2.18481C10.982 2.87057 10.4238 3.4282 9.73778 3.4282C9.05206 3.4282 8.49401 2.87112 8.49246 2.18578L8.49249 2.18405ZM14.5312 12.3629H11.8697C11.6542 11.3844 10.7787 10.6489 9.73778 10.6489C8.69634 10.6489 7.82121 11.3843 7.60579 12.3629H0.46875C0.209883 12.3629 0 12.5728 0 12.8317C0 13.0906 0.209883 13.3004 0.46875 13.3004H7.60562C7.82071 14.2795 8.69505 15.0145 9.73778 15.0145C10.7805 15.0145 11.6549 14.2795 11.87 13.3004H14.5312C14.7901 13.3004 15 13.0906 15 12.8317C15 12.5728 14.7901 12.3629 14.5312 12.3629ZM9.73778 14.077C9.05206 14.077 8.49401 13.52 8.49246 12.8346L8.49249 12.8329C8.49249 12.8312 8.49252 12.8295 8.49252 12.8279C8.49457 12.1433 9.05317 11.5864 9.73778 11.5864C10.4214 11.5864 10.9801 12.1425 10.983 12.8267L10.9831 12.8336C10.9821 13.5195 10.4239 14.077 9.73778 14.077ZM14.5312 7.03852H7.39438C7.17929 6.05944 6.30495 5.32444 5.26222 5.32444C4.21948 5.32444 3.34515 6.05944 3.13005 7.03852H0.46875C0.209883 7.03852 0 7.2484 0 7.50727C0 7.76616 0.209883 7.97602 0.46875 7.97602H3.13028C3.34582 8.95456 4.22133 9.69009 5.26222 9.69009C6.30366 9.69009 7.17879 8.95468 7.39421 7.97602H14.5312C14.7901 7.97602 15 7.76616 15 7.50727C15 7.2484 14.7901 7.03852 14.5312 7.03852ZM6.50751 7.50603C6.50751 7.50773 6.50748 7.5094 6.50748 7.51107C6.50543 8.19565 5.94683 8.75256 5.26222 8.75256C4.57857 8.75256 4.01994 8.19642 4.01698 7.51219L4.01689 7.50533C4.01792 6.81949 4.57617 6.26194 5.26222 6.26194C5.94794 6.26194 6.50599 6.81899 6.50754 7.50436L6.50751 7.50603Z" fill="#5A7184"/>
                </svg>
            </div>
            <div class="hidden xl:block ml-4">
                <livewire:widgets.filter/>
            </div>
        </div>
    </div>
</div>

<!-- responsive filter section start -->
<div id="myFilter" class="menuOverlay">
    <div class="menuOverlayContent">
      <div class="flex justify-between align-middle mb-[20px]"> 
          <span class="text-[#3362CC] text-sm font-bold">Select Filters</span> 
          <a href="javascript:void(0)" class="closebtn" onclick="closeFilter()">&times;</a>
      </div>
      <div>
        <div class="mb-[20px]">
            <label class="block mb-[10px] text-[#183B56] text-sm">Select Year</label>
            <select class="w-full rounded mt-2">
                <option>2023</option>
                <option>2022</option>
                <option>2024</option>
            </select>
        </div>
        <div class="mb-[20px]">
            <label class="block mb-[10px] text-[#183B56] text-sm">Select Month</label>
            <select class="w-full rounded mt-2">
                <option>December</option>
                <option>November</option>
                <option>October</option>
            </select>
        </div>
        <button class="w-full bg-[#3362CC] text-white rounded text-center text-sm font-bold py-[12px]">Apply Filters</button>
        <button class="w-full text-[#485153] rounded text-center text-sm font-semibold py-[12px] mt-4">Clear Filters</button>
      </div>
    </div>
  </div>
<!-- responsive filter section end -->

<!-- Weekly Focus section -->
<?php $i = 0; ?>
@foreach ($data as $year => $yearData)
    <div class="archiveWrapper mb-[15px] border-b-2"  x-data="{ expanded: {{$i==0 ? 'true': 'false'}} }" @click="expanded = ! expanded">
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
                        <div class="bar" style="width:100%;background-color: #89D38C;">
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

<?php $i++; ?>

@endforeach


</div>


<script>

    // responsive menu show hide script
    function openFilter() {
        document.getElementById("myFilter").style.height = "100%";
    }

    function closeFilter() {
        document.getElementById("myFilter").style.height = "0%";
    }

</script>