<div class="flex h-20 items-center justify-between">
    <div class="w-3/4">
        <ul class="flex">
            @foreach ($initiatives as $initiative)
                <li class="font-semibold pr-8">
                    <a href="{{ $initiative->path }}">{{ $initiative->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="flex-grow">
        <x-search-box />
    </div>
</div>