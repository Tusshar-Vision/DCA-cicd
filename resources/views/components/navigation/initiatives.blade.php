@php
    use App\Helpers\InitiativesHelper;
    use App\Enums\Initiatives;
    use App\Helpers\UrlHelper;
    use Carbon\Carbon;
@endphp

<!-- responsive menu start -->

<div id="myNav" class="menuOverlay">
  <div class="menuOverlayContent">

    <div class="flex justify-between align-middle mb-[20px] px-[20px]">
        <span class="font-[#242424] text-sm font-bold">MENU</span>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>

    <div class="accordion h-[60vh] md:h-auto overflow-scroll">

        <a href="{{ route('home') }}" wire:navigate class="text-sm font-[#242424] font-semibold mb-[15px] hover:font-[#3362CC] hover:br-[#F4F6FC] py-[10px] px-[20px] {{ request()->is('/') ? 'text-[#005FAF]' : '' }}">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                                <path d="M8.76615 7.42899L1.57103 0.236258C1.25531 -0.0786629 0.743796 -0.0786629 0.427282 0.236258C0.111565 0.551178 0.111565 1.06269 0.427282 1.37761L7.0517 7.99964L0.42808 14.6217C0.112363 14.9366 0.112363 15.4481 0.42808 15.7638C0.743797 16.0787 1.25611 16.0787 1.57182 15.7638L8.76695 8.57114C9.07782 8.25948 9.07782 7.73993 8.76615 7.42899Z" fill="#242424"/>
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
                                                <a href="{{ route(
                                                                'monthly-magazine.article',
                                                                [
                                                                    'date' => Carbon::parse($menu->publishedAt)->format('Y-m-d'),
                                                                    'topic' => strtolower($menu->article->first()->topic),
                                                                    'article_slug' => $menu->article->first()->slug
                                                                ]
                                                            )
                                                        }}"
                                                   class="text-sm block px-[15px] mb-[10px]"
                                                   wire:navigate
                                                >
                                                    {{ Carbon::parse($menu->publishedAt)->monthName }}
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                                <path d="M8.76615 7.42899L1.57103 0.236258C1.25531 -0.0786629 0.743796 -0.0786629 0.427282 0.236258C0.111565 0.551178 0.111565 1.06269 0.427282 1.37761L7.0517 7.99964L0.42808 14.6217C0.112363 14.9366 0.112363 15.4481 0.42808 15.7638C0.743797 16.0787 1.25611 16.0787 1.57182 15.7638L8.76695 8.57114C9.07782 8.25948 9.07782 7.73993 8.76615 7.42899Z" fill="#242424"/>
                            </svg>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <a href="{{ $initiative->path }}" wire:navigate class="text-sm text-[#3362CC] underline font-semibold mb-[20px] py-[10px] px-[10px]" wire:navigate>
                            Latest Edition
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
                                                <a href="{{
                                                        route(
                                                            'weekly-focus.article',
                                                            [
                                                                'date' => Carbon::parse($menu->publishedAt)->format('Y-m-d'),
                                                                'topic' => strtolower($menu->article->first()->topic),
                                                                'article_slug' => $menu->article->first()->slug
                                                            ]
                                                        )
                                                    }}"
                                                   class="text-sm block px-[15px] mb-[10px]"
                                                   wire:navigate
                                                >
                                                    {{ $menu->article->first()->title }}
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
                        <a class="hover:text-[#005FAF] {{ request()->is('weekly-focus*') ? 'text-[#005FAF]' : '' }}"
                           href="#">
                            {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                        </a>
                        <div class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                                <path d="M8.76615 7.42899L1.57103 0.236258C1.25531 -0.0786629 0.743796 -0.0786629 0.427282 0.236258C0.111565 0.551178 0.111565 1.06269 0.427282 1.37761L7.0517 7.99964L0.42808 14.6217C0.112363 14.9366 0.112363 15.4481 0.42808 15.7638C0.743797 16.0787 1.25611 16.0787 1.57182 15.7638L8.76695 8.57114C9.07782 8.25948 9.07782 7.73993 8.76615 7.42899Z" fill="#242424"/>
                            </svg>
                        </div>
                    </div>
                    <div class="accordion-content">
                        @foreach($menuData['more']['data'] as $route => $heading)
                            @if($route != '/weekly-round-table' && $route != '/animated-shorts' && $route != '/pyq' && $route != '/value-added-material' && $route != '/value-added-material-optional')
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

<div class="flex py-[20px] bg-[#fff] items-center justify-between relative">
    <div class="w-3/4">
        <div class="xl:hidden block">   
            <a href="{{ route('home') }}" wire:navigate>
                <img width="112px" src="{{ asset('images/LightLogo.svg') }}" alt="VisionIAS Logo" />
            </a>
        </div>
        <ul class="items-center hidden xl:block">
            <li class="font-semibold pr-4 xl:pr-6 float-left">
                <a href="{{ route('home') }}" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M19 21.0002H5C4.44772 21.0002 4 20.5525 4 20.0002V11.0002H1L11.3273 1.61174C11.7087 1.265 12.2913 1.265 12.6727 1.61174L23 11.0002H20V20.0002C20 20.5525 19.5523 21.0002 19 21.0002ZM13 19.0002H18V9.15769L12 3.70314L6 9.15769V19.0002H11V13.0002H13V19.0002Z"
                            fill="#005FAF" />
                    </svg>
                </a>
            </li>
            <div class="flex pt-[5px]" x-data="{ isMagazineDropdownOpen: false, isWeeklyDropdownOpen: false, isMoreDropdownOpen: false }">
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
                        <div class="relative">
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @click="
                                        isMagazineDropdownOpen = !isMagazineDropdownOpen;
                                        isMoreDropdownOpen = false;
                                        isWeeklyDropdownOpen = false;
                                       ">
                                <a class="hover:text-[#005FAF] {{ request()->is('monthly-magazine*') ? 'text-[#005FAF]' : '' }}"
                                    href="javascript:void(0)">
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                </a>
                            </li>

                            <x-navigation.dropdown x-show="isMagazineDropdownOpen"
                                @click.away="isMagazineDropdownOpen = false"
                                button-text="Latest Edition"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('monthly-magazine.archive') }}"
                                :menuData="$menuData['monthlyMagazine']"
                            />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
                        <div class="relative">
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @click="
                                        isWeeklyDropdownOpen = !isWeeklyDropdownOpen;
                                        isMagazineDropdownOpen = false;
                                        isMoreDropdownOpen = false;
                                       ">
                                <a class="hover:text-[#005FAF] {{ request()->is('weekly-focus*') ? 'text-[#005FAF]' : '' }}"
                                    href="javascript:void(0)">
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                </a>
                            </li>

                            <x-navigation.dropdown x-show="isWeeklyDropdownOpen"
                                @click.away="isWeeklyDropdownOpen = false"
                                button-text="Latest Edition"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('weekly-focus.archive') }}"
                                :menuData="$menuData['weeklyFocus']"
                            />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MORE))
                        <div class="relative">
                            <li class="font-semibold text-xs xl:text-sm pr-6"
                                @click="
                                        isMoreDropdownOpen = !isMoreDropdownOpen;
                                        isWeeklyDropdownOpen = false;
                                        isMagazineDropdownOpen = false;
                                       ">
                                <a class="hover:text-[#005FAF] {{ request()->is('more*') ? 'text-[#005FAF]' : '' }}"
                                    href="javascript:void(0)">
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                </a>
                            </li>

                            <x-navigation.more-drop-down x-show="isMoreDropdownOpen"
                                @click.away="isMoreDropdownOpen = false" :menuData="$menuData['more']" />
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
            <li class="pr-4">
                <a href="javascript:void(0)" onclick="openSearch()">
                    {!! \App\Helpers\SvgIconsHelper::getSvgIcon('search-open') !!}
                </a>
            </li>
            @auth('cognito')
                <div class="flex items-center font-bold cursor-pointer user-style" x-data="{ isUserMenuOpen: false }"
                    @click="isUserMenuOpen = true">
                    <div class="user-greet min-w-[80px] md:w-auto">
                        <p>Welcome,</p>
                        <div>{{ auth('cognito')->user()->first_name ?? 'No Name' }}</div>
                    </div>
                    <span>{{ mb_substr(auth('cognito')->user()->first_name, 0, 1) ?? 'X' }}</span>
                    <x-auth.user-dropdown-menu x-show="isUserMenuOpen" />
                </div>
            @else
                <li class="pr-[20px] hidden xl:block">
                    <a href="{{ UrlHelper::linkToVision('/register') }}" class="register">Register</a>
                </li>
                <li class="pl-[20px]" style="border-left: 1px solid #E5EAF4;">
                    <button @click="isAuthFormOpen = !isAuthFormOpen" class="flex items-center text-xs xl:text-sm">
                        <svg class="mr-3 hidden lg:block" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                fill="#040404" />
                        </svg>
                        {{ __('header.login') }}
                    </button>
                </li>
            @endauth
                <li class="ml-[15px] xl:hidden block">
                    <a href="javascript:void(0)" onclick="openNav()">
                        <div class="hamMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>
        </ul>
    </div>

    <div id="searchCont" class="hidden modalCont fixed h-full w-full left-0 top-0 z-10 py-10 px-6 md:py-10 md:px-14">
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
        document.getElementById("searchCont").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("searchCont").style.display = "none";
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
