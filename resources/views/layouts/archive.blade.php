@extends('layouts.base')

@section('content')
    <div class="flex w-full gap-6 mt-0 lg:mt-[10px] relative min-h-[460px] xl:min-h-[700px]">
        <livewire:navigation.archive-sidebar />
        @yield('archive-content')
    </div>
@endsection
