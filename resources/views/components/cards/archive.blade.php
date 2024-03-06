<div class="weekly-focus-single-card">
    <div class="weekly-focus-progress-list mt-0">
        <a href="{{ $url }}" wire:navigate>
            <div class="weekly-focus-progress-single-bar border-b-2">
                <p>{{$title}}</p>
                {{-- <div class="progress-bar"> --}}
                {{-- <div class="bar" style="width:100%; background-color: #89D38C;"> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                <ul class="flex justify-start mt-[15px]">
                    <li class="text-[#3362CC] text-sm font-normal mr-4">
                        <a href="{{ $url }}" class="hover:underline ml-0" wire:navigate>Read</a>
                    </li>
                    @if (!empty($downloadLink))
                        <li class="text-[#3362CC] text-sm font-normal mr-4">
                            <a href="{{ route('download', ['media' => $downloadLink]) }}" class="hover:underline">Download</a>
                        </li>
                    @endif
                </ul>
            </div>
        </a>
    </div>
</div>
