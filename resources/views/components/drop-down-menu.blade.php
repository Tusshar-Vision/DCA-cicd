@php
    use Carbon\Carbon;
@endphp

<div {{ $attributes }}>
    <ul x-data="{ isMenuOpen: null }" class="absolute font-normal bg-visionGray shadow rounded-sm w-72 border mt-2 py-1 z-20">
        <x-menu-button button-text="{!! $buttonText !!}" button-link="{{ $buttonLink }}" />
            @foreach ($publishedInitiatives as $key => $initiative)
                <li class="relative">
                    <a  href="#" 
                        class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray"
                        @mouseenter="isMenuOpen = 'menu{{ $initiative->initiative_id . $key }}'" 
                        @click.outside="isMenuOpen = null" 
                    >
                        <span class="ml-2 font-medium">
                            {{ ($initiative->initiative_id != 2) 
                                ? Carbon::parse($initiative->published_at)->format('F Y') 
                                : Carbon::parse($initiative->published_at)->format('Y') 
                            }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12.1717 12.0005L9.34326 9.17203L10.7575 7.75781L15.0001 12.0005L10.7575 16.2431L9.34326 14.8289L12.1717 12.0005Z" fill="#8F93A3"/>
                        </svg>
                    </a>

                    @if ($initiative->initiative_id === 1)
                        <x-side-drop-down-calender 
                            x-show="isMenuOpen === 'menu{{ $initiative->initiative_id . $key }}'" 
                            :publishedInitiative="$initiative"
                        />
                    @else
                        <x-side-drop-down-menu 
                            x-show="isMenuOpen === 'menu{{ $initiative->initiative_id . $key }}'" 
                            :publishedInitiative="$initiative"
                        />
                    @endif
                </li>
            @endforeach  
        <x-menu-button button-text="View All" button-link="{{ $archiveLink }}"/>
    </ul>
</div>