@use('App\Services\ArticleService')

<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bgcolor-FFF shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        @foreach ($getDataToRender as $key => $data)
            <li>
                <a href="{{ ArticleService::getArticleUrlFromSlug($data['slug']) }}"
                   class="flex items-center justify-between px-3 py-2 hover:brand-color hover:bgcolor-gray-F4F6FC"
                   wire:navigate
                >
                    <span class="ml-2 font-medium text-sm">
                        {{ $data['title'] }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
