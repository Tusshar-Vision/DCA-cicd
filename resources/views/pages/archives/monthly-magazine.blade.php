@extends('layouts.archive')
@section('title', "Monthly Magazine Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.monthly-magazine-archive-section :articles="$data" />
@endsection
