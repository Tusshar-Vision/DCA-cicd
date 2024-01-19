<div class="w-2/6 leftArchiveMenu" id="myDIV">
<?php 
   $segment = request()->segment(count(request()->segments())-1);
?>
    <div class="py-[40px] px-[14px] bg-[#F7F8F9] rounded-md relative">
        <div class="flex justify-between align-middle relative">
            <h3 class="text-[#242424] text-xl mb-[25px] font-semibold">Current Affairs</h3>
            <a href="javascript:void(0)" class="text-lg border-[1px] border-black rounded-full w-[25px] h-[25px] text-center leading-[125%] block xl:hidden" onclick="myFunction()">&times;</a>
        </div>
    <ul>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="{{route('monthly-magazine.archive')}}" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ $segment == 'monthly-magazine' ? 'activeSidebar' : '' }}">Monthly Magazine Archives</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="{{route('weekly-focus.archive')}}" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ $segment == 'weekly-focus' ? 'activeSidebar' : '' }}">Weekly Focus Archives</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="{{route('news-today.archive')}}" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ $segment == 'news-today' ? 'activeSidebar' : '' }}">Daily News Archives</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="{{route('pt365.archive')}}" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ $segment == 'pt-365' ? 'activeSidebar' : '' }}">PT 365</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="{{route('mains365.archive')}}" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ $segment == 'mains-365' ? 'activeSidebar' : '' }}">Mains 365</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="{{route('economic-survey-budget')}}" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ $segment == 'economic-survey' ? 'activeSidebar' : '' }}">Economic Survey and Budget</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">Weekly Round Table</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">Animated Shorts</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">PYQs</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">Value Added Material</a>
        </li>
        <li class="font-semibold text-base text-[#183B56] mb-1">
            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">Value Added Material Optional</a>
        </li>
    </ul>
    </div>
</div>
<script>
    function myFunction() {
        var element = document.getElementById("myDIV");
        element.classList.toggle("mystyle");
    }
</script>