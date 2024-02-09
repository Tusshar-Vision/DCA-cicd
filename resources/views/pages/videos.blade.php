@extends('layouts.base')
@section('title', 'Latest Videos | Current Affairs')

@section('content')
    <x-containers.grid-wide class="mt-6">
        <h2 class="text-[40px] text-[#040404] mb-4">Latest Videos</h2>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center mt-4 items-start">
            @foreach($latestVideos as $key => $video)
                <li class="min-h-[150px] flex items-center justify-center">
                    <x-cards.video :source="$video" />
                </li>
            @endforeach
        </ul>
    </x-containers.grid-wide>
@endsection
