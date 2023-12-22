@extends('layouts.base')
@section('title', 'Home | Current Affairs')

@section('content')
    <livewire:widgets.edit-profile-section />
    <livewire:widgets.student-profile-tabsection />
    <livewire:widgets.student-activity-section :readHistories="$readHistories" />
@endsection
