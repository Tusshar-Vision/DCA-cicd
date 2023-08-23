<div {{ $attributes }}>
    <ul class="absolute font-normal bg-visionGray shadow overflow-hidden rounded-sm w-72 border mt-2 py-1 z-20">

        <x-menu-button button-text="{!! $buttonText !!}" button-link="{{ $buttonLink }}" />

        @for ($year = 2023; $year > 2014; $year--) 
            <li>
                <a href="#" class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray">
                    <span class="ml-2 font-medium">{{ $year }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M12.1717 12.0005L9.34326 9.17203L10.7575 7.75781L15.0001 12.0005L10.7575 16.2431L9.34326 14.8289L12.1717 12.0005Z" fill="#8F93A3"/>
                    </svg>
                </a>
            </li>
        @endfor

        <x-menu-button button-text="View All" button-link="{{ $archiveLink }}"/>
    </ul>
</div>