<div>
    <div class="vi-title-wrap">
        <h5 class="vi-title">{{__('home_page.feature_videos')}}</h5>
        <a href="{{ route('videos') }}" class="vi-view-all" wire:navigate>{{__('home_page.view_all')}}</a>
    </div>

    <div class="flex flex-col sm:flex-row sm:space-x-6 lg:flex-col lg:space-x-0 featureVideo">
        @foreach($latestVideos as $key => $video)
            <x-cards.video :source="$video->video" />
        @endforeach
    </div>
</div>
