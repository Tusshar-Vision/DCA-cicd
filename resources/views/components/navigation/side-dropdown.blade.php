<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bg-visionGray shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        @foreach ($getDataToRender as $key => $value)
            <li>
                <a href="{{ $initiativeId == 3 ? route('weekly-focus.article', ['topic' => $value['topic'], 'article_slug' => $value['slug']]) : route('monthly-magazine-of-month.article', ['month' => "2023-12"]) }}" class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray">
                    <span class="ml-2 font-medium">{{ $initiativeId == 3 ? $value['title'] : $value }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
