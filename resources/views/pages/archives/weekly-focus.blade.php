@extends('layouts.archive')
@section('title', "Weekly Focus Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.weekly-focus :data="$data" />
@endsection
