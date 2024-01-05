@php
    $testSource = "https://www.shutterstock.com/shutterstock/videos/1084218295/preview/stock-footage-futuristic-animated-concept-big-data-center-chief-technology-officer-using-laptop-standing-in.webm";
    $testTitle = "Stock Video For Testing";
@endphp
<div>
    <div class="vi-title-wrap">
        <h5 class="vi-title">{{__('home_page.feature_videos')}}</h5>
        <a href="#" class="vi-view-all">{{__('home_page.view_all')}}</a>
    </div>

    <div class="grid gap-6 featureVideo">
        @foreach([1, 2] as $video)
            <x-cards.video :source="$testSource" :video-title="$testTitle" />
        @endforeach
    </div>
</div>
