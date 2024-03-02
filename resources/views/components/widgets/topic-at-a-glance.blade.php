<div {{ $attributes }} class="flex flex-col rounded bg-visionGray {{ $infographic === null ? 'opacity-50 pointer-events-none' : '' }}" @click="isTopicAtGlanceOpen = !isTopicAtGlanceOpen">
    <div class="my-6 mx-6">
        <a href="javascript:void(0)">
            <div class="flex items-center justify-between">
                <div class="flex justify-start items-center">
                    <div class="mr-2">
                        @if ($infographic !== null)
                            <img src="{{ $infographic?->media?->first()?->getTemporaryUrl(now()->add('minutes', 120)) }}" width="60" height="50" alt="">
                        @endif
                    </div>
                    <span class="font-medium">
                        Topic at a Glance
                    </span>
                </div>
            </div>
        </a>
    </div>
</div>
