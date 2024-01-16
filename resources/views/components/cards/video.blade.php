<div>
    @if($source->is_url)
        @php
            $mediaEmbed = new MediaEmbed\MediaEmbed();
            $mediaObject =  $mediaEmbed->parseUrl($source->url);
            $mediaObject->setWidth(320, true);

            echo $mediaObject->getEmbedCode();
        @endphp
    @else
        <video width="320" controls>
            <source src="{{ $source->media->first()->getTemporaryUrl(now()->add('minutes', 120)) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif

    <p class="font-bold text-base mt-2">{{ $source->title }}</p>
</div>
