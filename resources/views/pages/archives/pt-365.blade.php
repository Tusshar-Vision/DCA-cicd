@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.pt365 :data="$data"/>
@endsection
