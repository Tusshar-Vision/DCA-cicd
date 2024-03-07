   <?php
$year = request()->input('year');
?>
   
    <div id="myFilter" class="menuOverlay">
        <div class="menuOverlayContent bg-white dark:bg-dark373839">
            <div class="flex justify-between align-middle mb-[20px]">
                <span class="text-[#3362CC] text-sm font-bold">Select Filters</span>
                <a href="javascript:void(0)" class="closebtn" onclick="closeFilter()">&times;</a>
            </div>
            <div>
                <div class="mb-[20px]">
                    <label class="block mb-[10px] text-[#183B56] text-sm dark:text-white">
                        Select Year
                        <select onchange="setYear(this)" class="w-full rounded mt-2 dark:bg-dark545557">
                        <option></option>
                        @foreach ($data as $year)
                            <option onchange="setYear(this)" value="{{$year}}">{{$year}}</option>
                        @endforeach    
                        </select>
                    </label>
                </div>
                @if (request()->is('monthly-magazine*') || request()->is('weekly-focus*') || request()->is('news-today*'))
                <div class="mb-[20px]">
                    <label class="block mb-[10px] text-[#183B56] text-sm dark:text-white">
                        Select Month
                        <select onchange="setMonth(this)" class="w-full rounded mt-2 dark:bg-dark545557">
                        <option></option>
                            <option value="1">january</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </label>
                </div>
                @endif
                <button onclick="applyFilters()" class="w-full bg-[#3362CC] text-white rounded text-center text-sm font-bold py-[12px]">
                    Apply Filters
                </button>
                <button class="w-full text-[#485153] rounded text-center text-sm font-semibold py-[12px] mt-4">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>

    <script>
    let year, month;
    // responsive menu show hide script
    function openFilter() {
        document.getElementById("myFilter").style.height = "100%";
    }

    function closeFilter() {
        document.getElementById("myFilter").style.height = "0%";
    }

    function setYear(ele) {
      year = ele.value;
    }

    function setMonth(ele) {
      month = ele.value;
    }

    function applyFilters() {
      let url = window.location.href;
      if(month && year) {
        url += `?year=${year}&month=${month}`
      } else if(year) {
        url += `?year=${year}`
      } else if(month) {
        url += `?month=${month}`
      } 
      if(month || year) window.location.href = url;
    }


</script>
