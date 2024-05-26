<div class="col-span-1 lg:col-span-1 xl:lg:col-span-2">
    <div class="vi-title-wrap">
        <h5 class="vi-title">{{__('home_page.latest_downloads')}}</h5>
        <a href="{{ route('downloads') }}" class="vi-view-all" wire:navigate>{{__('home_page.view_all')}}</a>
    </div>

    <div class="grid grid-cols-1fr grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4">
        @foreach($latestDownloads as $file)
            <x-cards.file-download :file="$file" />
        @endforeach
    </div>
</div>
