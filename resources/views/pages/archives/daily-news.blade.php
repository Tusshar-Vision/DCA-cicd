@extends('layouts.archive')
@section('title', "Daily News Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.daily-news :articles="$data"/>
@endsection
