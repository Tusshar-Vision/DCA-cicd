<div class="col-span-2">
    <div class="vi-title-wrap">
        <h5 class="vi-title">Latest Downloads</h5>
        <a href="#" class="vi-view-all">View All</a>
    </div>

    <div class="columns-2 gap-4">
        @foreach([1,2,3,4,5,6] as $file)
            <x-cards.file-download />
        @endforeach
    </div>
</div>
