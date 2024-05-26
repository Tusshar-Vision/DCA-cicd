<div
    x-data="{ isSticky: true }"
    x-init="isSticky = window.innerWidth > 1279"
    x-cloak
    class="w-2/6 py-[40px] px-[14px] relative rounded-md bg-[#F7F8F9] dark:bg-dark373839"
    :class="isSticky ? 'leftsticky stickyMl-0' : 'leftArchiveMenu'"
    id="myDIV"
>
    <div class="flex justify-between align-middle relative">
        <h3 class="text-[#242424] dark:text-white text-xl mb-[25px] font-semibold ml-2">Current Affairs Archives</h3>
        <a href="javascript:void(0)"
            class="text-lg border-[1px] border-black dark:border-white rounded-full w-[25px] h-[25px] text-center leading-[125%] block xl:hidden" onclick="myFunction()"
        >
            &times;
        </a>
    </div>
    <ul class="font-semibold text-base text-[#183B56] dark:text-blue-400">
        <li class="mb-1">
            <a href="{{ route('news-today.archive') }}"
               wire:navigate
               class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('news-today*') ? 'activeSidebar' : '' }}"
            >
                News Today
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('weekly-focus.archive') }}"
               wire:navigate
               class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('weekly-focus*') ? 'activeSidebar' : '' }}"
            >
                Weekly Focus
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('monthly-magazine.archive') }}"
                wire:navigate
                class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('monthly-magazine*') ? 'activeSidebar' : '' }}"
            >
                Monthly Magazine
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('planet-vision') }}"
               wire:navigate
               class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('the-planet-vision*') ? 'activeSidebar' : '' }}"
            >
                The Planet Vision
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('pt-365') }}"
                wire:navigate
                class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('pt-365*') ? 'activeSidebar' : '' }}"
            >
                PT 365
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('mains-365') }}"
                wire:navigate
                class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('mains-365*') ? 'activeSidebar' : '' }}"
            >
                Mains 365
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('quarterly-revision-document') }}"
               wire:navigate
               class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('quarterly-revision-document*') ? 'activeSidebar' : '' }}"
            >
                Quarterly Revision Documents
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('economic-survey') }}"
                wire:navigate
                class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('economic-survey*') ? 'activeSidebar' : '' }}"
            >
                Economic Survey
            </a>
        </li>
        <li class="mb-1">
            <a href="{{ route('budget') }}"
                wire:navigate
                class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('budget*') ? 'activeSidebar' : '' }}"
            >
                Budget
            </a>
        </li>
        {{-- <li class="font-semibold text-base text-[#183B56] mb-1">
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
        </li> --}}
        <li class="mb-1">
            <a href="{{ route('year-end-review') }}"
                wire:navigate
                class="p-[12px] hover:bg-[#3362CC] block rounded hover:text-white {{ request()->is('year-end-reviews*') ? 'activeSidebar' : '' }}"
            >
                Year End Reviews
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
<script>
    function myFunction() {
        let element = document.getElementById("myDIV");
        element.classList.toggle("mystyle");
    }
</script>
