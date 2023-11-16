@php
    $testSource = "https://www.shutterstock.com/shutterstock/videos/1084218295/preview/stock-footage-futuristic-animated-concept-big-data-center-chief-technology-officer-using-laptop-standing-in.webm";
    $testTitle = "Stock Video For Testing";
@endphp
<div>
    <div class="vi-title-wrap">
        <h5 class="vi-title">Feature Videos</h5>
        <a href="#" class="vi-view-all">View All</a>
    </div>

    <div class="grid gap-6">
        @foreach([1, 2] as $video)
            <x-cards.video :source="$testSource" :video-title="$testTitle" />
        @endforeach
    </div>
</div>
