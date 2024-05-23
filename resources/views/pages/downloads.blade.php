@extends('layouts.archive')
@section('title', 'Latest Downloads | Current Affairs')

@php
    $initiativeCardsData = config('initiatives');
@endphp

@section('content')
    <x-containers.grid-wide class="mt-6">
        <x-common.section-heading>Latest Downloads</x-common.section-heading>
    </x-containers.grid-wide>
    <div class="grid grid-cols-1 md:grid-cols-4 xl:grid-cols-5 gap-4 mt-10">
        @foreach($initiativeCardsData as $key => $data)
            @if($data['downloadable'] === true)
                <x-cards.initiative
                    icon="{{ $data['icon'] ?? '' }}"
                    title="{{ $data['title'] }}"
                    description="{{ $data['description'] }}"
                    link="{{ $key }}"
                    navigate="true"
                />
            @endif
        @endforeach
    </div>
@endsection
