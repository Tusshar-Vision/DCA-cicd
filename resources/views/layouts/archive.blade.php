@extends('layouts.base')

@section('content')
    <div class="flex w-full gap-6 mt-0 lg:mt-[10px] relative">
        <livewire:navigation.archive-sidebar />
        @yield('archive-content')
    </div>
@endsection
