@php
    $media = $file->media->first();
    $fileViewLink = request()->url()."/".$media->id;
@endphp
<div @click='Livewire.navigate("{{ $fileViewLink }}");' class="weekly-focus-single-card">
    <div class="weekly-focus-progress-list mt-0 h-full">
        <div class="weekly-focus-progress-single-bar border-b-2 flex flex-col justify-between">
            <div>
                <p class="break-all">{{ ucfirst($file->name ?? $media->name) }}</p>
            </div>
            <div>
                <ul class="flex justify-start mt-[15px]">
                    <li class="text-[#3362CC] mr-4 text-sm font-normal">
                        <a wire:navigate href="{{ $fileViewLink }}" class="hover:underline">Read</a>
                    </li>
                    <li class="text-[#3362CC] mr-4 text-sm font-normal">
                        <a href="{{ route('download', ['media' => $media]) }}" class="hover:underline">Download</a>
                    </li>
                    <li class="text-[#3362CC] mr-4 text-sm font-normal">
                        <a @click.stop onclick="openSocial('{{ $fileViewLink }}')" class="hover:underline">Share</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
