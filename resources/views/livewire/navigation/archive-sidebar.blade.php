<div class="w-2/6 leftArchiveMenu" id="myDIV">
    <div class="py-[40px] px-[14px] bg-[#F7F8F9] rounded-md relative">
        <div class="flex justify-between align-middle relative">
            <h3 class="text-[#242424] text-xl mb-[25px] font-semibold ml-2">Current Affairs</h3>
            <a href="javascript:void(0)"
               class="text-lg border-[1px] border-black rounded-full w-[25px] h-[25px] text-center leading-[125%] block xl:hidden" onclick="myFunction()"
            >
                &times;
            </a>
        </div>
        <ul>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('monthly-magazine.archive') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('monthly-magazine*') ? 'activeSidebar' : '' }}"
                >
                    Monthly Magazine Archives
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('weekly-focus.archive') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('weekly-focus*') ? 'activeSidebar' : '' }}"
                >
                    Weekly Focus Archives
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('news-today.archive') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('news-today*') ? 'activeSidebar' : '' }}"
                >
                    Daily News Archives
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('pt-365') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('pt-365*') ? 'activeSidebar' : '' }}"
                >
                    PT 365
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('mains-365') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('mains-365*') ? 'activeSidebar' : '' }}"
                >
                    Mains 365
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('economic-survey') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('economic-survey*') ? 'activeSidebar' : '' }}"
                >
                    Economic Survey
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('budget') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('budget*') ? 'activeSidebar' : '' }}"
                >
                    Budget
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('value-added-material') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('value-added-material') ? 'activeSidebar' : '' }}"
                >
                    Value Added Material
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('value-added-material-optional') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('value-added-material-optional*') ? 'activeSidebar' : '' }}"
                >
                    Value Added Material (Optional)
                </a>
            </li>
            <li class="font-semibold text-base text-[#183B56] mb-1">
                <a href="{{ route('quarterly-revision-document') }}"
                   wire:navigate
                   class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('quarterly-revision-document*') ? 'activeSidebar' : '' }}"
                >
                    Quarterly Revision Documents
                </a>
            </li>

    {{-- These initiatives will be enabled in future, don't remove --}}

    {{--        <li class="font-semibold text-base text-[#183B56] mb-1">--}}
    {{--            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">Weekly Round Table</a>--}}
    {{--        </li>--}}
    {{--        <li class="font-semibold text-base text-[#183B56] mb-1">--}}
    {{--            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">Animated Shorts</a>--}}
    {{--        </li>--}}
    {{--        <li class="font-semibold text-base text-[#183B56] mb-1">--}}
    {{--            <a href="javascript:void(0)" class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white">PYQs</a>--}}
    {{--        </li>--}}
        </ul>
    </div>
</div>
<script>
    function myFunction() {
        let element = document.getElementById("myDIV");
        element.classList.toggle("mystyle");
    }
</script>
