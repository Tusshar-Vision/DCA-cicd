<div class="col-span-2">
    <div class="vi-title-wrap">
        <h5 class="vi-title">{{__('home_page.latest_downloads')}}</h5>
        <a href="{{ route('downloads') }}" class="vi-view-all">{{__('home_page.view_all')}}l</a>
    </div>

    <div class="columns-2 gap-4">
        @foreach([1,2,3,4,5,6] as $file)
            <x-cards.file-download />
        @endforeach
    </div>
</div>
