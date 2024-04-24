@extends('layouts.base')
@section('title', $title . ' | Current Affairs')

@section('content')
    <x-containers.grid-wide class="mt-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="text-[40px] text-[#040404] mb-2 md:mb-4 dark:text-white w-full md:w-2/4">{{ $title }}</h2>
            <ul class="flex items-center space-x-2 overflow-x-scroll w-full md:w-2/4 p-2 mb-4">
                <li><a href="#" class="text-[14px] text-nowrap rounded-md px-2 py-1 text-[#040404] bg-[#F4F4F6] active:text-[#3362CC] hover:text-[#3362CC]">
                    Daily News
                </a></li>
                <li><a href="#" class="text-[14px] text-nowrap rounded-md px-2 py-1 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC]">
                    Weekly Focus: In Conversation
                </a></li>
                <li><a href="#" class="text-[14px] text-nowrap rounded-md px-2 py-1 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC]">
                    Simplified by VisionIAS
                </a></li>
                <li><a href="#" class="text-[14px] text-nowrap rounded-md px-2 py-1 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC]">
                    Personality in Focus
                </a></li>
                <li><a href="#" class="text-[14px] text-nowrap rounded-md px-2 py-1 text-[#040404] bg-[#F4F4F6] hover:text-[#3362CC]">
                    Scheme in Focus
                </a></li>
            </ul>
        </div>
        @yield('videos')
    </x-containers.grid-wide>
@endsection
