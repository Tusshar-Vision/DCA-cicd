@extends('layouts.base')
@section('title', $title . ' | Current Affairs')

@section('content')
    <x-containers.grid-wide class="mt-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="text-[30px] text-[#040404] mb-2 md:mb-4 dark:text-white w-full md:w-1/4">{{ $title }}</h2>
            <ul class="flex items-center justify-start space-x-2 overflow-x-auto w-full md:w-3/4 p-2 mb-4">
                <li>
                    <a href="{{ route('videos') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('videos*') ? 'text-[#3362CC]' : '' }}">
                        Latest Videos
                    </a>
                </li>
                <li>
                    <a href="{{ route('daily-news') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] active:text-[#3362CC] hover:text-[#3362CC] {{ request()->is('daily-news*') ? 'text-[#3362CC]' : '' }}">
                        Daily News
                    </a>
                </li>
                <li>
                    <a href="{{ route('in-conversation') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('in-conversation*') ? 'text-[#3362CC]' : '' }}">
                        In Conversation
                    </a>
                </li>
                <li>
                    <a href="{{ route('simplified-by-visionias') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('simplified-by-visionias*') ? 'text-[#3362CC]' : '' }}">
                        Simplified
                    </a>
                </li>
                <li>
                    <a href="{{ route('personality-in-focus') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('personality-in-focus*') ? 'text-[#3362CC]' : '' }}">
                        Personality in Focus
                    </a>
                </li>
                <li>
                    <a href="{{ route('scheme-in-focus') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('scheme-in-focus*') ? 'text-[#3362CC]' : '' }}">
                        Scheme in Focus
                    </a>
                </li>
            </ul>
        </div>
        @yield('videos')
    </x-containers.grid-wide>
@endsection
