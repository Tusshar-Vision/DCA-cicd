<div class="flex h-20 items-center justify-between">
    <div class="w-3/4">
        <ul class="flex">
            <li class="font-semibold pr-6">
                <a href="{{ route('home') }}" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 21.0002H5C4.44772 21.0002 4 20.5525 4 20.0002V11.0002H1L11.3273 1.61174C11.7087 1.265 12.2913 1.265 12.6727 1.61174L23 11.0002H20V20.0002C20 20.5525 19.5523 21.0002 19 21.0002ZM13 19.0002H18V9.15769L12 3.70314L6 9.15769V19.0002H11V13.0002H13V19.0002Z" fill="#005FAF"/>
                    </svg>
                </a>
            </li>
            <div class="flex" x-data="{ isNewsOpen: false, isMagazineOpen: false, isWeeklyFocusOpen: false }">
                @foreach ($initiatives as $initiative)

                    @if ($initiative->path === '/news-today')
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @mouseenter="isNewsOpen = true;
                                             isMagazineOpen = false;
                                             isWeeklyFocusOpen = false;
                                             " 
                                @mouseleaves="isNewsOpen = false" 
                            >
                                <a class="hover:text-visionRed {{ request()->is(trim($initiative->path, '/')) ? 'text-visionRed' : '' }}" href="{{ $initiative->path }}" wire:navigate>{{ $initiative->name }}</a>
                            </li>  

                            <x-drop-down-menu 
                                x-show="isNewsOpen"
                                @click.away="isNewsOpen = false" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                button-text="Today's News"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('archive.daily-news') }}"
                                :publishedInitiatives="$publishedInitiatives->where('initiative_id', $initiative->id)"
                            />
                        </div>
                    @elseif ($initiative->path === '/monthly-magazine')
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @mouseenter="isMagazineOpen = true;
                                             isNewsOpen = false;
                                             isWeeklyFocusOpen = false;
                                             " 
                                @mouseleaves="isMagazineOpen = false" 
                            >
                                <a class="hover:text-visionRed {{ request()->is(trim($initiative->path, '/')) ? 'text-visionRed' : '' }}" href="{{ $initiative->path }}" wire:navigate>{{ $initiative->name }}</a>
                            </li>  

                            <x-drop-down-menu 
                                x-show="isMagazineOpen"
                                @click.away="isMagazineOpen = false" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                button-text="This Month's Magazine"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('archive.monthly-magazine') }}"
                                :publishedInitiatives="$publishedInitiatives->where('initiative_id', $initiative->id)"
                            />
                        </div>
                    @elseif ($initiative->path === '/weekly-focus')
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @mouseenter="isWeeklyFocusOpen = true;
                                             isMagazineOpen = false;
                                             isNewsOpen = false;
                                             " 
                                @mouseleaves="isWeeklyFocusOpen = false" 
                            >
                                <a class="hover:text-visionRed {{ request()->is(trim($initiative->path, '/')) ? 'text-visionRed' : '' }}" href="{{ $initiative->path }}" wire:navigate>{{ $initiative->name }}</a>
                            </li>  

                            <x-drop-down-menu 
                                x-show="isWeeklyFocusOpen"
                                @click.away="isWeeklyFocusOpen = false" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                button-text="This Week's Focus"
                                button-link="{{ $initiative->path }}"
                                archive-link="{{ route('archive.weekly-focus') }}"
                                :publishedInitiatives="$publishedInitiatives->where('initiative_id', $initiative->id)"
                            />
                        </div>
                    @else
                        <li class="font-semibold pr-6">
                            <a class="hover:text-visionRed {{ request()->is(trim($initiative->path, '/')) ? 'text-visionRed' : '' }}" href="{{ $initiative->path }}" wire:navigate>{{ $initiative->name }}</a>
                        </li>    
                    @endif
                    
                @endforeach
            </div>
        </ul>
    </div>

    <div class="flex-grow">
        <x-search-box />
    </div>
</div>