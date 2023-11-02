<div>
    <x-containers.grid-wide>
        <x-common.sub-heading class="my-5">{{ $year }}</x-common.sub-heading>

        <div class="card-listing">
            @foreach([1,2,3,4,5,6,7] as $value)
                <x-cards.download title="Government Schemes Comprehensive Part 2"/>
                <x-cards.download title="Government Schemes in News"/>
            @endforeach
        </div>
    </x-containers.grid-wide>
</div>
