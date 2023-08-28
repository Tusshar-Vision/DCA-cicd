<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bg-visionGray shadow rounded-sm w-80 border mt-2 py-1 z-20 -top-2 left-full">
        <li class="grid grid-cols-7 gap-1 justify-items-center">
            @for ($year = 1; $year <= 31; $year++)
                <a href="#" class="px-3 py-3 hover:bg-visionSelectedGray">
                    <span class="font-medium">{{ $year }}</span>
                </a>
            @endfor
        </li>  
    </ul>
</div>