@extends('layouts.archive')
@section('title', "Monthly Magazine Archive | Current Affairs")

@section('content')
    <x-containers.grid-wide class="mt-[32px]">
    <div class="columns-4 gap-6">
        <livewire:widgets.monthly-focus year="2023"/>
        <livewire:widgets.monthly-focus year="2022"/>
        <livewire:widgets.monthly-focus year="2021"/>
        <livewire:widgets.monthly-focus year="2020"/>
    </div>
    </x-containers.grid-wide>
@endsection
