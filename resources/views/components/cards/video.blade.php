<div class="w-full mb-4">
    @if($source?->is_url)
        @php
            $mediaEmbed = new MediaEmbed\MediaEmbed();
            $mediaObject =  $mediaEmbed->parseUrl($source->url);
            if ($mediaObject) {
                $mediaObject->setParam([
                    'origin' => config('app.url')
                ]);
                $mediaObject->setAttribute([
                    'type' => null,
                    'class' => 'videoEmbed',
                ]);
                echo "<div class='max-w-[100%] min-h-52 mt-4 overflow-hidden'>";
                    echo $mediaObject->getEmbedCode();
                echo "</div>";
            }
        @endphp
    @else
        <video class="video" width="100%" controls>
            <source src="{{ $source?->media?->first()?->getTemporaryUrl(now()->add('minutes', 120)) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif

    <p class="font-semibold text-base text-justify">{{ $source?->title }}</p>
</div>
