@extends('layouts.base')
@section('title', $title . ' | Current Affairs')

@section('content')
    <x-containers.grid-wide class="mt-6">
        <h2 class="text-[40px] text-[#040404] mb-4">{{ $title }}</h2>
        @yield('videos')
    </x-containers.grid-wide>
@endsection
