<div class="w-full">
    @if($source->is_url)
        @php
            $mediaEmbed = new MediaEmbed\MediaEmbed();
            $mediaObject =  $mediaEmbed->parseUrl($source->url);
            echo "<div class='max-w-[100%] max-h-52'>";
                echo $mediaObject->getEmbedCode();
            echo "</div>"
        @endphp
    @else
        <video width="100%" controls>
            <source src="{{ $source->media->first()->getTemporaryUrl(now()->add('minutes', 120)) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif

    <p class="font-semibold text-base mt-2 text-justify">{{ $source->title }}</p>
</div>
