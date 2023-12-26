@extends('layouts.base')
@section('title', 'Home | Current Affairs')

@section('content')
    <livewire:widgets.edit-profile-section />
    <livewire:widgets.student-profile-tabsection />
    <livewire:widgets.student-mycontent-section :type="$type" :papers="$papers" :paper="$paper" :topics="$topics"
        :topic="$topic" :sections="$sections" :section="$section" :articles="$articles" />
@endsection
