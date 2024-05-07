@extends('layouts.base')
@section('title', $title . ' | Current Affairs')

@section('content')
    <x-containers.grid-wide class="mt-6">
        <div class="flex flex-col md:flex-row">
            <ul class="flex space-x-2 overflow-x-auto p-2 mb-4 md:justify-center flex-grow">
                <li>
                    <a href="{{ route('videos') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('videos*') ? 'text-white !bg-[#3362CC] hover:text-white' : '' }}">
                        Latest Videos
                    </a>
                </li>
                <li>
                    <a href="{{ route('daily-news') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] active:text-[#3362CC] hover:text-[#3362CC] {{ request()->is('daily-news*') ? 'text-white !bg-[#3362CC] hover:text-white' : '' }}">
                        News Today
                    </a>
                </li>
                <li>
                    <a href="{{ route('in-conversation') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('in-conversation*') ? 'text-white !bg-[#3362CC] hover:text-white' : '' }}">
                        In Conversation
                    </a>
                </li>
                <li>
                    <a href="{{ route('simplified-by-visionias') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('simplified-by-visionias*') ? 'text-white !bg-[#3362CC] hover:text-white' : '' }}">
                        Simplified
                    </a>
                </li>
                <li>
                    <a href="{{ route('personality-in-focus') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('personality-in-focus*') ? 'text-white !bg-[#3362CC] hover:text-white' : '' }}">
                        Personality in Focus
                    </a>
                </li>
                <li>
                    <a href="{{ route('scheme-in-focus') }}" wire:navigate class="text-[14px] text-nowrap rounded-md px-3 py-2 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC] {{ request()->is('scheme-in-focus*') ? 'text-white !bg-[#3362CC] hover:text-white' : '' }}">
                        Scheme in Focus
                    </a>
                </li>
            </ul>
        </div>
        @yield('videos')
    </x-containers.grid-wide>
@endsection
