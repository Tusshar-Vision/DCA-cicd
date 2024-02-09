<div>
    @if($source->is_url)
        @php
            $mediaEmbed = new MediaEmbed\MediaEmbed();
            $mediaObject =  $mediaEmbed->parseUrl($source->url);
            echo "<div class='max-w-96 max-h-52 min-w-80 min-h-52'>";
                echo $mediaObject->getEmbedCode();
            echo "</div>"
        @endphp
    @else
        <video width="320" controls>
            <source src="{{ $source->media->first()->getTemporaryUrl(now()->add('minutes', 120)) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif

    <p class="font-bold text-base mt-2">{{ $source->title }}</p>
</div>
