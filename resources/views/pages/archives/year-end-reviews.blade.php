@extends('layouts.archive')
@section('title', $title . " | Current Affairs")

@section('archive-content')
<livewire:widgets.archives.year-end-reviews :data="$data[1]" :years="$data[0]" :pdfUrl="$pdfUrl" />
@endsection