@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.value-added-material :data="$data" />
@endsection
