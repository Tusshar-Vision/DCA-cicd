<div>
    <x-containers.grid-wide>
        <x-common.sub-heading class="my-5">{{ $year }}</x-common.sub-heading>

        <div class="card-listing">
            @foreach($downloadableFiles as $value)
                <x-cards.download title="{{ $value->name ?? $value->media->name }}" url="{{ route('download', ['media' => $value->media[0]]) }}"/>
            @endforeach
        </div>
    </x-containers.grid-wide>
</div>
