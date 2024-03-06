@php
    $currentYear = request()->input('year');
    $currentMonth = request()->input('month');
@endphp
    <div id="myFilter" class="menuOverlay">
        <div class="menuOverlayContent">
            <div class="flex justify-between align-middle mb-[20px]">
                <span class="text-[#3362CC] text-sm font-bold">Select Filters</span>
                <a href="javascript:void(0)" class="closebtn" onclick="closeFilter()">&times;</a>
            </div>
            <div>
                <div class="mb-[20px]">
                    <label class="block mb-[10px] text-[#183B56] text-sm">
                        Select Year
                        <select onchange="setYear(this)" class="w-full rounded mt-2">
                            <option>Select</option>
                            @foreach ($data as $year)
                                <option onchange="setYear(this)" value="{{$year}}" {{ $currentYear == $year ? 'selected' : '' }}>{{$year}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                @if (request()->is('monthly-magazine*') || request()->is('weekly-focus*') || request()->is('news-today*'))
                <div class="mb-[20px]">
                    <label class="block mb-[10px] text-[#183B56] text-sm">
                        Select Month
                        <select onchange="setMonth(this)" class="w-full rounded mt-2">
                            <option>Select</option>
                            <option value="1" {{ $currentMonth == 1 ? 'selected' : '' }}>January</option>
                            <option value="2" {{ $currentMonth == 2 ? 'selected' : '' }}>February</option>
                            <option value="3" {{ $currentMonth == 3 ? 'selected' : '' }}>March</option>
                            <option value="4" {{ $currentMonth == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $currentMonth == 5 ? 'selected' : '' }}>May</option>
                            <option value="6" {{ $currentMonth == 6 ? 'selected' : '' }}>June</option>
                            <option value="7" {{ $currentMonth == 7 ? 'selected' : '' }}>July</option>
                            <option value="8" {{ $currentMonth == 8 ? 'selected' : '' }}>August</option>
                            <option value="9" {{ $currentMonth == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $currentMonth == 10 ? 'selected' : '' }}>October</option>
                            <option value="11" {{ $currentMonth == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $currentMonth == 12 ? 'selected' : '' }}>December</option>
                        </select>
                    </label>
                </div>
                @endif
                <button onclick="applyFilters()" class="w-full bg-[#3362CC] text-white rounded text-center text-sm font-bold py-[12px]">
                    Apply Filters
                </button>
                <button onclick="clearFilters()" class="w-full text-[#485153] rounded text-center text-sm font-semibold py-[12px] mt-4">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>

<script>
    var year, month;
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
        // Construct a new URL object based on the current location
        let currentUrl = new URL(window.location);
        let searchParams = currentUrl.searchParams;

        // Check and set the year if provided
        if (year && year !== 'Select') {
            searchParams.set('year', year);
        } else {
            // Optionally remove the year parameter if not provided
            searchParams.delete('year');
        }

        // Check and set the month if provided
        if (month && month !== 'Select') {
            searchParams.set('month', month);
        } else {
            // Optionally remove the month parameter if not provided
            searchParams.delete('month');
        }

        // Update the search property of the current URL
        currentUrl.search = searchParams.toString();

        // Redirect to the new URL
        Livewire.navigate(currentUrl.toString());
    }

    function clearFilters() {
        // Construct a new URL object based on the current location
        let currentUrl = new URL(window.location);
        let searchParams = currentUrl.searchParams;

        // Remove the 'year' and 'month' parameters from the URL
        searchParams.delete('year');
        searchParams.delete('month');

        // Update the search property of the current URL
        currentUrl.search = searchParams.toString();

        // Redirect to the new URL
        Livewire.navigate(currentUrl.toString());
    }
</script>
