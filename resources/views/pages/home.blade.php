@extends('layouts.base')
@section('title', "Home | Current Affairs")

@section('content')

    <div class="mt-14">
        <div>
            <h3 class="text-4xl">Highlights</h3>
        </div>
        <div class="flex">
            <div>
                <livewire:highlights />
            </div>

            <div>
                <x-whats-new-side-bar />
            </div>
        </div>
    </div>

@endsection
