<div class="space-y-6 mt-[25px] lg:mt-0">
    <div>
        <h1 class="text-lg font-bold">RELATED VIDEOS</h1>
    </div>

    <div class="flex flex-col space-y-5">
        @foreach($relatedVideos as $key => $video)
            <div class="flex space-x-2">
                @if($video->video->is_url)
                    @php
                        $mediaEmbed = new MediaEmbed\MediaEmbed();
                        $mediaObject =  $mediaEmbed->parseUrl($video->video->url);
                        echo "<div class='max-w-36 max-h-36'>";
                            echo $mediaObject->getEmbedCode();
                        echo "</div>"
                    @endphp
                @else
                    <video width="100%" class="max-w-36" controls>
                        <source src="{{ $video->video->media->first()->getTemporaryUrl(now()->add('minutes', 120)) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
                <div>
                    <p class="text-sm">{{ $video->video->description ?? $video->video->title }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
