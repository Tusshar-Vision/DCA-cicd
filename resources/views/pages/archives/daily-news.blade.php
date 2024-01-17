@extends('layouts.archive')
@section('title', "Daily News Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.daily-news-archive-section :articles="$data"/>
@endsection
