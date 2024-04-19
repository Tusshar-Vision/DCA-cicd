@php
    use Carbon\Carbon;
    $currentTopic = request()->segment(3);
@endphp

<ul class="flex h-10 text-white items-center bg-visionBlue space-x-8 whitespace-nowrap overflow-x-auto pr-4 scroll-style">
    <li>
        <p class="text-sm font-bold pl-2">{{ Carbon::parse($publishedDate)->format('F Y') }}</p>
    </li>
    <li>
        <svg class="bg-white" width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 1H15"/>
        </svg>
    </li>
    <li>
        @foreach ($topics as $topic)
            @php
                $articleSlug = $topic->first()->slug;
                $topicName = $topic->first()->topic;
            @endphp
            <a
                class="mr-4 inline-block {{ ($topicName === $currentTopic) ? 'font-bold' : '' }}"
                href="{{ \App\Services\ArticleService::getArticleUrlFromSlug($articleSlug) }}"
                wire:navigate
            >
                {{ $formatString($topicName) }}
            </a>
        @endforeach
    </li>
</ul>
