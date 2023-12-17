@php
    use Carbon\Carbon;
    use App\Helpers\InitiativesHelper;
    use App\Enums\Initiatives;
@endphp

<div {{ $attributes }} x-cloak>

    <ul x-data="{ isMenuOpen: null }" class="absolute font-normal bgcolor-FFF shadow w-72 border rounded-md mt-2 py-1 z-50">
        <x-buttons.primary button-text="{!! $buttonText !!}" button-link="{{ $buttonLink }}" class="border-bottom" />
            @foreach ($menuData['data'] as $mainMenu => $subMenu)
                @if(!empty($subMenu))
                    <li class="relative">
                        <a  href="#"
                            class="flex items-center justify-between mx-4 py-3 hover:brand-color hover:bgcolor-gray-F4F6FC firstlabelMenu"
                            @mouseenter="isMenuOpen = 'menu{{ $menuData['initiative_id'] . $loop->iteration }}'"
                            @click.outside="isMenuOpen = null"
                        >
                            <span class="px-4 font-medium">
                                {{ ($menuData['initiative_id'] != InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
                                    ? Carbon::parse($mainMenu)->format('F Y')
                                    : $mainMenu
                                }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12.1717 12.0005L9.34326 9.17203L10.7575 7.75781L15.0001 12.0005L10.7575 16.2431L9.34326 14.8289L12.1717 12.0005Z" fill="#8F93A3"/>
                            </svg>
                        </a>

                        @if ($menuData['initiative_id'] === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
                            <x-navigation.side-dropdown
                                x-show="isMenuOpen === 'menu{{ $menuData['initiative_id'] . $loop->iteration }}'"
                                :menuData="[$mainMenu,$subMenu]"
                                :initiativeId="$menuData['initiative_id']"
                            />
                        @else
                            <x-navigation.side-dropdown
                                x-show="isMenuOpen === 'menu{{ $menuData['initiative_id'] . $loop->iteration }}'"
                                :menuData="$subMenu"
                                :initiativeId="$menuData['initiative_id']"
                            />
                        @endif
                    </li>
                @endif
            @endforeach
        <x-buttons.primary button-text="View All" button-link="{{ $archiveLink }}" class="border-top text-sm"/>
    </ul>
</div>
