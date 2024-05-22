@extends('layouts.base')
@section('title', "Home | Current Affairs")

@section('content')
    <x-containers.grid-wide class="mt-6">
        <x-common.section-heading>{{__('home_page.highlights')}}</x-common.section-heading>
        <livewire:widgets.highlights-section :featured-articles="$featuredArticles"/>
    </x-containers.grid-wide>

{{--    <x-containers.grid-wide class="mt-20 flex flex-col items-center">--}}
{{--        <x-common.section-heading class="text-center">{{__('home_page.need_to_learn')}}</x-common.section-heading>--}}
{{--        <livewire:widgets.search-bar-with-button />--}}
{{--    </x-containers.grid-wide>--}}

    <x-containers.grid-wide class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">
            <div class="bg-[#F9F9F9] p-[20px] rounded">
                <img src="" class="mb-4">
                <h3 class="text-[18px] text-[#040404] mb-4">Weekly Focus</h3>
                <p class="text-[#8F93A3] text-[14px]">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
            </div>
            <div class="bg-[#F9F9F9] p-[20px] rounded">
                <img src="" class="mb-4">
                <h3 class="text-[18px] text-[#040404] mb-4">Weekly Focus</h3>
                <p class="text-[#8F93A3] text-[14px]">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
            </div>
            <div class="bg-[#F9F9F9] p-[20px] rounded">
                <img src="" class="mb-4">
                <h3 class="text-[18px] text-[#040404] mb-4">Weekly Focus</h3>
                <p class="text-[#8F93A3] text-[14px]">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
            </div>
            <div class="bg-[#F9F9F9] p-[20px] rounded">
                <img src="" class="mb-4">
                <h3 class="text-[18px] text-[#040404] mb-4">Weekly Focus</h3>
                <p class="text-[#8F93A3] text-[14px]">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
            </div>
            <div class="bg-[#F9F9F9] p-[20px] rounded">
                <img src="" class="mb-4">
                <h3 class="text-[18px] text-[#040404] mb-4">Weekly Focus</h3>
                <p class="text-[#8F93A3] text-[14px]">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
            </div>
        </div>
    </x-containers.grid-wide>

    <x-containers.grid-wide class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 mt-12 gap-6">
        <livewire:widgets.latest-videos :latest-videos="$latestVideos"/>
        <livewire:widgets.latest-downloads :latest-downloads="$latestDownloads"/>
        <livewire:widgets.leaderboard :score-board="$scoreBoard"/>
    </x-containers.grid-wide>

    <script>
        // This event is dispatched to reinitialize swiper slider, otherwise it will stop working due to livewire navigation being used in the app.
        window.dispatchEvent(new Event('onHomePage'));
    </script>
@endsection
