@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.planet-vision :data="$data[1]" :years="$data[0]" />
@endsection
