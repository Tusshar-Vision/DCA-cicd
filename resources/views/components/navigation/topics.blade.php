@php
    use Carbon\Carbon;
    $currentTopic = request()->segment(3);
@endphp

<div class="flex items-center">
    <ul class="flex h-10 text-white items-center bg-visionBlue space-x-4 whitespace-nowrap pr-4">
        <li>
            <p class="text-sm font-bold pl-2">{{ Carbon::parse($publishedDate)->format('F Y') }}</p>
        </li>
        <li>
            <svg class="bg-white" width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 1H15"/>
            </svg>
        </li>
    </ul>
    <ul id="topic-bar" class="flex h-10 text-white items-center bg-visionBlue space-x-8 whitespace-nowrap overflow-x-auto pr-4">
        <li>
            @foreach ($topics as $topic)
                @php
                    $articleSlug = $topic->first()->slug;
                    $topicName = $topic->first()->topic;
                @endphp
                <a
                    class="mr-4 inline-block {{ ($topicName === $currentTopic) ? 'font-bold active' : '' }}"
                    href="{{ \App\Services\ArticleService::getArticleUrlFromSlug($articleSlug) }}"
                    wire:navigate
                >
                    {{ $formatString($topicName) }}
                </a>
            @endforeach
        </li>
    </ul>
</div>
<script>
    document.addEventListener('livewire:navigated', () => {
        let topicBar = document.querySelector('#topic-bar');
        let element = document.querySelector('.active');
        if (element) {
            setTimeout(() => {
                topicBar.scrollTo({
                    left: element.offsetLeft - topicBar.offsetLeft,
                    behavior: 'smooth'
                });
            }, 200);
        }
    }, {once: true});
</script>

