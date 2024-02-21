@extends('layouts.archive')
@section('title', "Daily News Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.archives.daily-news :articles="$data[1]" :years="$data[0]"/>
@endsection
