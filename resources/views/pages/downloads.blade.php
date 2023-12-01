@extends('layouts.archive')
@section('title', 'Downloads Page | Current Affairs')

@section('content')
    @foreach($downloadableFiles as $year => $data)
        <x-widgets.download-section year="{{ $year }}" :downloadableFiles="$data" />
    @endforeach
@endsection
