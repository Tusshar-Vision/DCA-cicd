@extends('layouts.archive')
@section('title', 'Mains 365 | Current Affairs')

@section('content')
    @foreach($downloadableFiles as $year => $data)
        <x-widgets.download-section year="{{ $year }}" :downloadableFiles="$data" />
    @endforeach
@endsection
