@php
    use App\Services\ArticleService;
    $currentArticle = request()->segment(4);
    $date = request()->segment(2);
    $initiative = request()->segment(1);
@endphp

<div
    x-data="{ isOpen: true }"
    x-init="isOpen = window.innerWidth > 768"
    class="flex flex-col rounded pb-4 lg:mt-10 mt-0 dark:bg-[#373839] dark:text-white"
    x-cloak
>

    <div class="my-4 mx-6">

        <div @click="isOpen = !isOpen" class="flex border-bottom justify-between items-start cursor-pointer" >
            <div>
                <h4 class="font-bold text-base[16px] pb-[16px]">Table of Content</h4>
            </div>
            <div class="mt-0.5" :class="{ 'rotate-180' : isOpen }">
                {!! \App\Helpers\SvgIconsHelper::getSvgIcon('arrow-down') !!}
            </div>
        </div>

        <div id="table-of-content" x-show="isOpen" class="h-auto lg:h-[220px] customScroll overflow-y-auto" x-transition>
            <ul class="list-none ml-0">
                <?php $i = 0; ?>
                @foreach($tableOfContent as $key => $header)
                       @if($initiative == 'weekly-focus')
                            <li @click="openItem = (openItem == {{$key}} ? '-1' : {{$key}})" class="py-[15px] cursor-pointer border-bottom last:border-0 hover:brand-color">
                                <a href="#{{ $header->slug }}" class="flex text-base[16px] font-normal hover:brand-color }}"
                                   :class="{'brand-color': openItem == {{$key}}}"
                                >
                                    <span class="mr-1">{{ $loop->iteration }}<em>.</em></span> {{ $header->shortTitle ?? $header->title }}
                                </a>
                            </li>
                        @else
                            @php
                                $articleURL = ArticleService::getArticleUrlFromSlug($header->slug);
                            @endphp
                            @if ($articleURL !== null)
                                <li class="py-[15px] cursor-pointer border-bottom last:border-0 hover:brand-color">
                                    <a href="{{ $articleURL }}"
                                       wire:navigate
                                       class="flex text-base[16px] font-normal hover:brand-color {{ ($header->slug === $currentArticle) ? 'brand-color current-article' : '' }}"
                                    >
                                        <span class="mr-1">{{ $loop->iteration }}<em>.</em></span> {{ $header->shortTitle ?? $header->title }}
                                    </a>
                                </li>
                            @endif
                       @endif
                    <?php $i = $loop->iteration; ?>
                @endforeach
                @if($isAlsoInNews)
                    <li class="py-[15px] border-bottom last:border-0 hover:brand-color">
                        <a href="{{ route('news-today.alsoInNews', ['date' => $date]) }}"
                           wire:navigate
                           class="flex text-base[16px] font-normal hover:brand-color {{ request()->is('news-today/*/also-in-news') ? 'brand-color current-article' : '' }}"
                        >
                            <span class="mr-1">{{ $i }}<em>.</em></span>Also in News
                        </a>
                    </li>
                    @if(request()->is('news-today/*/also-in-news'))
                        <ul class="ml-6">
                            @foreach($shortArticles as $index => $article)
                                <li class="py-[5px] cursor-pointer hover:brand-color text-clip text-sm">
                                    <a href="#{{ $article->slug }}" class="flex text-base[16px] font-normal hover:brand-color"
                                       :class="{'brand-color': openItem == {{$index}}}"
                                    >
                                        <span class="mr-1">
                                            {{ $i . '.' . $loop->iteration }}
                                        </span>
                                        {{ $article->shortTitle ?? $article->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:navigated', () => {
            let sideBar = document.querySelector('#table-of-content');
            let element = document.querySelector('.current-article');
            if (element) {
                setTimeout(() => {
                    sideBar.scrollTo({
                        top: element.offsetTop - sideBar.clientHeight,
                        behavior: 'smooth'
                    });
                }, 200);
            }
        }, {once: true});
    </script>
</div>
