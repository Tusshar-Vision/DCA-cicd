@php
    use App\Helpers\InitiativesHelper;
    use App\Enums\Initiatives;
@endphp

<div class="flex h-20 items-center justify-between">
    <div class="w-3/4">
        <ul class="flex">
            <li class="font-semibold pr-6">
                <a href="{{ route('home') }}" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M19 21.0002H5C4.44772 21.0002 4 20.5525 4 20.0002V11.0002H1L11.3273 1.61174C11.7087 1.265 12.2913 1.265 12.6727 1.61174L23 11.0002H20V20.0002C20 20.5525 19.5523 21.0002 19 21.0002ZM13 19.0002H18V9.15769L12 3.70314L6 9.15769V19.0002H11V13.0002H13V19.0002Z"
                            fill="#005FAF" />
                    </svg>
                </a>
            </li>
            <div class="flex" x-data="{ isMagazineDropdownOpen: false, isWeeklyDropdownOpen: false, isMoreDropdownOpen: false }">
                @foreach ($initiatives as $initiative)
                    @if ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @click="
                                        isMagazineDropdownOpen = !isMagazineDropdownOpen;
                                        isMoreDropdownOpen = false;
                                        isWeeklyDropdownOpen = false;
                                       ">
                                <a class="hover:text-visionRed {{ request()->is('monthly-magazine*') ? 'text-visionRed' : '' }}"
                                    href="#">
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                </a>
                            </li>

                            <x-navigation.dropdown x-show="isMagazineDropdownOpen"
                                @click.away="isMagazineDropdownOpen = false" button-text="Latest Edition"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('monthly-magazine.archive') }}" :menuData="$menuData['monthlyMagazine']" />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @click="
                                        isWeeklyDropdownOpen = !isWeeklyDropdownOpen;
                                        isMagazineDropdownOpen = false;
                                        isMoreDropdownOpen = false;
                                       ">
                                <a class="hover:text-visionRed {{ request()->is('weekly-focus*') ? 'text-visionRed' : '' }}"
                                    href="#">
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                </a>
                            </li>

                            <x-navigation.dropdown x-show="isWeeklyDropdownOpen"
                                @click.away="isWeeklyDropdownOpen = false" button-text="Latest Edition"
                                button-link="{{ $initiative->path }}" archive-link="{{ route('weekly-focus.archive') }}"
                                :menuData="$menuData['weeklyFocus']" />
                        </div>
                    @elseif ($initiative->id === InitiativesHelper::getInitiativeID(Initiatives::MORE))
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @click="
                                        isMoreDropdownOpen = !isMoreDropdownOpen;
                                        isWeeklyDropdownOpen = false;
                                        isMagazineDropdownOpen = false;
                                       ">
                                <a class="hover:text-visionRed {{ request()->is('more*') ? 'text-visionRed' : '' }}"
                                    href="#">
                                    {{ session()->get('locale') == 'hi' ? $initiative->name_hindi : $initiative->name }}
                                </a>
                            </li>

                            <x-navigation.more-drop-down x-show="isMoreDropdownOpen"
                                @click.away="isMoreDropdownOpen = false" :menuData="$menuData['more']" />
                        </div>
                    @else
                        <li class="font-semibold pr-6">
                            <a class="hover:text-visionRed {{ request()->is(trim($initiative->path, '/')) ? 'text-visionRed' : '' }}"
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
            <li>
                <!-- <x-widgets.search-bar /> -->
                <div class="search-field-container">
                    <input type="text" class="search-field" placeholder="" onchange="redirect(this)" />
                </div>
            </li>
            @auth('cognito')
                <div class="flex items-center font-bold cursor-pointer user-style" x-data="{ isUserMenuOpen: false }"
                    @click="isUserMenuOpen = true">
                    <div class="user-greet">
                        <p>Welcome,</p>
                        <div>{{ auth('cognito')->user()->name ?? 'No Name' }}</div>
                    </div>
                    <span>Y</span>
                    <!-- <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" fill="#040404"/>
                                                                    </svg> -->

                    <x-auth.user-dropdown-menu x-show="isUserMenuOpen" />
                </div>
            @else
                <li class="pr-[20px]"><a href="#" class="register">Register</a></li>
                <li class="pl-[20px]" style="border-left: 1px solid #E5EAF4;">
                    <button @click="isLoginFormOpen = !isLoginFormOpen" class="flex items-center">
                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                fill="#040404" />
                        </svg>
                        {{ __('header.login') }}
                    </button>
                </li>
            @endauth
        </ul>
    </div>
</div>


<script>
    function redirect(ele) {
        const val = ele.value;
        let url = "{{ route('search') }}";
        url += `?query=${val}`;
        window.location.href = url;
    }
</script>
