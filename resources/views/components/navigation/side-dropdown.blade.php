<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bg-visionGray shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        @foreach ($getDataToRender as $key => $value)
            <li>
                <a href="#" class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray">
                    <span class="ml-2 font-medium">{{ $value }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
