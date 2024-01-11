@extends('layouts.base')

{{-- @section('header')
    <x-header.archives title="{{ $title }}" />
@endsection --}}


@section('content')
    <div class="flex w-full gap-6 mt-0 lg:mt-[10px] relative">
        <livewire:navigation.archive-sidebar />
        @yield('archive-content')
    </div>
@endsection
