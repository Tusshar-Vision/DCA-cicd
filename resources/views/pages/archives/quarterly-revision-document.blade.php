@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.quarterly-revision-document :data="$data[1]" :years="$data[0]" :pdfUrl="$pdfUrl" />
@endsection
