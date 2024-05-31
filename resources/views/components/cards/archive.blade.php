<div @click='Livewire.navigate("{{ $url }}");' class="weekly-focus-single-card">
    <div class="weekly-focus-progress-list mt-0 h-full">
        <div class="weekly-focus-progress-single-bar border-b-2 flex flex-col justify-between">
            <div>
                <p class="break-all">{{$title}}</p>
            </div>
            {{-- <div class="progress-bar"> --}}
            {{-- <div class="bar" style="width:100%; background-color: #89D38C;"> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <div>
                <ul class="flex justify-start mt-[15px]">
                    <li class="text-[#3362CC] text-sm font-normal mr-4">
                        <a href="{{ $url }}" class="hover:underline ml-0" wire:navigate>Read</a>
                    </li>
                    @if (!empty($downloadLink))
                        <li class="text-[#3362CC] text-sm font-normal mr-4">
                            <a @click.stop href="{{ route('download', ['media' => $downloadLink]) }}" class="hover:underline">Download</a>
                        </li>
                    @else
                        <li class="text-[#3362CC] text-sm font-normal mr-4">
                            <a href="#" class="hover:underline opacity-50 pointer-events-none">Download</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
