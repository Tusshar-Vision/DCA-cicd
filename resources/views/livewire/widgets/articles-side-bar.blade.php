@php
    use Illuminate\Support\Str;
    use App\Services\ArticleService;
    $currentTopic = request()->segment(3);
    $currentArticle = request()->segment(4);
@endphp

<div class="flex flex-col rounded bg-visionGray pb-4">
    <div class="my-4 mx-6" x-data="{ expanded: null }" x-init="expanded = 'topic-{{ Str::slug($currentTopic) }}'">
        @foreach ($topics as $topic)
            <div class="mt-4">
                <button class="flex justify-between items-center w-full" @click="
                    if(expanded === 'topic-{{ Str::slug($topic->name) }}') expanded = false;
                    else expanded = 'topic-{{ Str::slug($topic->name) }}'
                ">
                    <div x-show="expanded === 'topic-{{ Str::slug($topic->name) }}'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                <strong>
                                    {{ $loop->iteration . '.' }}
                                </strong>
                            </div>
                            <div>
                                <strong>
                                    {{ $topic->name }}
                                </strong>
                            </div>
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
                        </svg>
                    </div>
                    <div x-show="expanded !== 'topic-{{ Str::slug($topic->name) }}'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                {{ $loop->iteration . '.' }}
                            </div>
                            <div>
                                {{ $topic->name }}
                            </div>
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
                        </svg>
                    </div>

                </button>

                <div x-show="expanded === 'topic-{{ Str::slug($topic->name) }}'" x-collapse>
                    <ul class="mt-2 space-y-4 ml-6">
                        @foreach ($articles[$topic->name] as $article)
                            <li class="text-clip text-sm">
                                <a href="{{ ArticleService::getArticleURL($article) }}" class="cursor-pointer hover:underline {{ ($article->slug === $currentArticle) ? 'font-bold' : '' }}" wire:navigate>
                                    {{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ $article->title }}
                                </a>
                            </li>
                            @if($article->slug === $currentArticle)
                                @foreach($tableOfContent as $key => $header)
                                    <ul class="ml-6">
                                        <li class="text-clip text-sm">
                                            <a href="#header-{{$header['id']}}"
                                               class="cursor-pointer hover:underline">
                                                    {{ $loop->parent->parent->iteration }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ strip_tags($header['header']) }}
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach
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
