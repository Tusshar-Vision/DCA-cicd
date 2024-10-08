@php
    use App\Helpers\InitiativesHelper;
    use App\Enums\Initiatives;
    use App\Helpers\UrlHelper;
    use Carbon\Carbon;
    use App\Services\ArticleService;
@endphp

<!-- responsive menu start -->

<div id="myNav" class="menuOverlay">
  <div class="menuOverlayContent bg-white dark:bg-dark373839">

    <div class="flex justify-between align-middle mb-[20px] px-[20px]">
        <span class="font-[#242424] text-sm font-bold">MENU</span>
        <a href="javascript:void(0)" class="closebtn text-[#242424] dark:text-white border-[#242424] dark:border-white" onclick="closeNav()">&times;</a>
    </div>

    <div class="accordion h-[60vh] md:h-auto overflow-scroll">

        <a class="text-sm font-[#242424] font-semibold mb-[15px] hover:font-[#3362CC] hover:br-[#F4F6FC] py-[10px] px-[20px] {{ request()->is('/') ? 'text-[#005FAF]' : '' }}"
           href="{{ route('home') }}"
           wire:navigate
        >
            Home
        </a>

        @foreach ($initiatives as $initiative)

            @if ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))

                <a class="text-sm font-[#242424] font-semibold mb-[15px] hover:font-[#3362CC] hover:br-[#F4F6FC] py-[10px] px-[20px] {{ request()->is('news-today*') ? 'text-[#005FAF]' : '' }}"
                   href="{{ $initiative->path }}"
                   wire:navigate
                >
                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                </a>

            @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))

                <div class="accordion-item mb-[15px]">
                    <div class="accordion-label text-sm font-[#242424] font-semibold py-[10px] px-[20px] {{ request()->is('monthly-magazine*') ? 'text-[#005FAF]' : '' }}"
                         onclick="toggleAccordion(this)"
                    >
                        {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                        <div class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="#242424" class="dark:fill-white">
                                <path d="M8.76615 7.42899L1.57103 0.236258C1.25531 -0.0786629 0.743796 -0.0786629 0.427282 0.236258C0.111565 0.551178 0.111565 1.06269 0.427282 1.37761L7.0517 7.99964L0.42808 14.6217C0.112363 14.9366 0.112363 15.4481 0.42808 15.7638C0.743797 16.0787 1.25611 16.0787 1.57182 15.7638L8.76695 8.57114C9.07782 8.25948 9.07782 7.73993 8.76615 7.42899Z" />
                            </svg>
                        </div>
                    </div>

                    <div class="accordion-content">
                        <a href="{{ $initiative->path }}" wire:navigate class="text-sm text-[#3362CC] underline font-semibold mb-[20px] py-[10px] px-[10px]">
                            Latest Edition
                        </a>

                        <ul>
                            @foreach($menuData['monthlyMagazine']['data'] as $year => $menuDTO)
                                <li>
                                    <a href="javascript:void(0)" class="flex justify-between items-center font-semibold w-full p-[10px] text-sm">
                                        {{ $year }}
                                    </a>
                                    <ul>
                                        @foreach($menuDTO as $key => $menu)
                                            <li>
                                                <a href="{{ ArticleService::getArticleUrlFromSlug($menu->article?->first()?->slug) }}"
                                                   class="text-sm block px-[15px] mb-[10px]"
                                                   wire:navigate
                                                >
                                                    {{ Carbon::parse($menu->publicationDate)->monthName }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('monthly-magazine.archive') }}" wire:navigate class="text-sm text-[#3362CC] underline font-semibold mb-[20px] py-[10px] px-[10px]">
                            View All
                        </a>
                    </div>
                </div>

            @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))

                <div class="accordion-item mb-[15px]">
                    <div class="accordion-label text-sm font-[#242424] font-semibold py-[10px] px-[20px]" onclick="toggleAccordion(this)">
                        <a class="hover:text-[#005FAF] {{ request()->is('weekly-focus*') ? 'text-[#005FAF]' : '' }}"
                           href="javascript:void(0)">
                            {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                        </a>
                        <div class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="#242424" class="dark:fill-white">
                                <path d="M8.76615 7.42899L1.57103 0.236258C1.25531 -0.0786629 0.743796 -0.0786629 0.427282 0.236258C0.111565 0.551178 0.111565 1.06269 0.427282 1.37761L7.0517 7.99964L0.42808 14.6217C0.112363 14.9366 0.112363 15.4481 0.42808 15.7638C0.743797 16.0787 1.25611 16.0787 1.57182 15.7638L8.76695 8.57114C9.07782 8.25948 9.07782 7.73993 8.76615 7.42899Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <a href="{{ $initiative->path }}" wire:navigate class="text-sm text-[#3362CC] underline font-semibold mb-[20px] py-[10px] px-[10px]" wire:navigate>
                            Latest Editions
                        </a>
                        <ul>

                            @foreach($menuData['weeklyFocus']['data'] as $month => $menuDTO)

                                <li>
                                    <a href="javascript:void(0)" class="flex justify-between items-center font-semibold w-full p-[10px] text-sm">
                                        {{ $month }}
                                    </a>
                                    @foreach($menuDTO as $key => $menu)
                                        <ul>
                                            <li>
                                                <a href="{{ ArticleService::getArticleUrlFromSlug($menu->article?->first()?->slug) }}"
                                                   class="text-sm block px-[15px] mb-[10px]"
                                                   wire:navigate
                                                >
                                                    {{ $menu->name }}
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </li>

                            @endforeach

                        </ul>
                        <a href="{{ route('weekly-focus.archive') }}" wire:navigate class="text-sm text-[#3362CC] underline font-semibold mb-[20px] py-[10px] px-[10px]">
                            View All
                        </a>
                    </div>
                </div>

            @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MORE))

                <div class="accordion-item mb-[15px]">
                    <div class="accordion-label text-sm font-[#242424] font-semibold py-[10px] px-[20px]" onclick="toggleAccordion(this)">
                        <a class="hover:text-[#005FAF] {{ request()->is('downloads*') ? 'text-[#005FAF]' : '' }}"
                           href="{{ route('downloads') }}">
                            {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                        </a>
                        <div class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="#242424" class="dark:fill-white">
                                <path d="M8.76615 7.42899L1.57103 0.236258C1.25531 -0.0786629 0.743796 -0.0786629 0.427282 0.236258C0.111565 0.551178 0.111565 1.06269 0.427282 1.37761L7.0517 7.99964L0.42808 14.6217C0.112363 14.9366 0.112363 15.4481 0.42808 15.7638C0.743797 16.0787 1.25611 16.0787 1.57182 15.7638L8.76695 8.57114C9.07782 8.25948 9.07782 7.73993 8.76615 7.42899Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="accordion-content">
                        @foreach($menuData['more']['data'] as $route => $heading)
                            @if($route != '/weekly-round-table' && $route != '/animated-shorts' && $route != '/value-added-material' && $route != '/value-added-material-optional')
                                <a href="{{ $route }}" wire:navigate class="text-sm block font-[#242424] font-semibold mb-[15px] hover:font-[#3362CC] hover:br-[#F4F6FC] py-[5px] px-[10px]">
                                    {{ $heading }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

            @else

                <a class="text-sm font-[#242424] font-semibold mb-[15px] hover:font-[#3362CC] hover:br-[#F4F6FC] py-[10px] px-[20px] {{ request()->is(trim($initiative->path, '/')) ? 'text-[#005FAF]' : '' }}"
                   href="{{ $initiative->path }}" wire:navigate>
                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                </a>

            @endif

            <!-- Add more items as needed -->
        @endforeach

        <a href="{{ UrlHelper::linkToVision('/register') }}" class="text-sm text-[#FFFFFF] rounded font-bold my-[20px] bg-[#3983F2] block py-[15px] text-center">
            Register
        </a>

    </div>
  </div>
</div>

<!-- responsive menu end -->

<div class="flex py-[20px] bg-[#fff] items-center justify-between relative dark:bg-darkMode dark:text-white">
    <div class="w-3/4">
        <div class="flex justify-start items-center">
            <a href="javascript:void(0)" onclick="openNav()" class="mr-[15px] xl:hidden block">
                <div class="hamMenu rotate-180">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <div class="xl:hidden block">
                <a href="{{ route('home') }}" wire:navigate>
                    <img width="112px" class="dark:hidden" src="{{ CDN::asset('images/current-affairs-logo.svg') }}" alt="VisionIAS Logo" />
                    <img width="112px" class="hidden dark:block" src="{{ CDN::asset('images/current-affairs-logo-dark.svg') }}" alt="Dark VisionIAS Logo" />
                </a>
            </div>
        </div>
        <ul class="items-center hidden xl:block">
            <div class="flex pt-[5px] items-center"
                 x-data="{
                    isMagazineDropdownOpen: false,
                    isWeeklyDropdownOpen: false,
                    isMoreDropdownOpen: false,
                    isVideoDropdownOpen: false,
                    dropdownTimeout: null
                }"
            >
                <li class="font-semibold pr-4 xl:pr-6 float-left">
                    <a class="text-sm hover:text-[#005FAF] font-semibold leading-1 {{ request()->is('/') ? 'text-[#005FAF]' : '' }}" href="{{ route('home') }}" wire:navigate>
                        Home
                    </a>
                </li>
                @foreach ($initiatives as $initiative)
                    @if ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
                        <li class="font-semibold text-xs xl:text-sm pr-6">
                            <a class="hover:text-[#005FAF] {{ request()->is('news-today*') ? 'text-[#005FAF]' : '' }}"
                               href="{{ $initiative->path }}"
                               wire:navigate
                            >
                                {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                            </a>
                        </li>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
                        <div class="group relative"
                             @mouseleave="
                                dropdownTimeout = setTimeout(() => {
                                    isMagazineDropdownOpen = false;
                                }, 200); // Adjust the delay time as needed
                            "
                            @mouseenter="clearTimeout(dropdownTimeout)"
                        >
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @mouseenter="
                                        clearTimeout(dropdownTimeout);
                                        isMagazineDropdownOpen = true;
                                        isMoreDropdownOpen = false;
                                        isWeeklyDropdownOpen = false;
                                        isVideoDropdownOpen = false;
                                       "
                                >
                                <a class="group-hover:text-[#005FAF] {{ request()->is('monthly-magazine*') ? 'text-[#005FAF]' : '' }}"
                                    href="{{ route('monthly-magazine') }}"
                                    wire:navigate
                                >
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                    <span class="inline-block transition duration-300 rotate-[270deg] text-[18px] ml-1" :class="isMagazineDropdownOpen ? 'rotate-[450deg]' : 'rotate-[270deg]'">
                                        <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="group-hover:stroke-[#005FAF] dark:stroke-white" d="M0.597656 4.03516L4.31641 0.316406C4.58984 0.0429688 5 0.0429688 5.24609 0.316406L5.875 0.917969C6.12109 1.19141 6.12109 1.60156 5.875 1.84766L3.22266 4.47266L5.875 7.125C6.12109 7.37109 6.12109 7.78125 5.875 8.05469L5.24609 8.65625C5 8.92969 4.58984 8.92969 4.31641 8.65625L0.597656 4.9375C0.351562 4.69141 0.351562 4.28125 0.597656 4.03516Z" fill="#242424"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <x-navigation.dropdown x-show="isMagazineDropdownOpen"
                                button-text="Latest Edition"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('monthly-magazine.archive') }}"
                                :menuData="$menuData['monthlyMagazine']"
                            />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
                        <div class="group relative"
                             @mouseleave="
                                dropdownTimeout = setTimeout(() => {
                                    isWeeklyDropdownOpen = false;
                                }, 200); // Adjust the delay time as needed
                             "
                             @mouseenter="clearTimeout(dropdownTimeout)"
                            >
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @mouseenter="
                                        clearTimeout(dropdownTimeout);
                                        isWeeklyDropdownOpen = true;
                                        isMagazineDropdownOpen = false;
                                        isMoreDropdownOpen = false;
                                        isVideoDropdownOpen = false;
                                       ">
                                <a class="group-hover:text-[#005FAF] {{ request()->is('weekly-focus*') ? 'text-[#005FAF]' : '' }}"
                                   href="{{ route('weekly-focus') }}"
                                   wire:navigate
                                >
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                    <span class="inline-block transition duration-300 rotate-[270deg] text-[18px] ml-1" :class="isWeeklyDropdownOpen ? 'rotate-[450deg]' : 'rotate-[270deg]'">
                                        <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="group-hover:stroke-[#005FAF] dark:stroke-white" d="M0.597656 4.03516L4.31641 0.316406C4.58984 0.0429688 5 0.0429688 5.24609 0.316406L5.875 0.917969C6.12109 1.19141 6.12109 1.60156 5.875 1.84766L3.22266 4.47266L5.875 7.125C6.12109 7.37109 6.12109 7.78125 5.875 8.05469L5.24609 8.65625C5 8.92969 4.58984 8.92969 4.31641 8.65625L0.597656 4.9375C0.351562 4.69141 0.351562 4.28125 0.597656 4.03516Z" fill="#242424"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <x-navigation.dropdown x-show="isWeeklyDropdownOpen"
                                button-text="Latest Edition"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('weekly-focus.archive') }}"
                                :menuData="$menuData['weeklyFocus']"
                            />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MORE))
                        <div class="group relative"
                             @mouseleave="
                                dropdownTimeout = setTimeout(() => {
                                    isMoreDropdownOpen = false;
                                }, 200); // Adjust the delay time as needed
                             "
                             @mouseenter="clearTimeout(dropdownTimeout)"
                        >
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @mouseenter="
                                        clearTimeout(dropdownTimeout);
                                        isMoreDropdownOpen = true;
                                        isWeeklyDropdownOpen = false;
                                        isMagazineDropdownOpen = false;
                                        isVideoDropdownOpen = false;
                                       ">
                                <a class="group-hover:text-[#005FAF]
                                        {{
                                            (
                                                request()->is('download*') ||
                                                request()->is('economic-survey*') ||
                                                request()->is('budget*') ||
                                                request()->is('quarterly-revision-documents*') ||
                                                request()->is('year-end-reviews*') ||
                                                request()->is('the-planet-vision*')
                                            ) ? 'text-[#005FAF]' : ''
                                        }}
                                    "
                                    href="{{ route('downloads') }}"
                                    wire:navigate
                                >
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                    <span class="inline-block transition duration-300 rotate-[270deg] text-[18px] ml-1" :class="isMoreDropdownOpen ? 'rotate-[450deg]' : 'rotate-[270deg]'">
                                        <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="group-hover:stroke-[#005FAF] dark:stroke-white" d="M0.597656 4.03516L4.31641 0.316406C4.58984 0.0429688 5 0.0429688 5.24609 0.316406L5.875 0.917969C6.12109 1.19141 6.12109 1.60156 5.875 1.84766L3.22266 4.47266L5.875 7.125C6.12109 7.37109 6.12109 7.78125 5.875 8.05469L5.24609 8.65625C5 8.92969 4.58984 8.92969 4.31641 8.65625L0.597656 4.9375C0.351562 4.69141 0.351562 4.28125 0.597656 4.03516Z" fill="#242424"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <x-navigation.more-drop-down x-show="isMoreDropdownOpen"
                                :menuData="$menuData['more']"
                            />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::VIDEOS))
                        <div class="group relative"
                             @mouseleave="
                                dropdownTimeout = setTimeout(() => {
                                    isVideoDropdownOpen = false;
                                }, 200); // Adjust the delay time as needed
                             "
                             @mouseenter="clearTimeout(dropdownTimeout)"
                        >
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @mouseenter="
                                        clearTimeout(dropdownTimeout);
                                        isVideoDropdownOpen = true;
                                        isWeeklyDropdownOpen = false;
                                        isMagazineDropdownOpen = false;
                                        isMoreDropdownOpen = false;
                                       ">
                                <a class="group-hover:text-[#005FAF]
                                        {{
                                            ( request()->is('videos*') ||
                                              request()->is('daily-news*') ||
                                              request()->is('in-conversation*') ||
                                              request()->is('simplified-by-visionias*') ||
                                              request()->is('personality-in-focus*') ||
                                              request()->is('scheme-in-focus*')
                                             )  ? 'text-[#005FAF]' : ''
                                        }}
                                    "
                                   href="{{ route('videos') }}"
                                   wire:navigate
                                >
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                    <span class="inline-block transition duration-300 rotate-[270deg] text-[18px] ml-1" :class="isVideoDropdownOpen ? 'rotate-[450deg]' : 'rotate-[270deg]'">
                                        <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="group-hover:stroke-[#005FAF] dark:stroke-white" d="M0.597656 4.03516L4.31641 0.316406C4.58984 0.0429688 5 0.0429688 5.24609 0.316406L5.875 0.917969C6.12109 1.19141 6.12109 1.60156 5.875 1.84766L3.22266 4.47266L5.875 7.125C6.12109 7.37109 6.12109 7.78125 5.875 8.05469L5.24609 8.65625C5 8.92969 4.58984 8.92969 4.31641 8.65625L0.597656 4.9375C0.351562 4.69141 0.351562 4.28125 0.597656 4.03516Z" fill="#242424"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <x-navigation.more-drop-down
                                x-show="isVideoDropdownOpen"
                                :menuData="$menuData['videos']"
                            />
                        </div>
                    @else
                        <li class="font-semibold text-xs xl:text-sm pr-6">
                            <a class="hover:text-[#005FAF] {{ request()->is(trim($initiative->path, '/')) ? 'text-[#005FAF]' : '' }}"
                                href="{{ $initiative->path }}" wire:navigate>
                                {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </div>
        </ul>
    </div>

    <div class="login-wrapper">
        <ul class="flex items-center">
            <li class="pr-1 lg:pr-4 mr-2 lg:mr-0">
                <a href="javascript:void(0)" onclick="openSearch()">
                    {!! \App\Helpers\SvgIconsHelper::getSvgIcon('search-open') !!}
                </a>
            </li>
            @auth('cognito')
                <div class="flex items-center font-bold cursor-pointer user-style" x-data="{ isUserMenuOpen: false }"
                    @click="isUserMenuOpen = true">
                    <div class="user-greet min-w-[80px] md:w-auto hidden lg:block">
                        <p>Welcome,</p>
                        <div class="dark:text-white">{{ auth('cognito')->user()->first_name ?? 'No Name' }}</div>
                    </div>
                    <span>{{ mb_substr(auth('cognito')->user()->first_name, 0, 1) ?? 'X' }}</span>
                    <x-auth.user-dropdown-menu x-show="isUserMenuOpen" />
                </div>
            @else
                <li class="pr-[20px] hidden xl:block">
                    <a href="{{ UrlHelper::linkToVision('/old/paystart.php') }}" class="register">Register</a>
                </li>
                <li class="pl-[10px]" style="border-left: 1px solid #E5EAF4;">
                    <button @click="isAuthFormOpen = !isAuthFormOpen" class="flex items-center text-xs xl:text-sm">
                        <svg class="mr-3 hidden lg:block" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="dark:fill-white"
                                d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                fill="#040404" />
                        </svg>
                        {{ __('header.login') }}
                    </button>
                </li>
            @endauth

        </ul>
    </div>

    <div id="searchCont" class="hidden modalCont fixed h-full w-full left-0 top-0 z-20 py-10 px-6 md:py-10 md:px-14">
        <div class="w-full md:w-[500px] m-auto">
            <div class="flex justify-end mt-6">
                <button onclick="closeSearch()">
                    {!! \App\Helpers\SvgIconsHelper::getSvgIcon('search-close') !!}
                </button>
            </div>
            <div class="mt-4 flex justify-center">
                <livewire:widgets.search-box />
            </div>
        </div>
    </div>

</div>


<script>

    // search mpdal show hide script
    function openSearch() {
        document.getElementById("searchCont").classList.add('inModal');
        setTimeout(function() {
            document.getElementById('navSearchInput').focus();
        }, 100);
    }

    function closeSearch() {
        document.getElementById("searchCont").classList.remove('inModal')
    }


    // responsive menu show hide script
    function openNav() {
        document.getElementById("myNav").style.height = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.height = "0%";
    }

    // menu toggle script
    function toggleAccordion(element) {
        const content = element.nextElementSibling;
        const arrow = element.querySelector('.arrow');

        if (content.style.display === 'block') {
            content.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
        } else {
            content.style.display = 'block';
            arrow.style.transform = 'rotate(-90deg)';
        }
    }

</script>
