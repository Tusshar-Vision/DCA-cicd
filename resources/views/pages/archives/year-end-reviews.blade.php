@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
<livewire:widgets.archives.year-end-reviews :data="$data" />
@endsection