@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.value-added-material-optional :data="$data" :pdfUrl="$pdfUrl" />
@endsection
