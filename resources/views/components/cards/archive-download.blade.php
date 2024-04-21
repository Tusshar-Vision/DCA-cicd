<div class="weekly-focus-single-card" @click.stop>
    <div class="weekly-focus-progress-list mt-0 h-full">
        <a href="{{ route('view-file', ['media' => $file->media->first()]) }}">
            <div class="weekly-focus-progress-single-bar border-b-2 flex flex-col justify-between">
                <p class="break-all">{{ ucfirst($file->name ?? $file->media->first()->name) }}</p>
                <ul class="flex justify-start mt-[15px]">
                    <li class="text-[#3362CC] mr-4 text-sm font-normal">
                        <a href="{{ request()->url()."/".$file->id }}" class="hover:underline" >Read</a>
                    </li>
                    <li class="text-[#3362CC] mr-4 text-sm font-normal">
                        <a href="{{ route('download', ['media' => $file->media->first()]) }}" class="hover:underline">Download</a>
                    </li>
                </ul>
            </div>
        </a>
    </div>
</div>
