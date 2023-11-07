@php
    $counter = 1;
@endphp

<div class="flex flex-col rounded bg-visionGray pb-4">
    <div class="my-4 mx-6" x-data="{ expanded: @entangle('current_topic') }">
        @foreach ($topics as $topic)
            <div class="mt-4">
                <button class="flex justify-between items-center w-full" @click="
                    if(expanded === 'topic-{{ $topic }}') expanded = false;
                    else expanded = 'topic-{{ $topic }}'
                ">
                    <div x-show="expanded === 'topic-{{ $topic }}'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                <strong>
                                    {{ $counter . '.' }}
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
                    <div x-show="expanded !== 'topic-{{ $topic }}'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                {{ $counter++ . '.' }}
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

                <div x-show="expanded === 'topic-{{ $topic }}'" x-collapse>
                    <ul class="space-y-4">
                        @foreach ($articles as $article)
                            @if($article->topic === $topic)
                                <li class="text-clip text-sm">
                                    <a href="{{ \App\Services\ArticleService::getArticleURL($article) }}" class="cursor-pointer hover:underline">{{ $article->title }}</a>
                                </li>
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
