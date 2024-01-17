@extends('layouts.archive')
@section('title', "Daily News Archive | Current Affairs")

@section('archive-content')
    <livewire:widgets.mains-365-archive-section :data="$data"/>
@endsection
