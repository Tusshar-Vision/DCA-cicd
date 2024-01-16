@extends('layouts.archive')
@section('title', "Weekly Focus Archive | Current Affairs")

@section('archive-content')
    {{-- <livewire:widgets.weekly-focus-archive-section :yearlyData="$yearlyData" :monthlyData="$monthlyData" :weeklyData="$weeklyData" /> --}}
        <livewire:widgets.weekly-focus-archive-section :data="$data" />
@endsection
