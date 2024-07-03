<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bgcolor-FFF shadow rounded-md w-80 border mt-2 py-1 z-20 -top-2 left-full">
        <li class="grid grid-cols-7 gap-1 justify-items-center py-[20px] px-[20px]">
            @foreach ($getDataToRender as $key => $value)
                <a href="{{ route('news-today-date-wise', ['date' => $menuData[0]."-".$value]) }}" class="px-1 py-1">
                    <span class="font-medium">{{ $value }}</span>
                </a>
            @endforeach
        </li>
    </ul>
</div>
