@php
    use Illuminate\Support\Str;
    use App\Services\ArticleService;
    $currentTopic = request()->segment(3);
    $currentArticle = request()->segment(4);
    $date = request()->segment(2);
@endphp

<div class="flex flex-col rounded pb-4 dark:bg-dark373839" x-cloak>
    <div class="my-4 mx-6" x-data="{ expanded: null, isOpen: true }" x-init="expanded = 'topic-{{ Str::slug($currentTopic) }}'; isOpen = window.innerWidth > 768">

        <div @click="isOpen = !isOpen" class="flex border-bottom justify-between items-start cursor-pointer" >
            <div>
                <h4 class="font-bold text-base[16px] pb-[16px]">Table of Content</h4>
            </div>
            <div class="mt-0.5" :class="{ 'rotate-180' : isOpen }">
                {!! \App\Helpers\SvgIconsHelper::getSvgIcon('arrow-down') !!}
            </div>
        </div>

        @foreach ($topics as $topic)
            @php
                $topicSlug = Str::slug(str_replace('&', 'and', $topic));
                $topicHeading = $formatString($topic);
                $newsInShort = false;
            @endphp
            <div x-show="isOpen" class="mt-4" x-transition>
                <button class="flex justify-between items-center w-full" @click="
                    if (expanded === 'topic-{{ $topicSlug }}') expanded = false;
                    else expanded = 'topic-{{ $topicSlug }}'
                ">
                    <div x-show="expanded === 'topic-{{ $topicSlug }}'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                <strong>
                                    {{ $loop->iteration . '.' }}
                                </strong>
                            </div>
                            <div class="text-left">
                                <strong>
                                    {{ $topicHeading }}
                                </strong>
                            </div>
                        </div>
                        <div class="w-6 h-6 flex-shrink-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
                            </svg>
                        </div>
                    </div>
                    <div x-show="expanded !== 'topic-{{ $topicSlug }}'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                {{ $loop->iteration . '.' }}
                            </div>
                            <div class="text-left">
                                {{ $topicHeading }}
                            </div>
                        </div>
                        <div class="w-6 h-6 flex-shrink-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
                            </svg>
                        </div>
                    </div>
                </button>

                <div x-show="expanded === 'topic-{{ $topicSlug }}'" x-collapse>
                    <ul class="mt-2 space-y-4 ml-6">
                        @foreach ($articles[$topic] as $article)
                            @if (!$article->is_short)
                                <li class="text-clip text-sm">
                                    <a href="{{ ArticleService::getArticleUrlFromSlug($article->slug) }}" class="cursor-pointer hover:underline {{ ($article->slug === $currentArticle) ? 'font-bold' : '' }}" wire:navigate>
                                        {{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ $article->shortTitle ?? $article->title }}
                                    </a>
                                </li>
                                @if($article->slug === $currentArticle)
                                    @foreach($tableOfContent as $key => $header)
                                        <ul class="ml-6">
                                            <li class="text-clip text-sm">
                                                <a href="{{$header['link']}}"
                                                   class="cursor-pointer hover:underline">
                                                    {{ $loop->parent->parent->iteration }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ strip_tags($header['text']) }}
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                @endif
                            @else
                                @if (!$newsInShort)
                                    <li class="text-clip text-sm">
                                        <a href="{{ route('monthly-magazine.newsInShorts', ['date' => $date, 'topic' => $topic]) }}"
                                           class="cursor-pointer hover:underline {{ request()->is('monthly-magazine/*/' . $topic  . '/news-in-shorts') ? 'font-bold' : '' }}" wire:navigate>
                                            {{ $loop->parent->iteration }}.{{ $loop->iteration }} News in Shorts
                                        </a>
                                    </li>
                                    @php $newsInShort = true; @endphp
                                    @if(request()->is('monthly-magazine/*/' . $topic  . '/news-in-shorts'))
                                        <ul class="ml-6">
                                            @foreach($shortArticles as $index => $article)
                                                <li @click="openItem = (openItem == {{$index}} ? '-1' : {{$index}})"
                                                    class="py-[5px] cursor-pointer hover:brand-color text-clip text-sm"
                                                    :class="{'brand-color': openItem == {{$index}}}">
                                                    <a class="flex text-base[16px] font-normal hover:brand-color }}">
                                                        <span class="mr-1">
                                                            {{ $loop->parent->parent->iteration }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                                        </span>
                                                        {{ $article->shortTitle ?? $article->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>

                @if(!$loop->last)
                    <svg class="mt-4" width="296" height="2" viewBox="0 0 296 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2" d="M0 1H296" stroke="#8F93A3"/>
                    </svg>
                @endif
            </div>
        @endforeach
    </div>
</div>
