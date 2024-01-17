<div>
    <div class="vi-title-wrap">
        <h5 class="vi-title">{{__('home_page.feature_videos')}}</h5>
        <a href="#" class="vi-view-all">{{__('home_page.view_all')}}</a>
    </div>

    <div class="grid gap-6 featureVideo">
        @foreach($latestVideos as $key => $video)
            <x-cards.video :source="$video" />
        @endforeach
    </div>
</div>
