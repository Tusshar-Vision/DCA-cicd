@extends('layouts.archive')
@section('title', "Monthly Magazine Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.monthly-magazine :articles="$data" />
@endsection
