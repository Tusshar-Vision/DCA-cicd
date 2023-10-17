@extends('layouts.base')
@section('title', "Home | Current Affairs")

@section('content')

    <div>
        <div>
            <livewire:highlights />
        </div>

        <div>
            <x-whats-new-side-bar />
        </div>
    </div>

@endsection