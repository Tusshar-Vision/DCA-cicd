@extends('layouts.archive')
@section('title', "Daily News Archive | Current Affairs")

@section('archive-content')
<livewire:widgets.economic-survey-archive-section :data="$data" />
@endsection