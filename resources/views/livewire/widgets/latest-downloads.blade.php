<div class="col-span-2">
    <div class="vi-title-wrap">
        <h5 class="vi-title">{{__('home_page.latest_downloads')}}</h5>
        <a href="{{ route('downloads') }}" class="vi-view-all">{{__('home_page.view_all')}}l</a>
    </div>

    <div class="grid grid-cols-1fr md:grid-cols-2 gap-4">
        @foreach($latestDownloads as $file)
            <x-cards.file-download :file="$file" />
        @endforeach
    </div>
</div>
