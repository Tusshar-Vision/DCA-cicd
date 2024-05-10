@extends('layouts.video-ecosystem')

@section('videos')
    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-center mt-4 items-start">
        @foreach($videos as $video)
            <li class="min-h-[150px] flex items-center justify-center">
                <x-cards.video :source="$video->video" :name="$video->name" />
            </li>
        @endforeach
    </ul>
@endsection
