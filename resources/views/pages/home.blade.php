@extends('layouts.base')
@section('title', "Home | Current Affairs")

@section('content')

    <x-containers.grid-wide class="mt-6">
        <x-common.section-heading>Highlights</x-common.section-heading>
        <livewire:widgets.highlights-section :featured-articles="$featuredArticles"/>
    </x-containers.grid-wide>

    <x-containers.grid-wide class="mt-12">
        <x-common.section-heading>Latest News</x-common.section-heading>
        <livewire:widgets.news-section :latest-news-articles="$latestNewsArticles"/>
    </x-containers.grid-wide>

    <x-containers.grid-wide class="mt-20 flex flex-col items-center">
        <x-common.section-heading class="text-center">What do you need to learn today?</x-common.section-heading>
        <livewire:widgets.search-bar-with-button />
    </x-containers.grid-wide>

    <x-containers.grid-wide class="grid grid-cols-4 mt-12 gap-6">
        <livewire:widgets.latest-videos :latest-videos="$latestVideos"/>
        <livewire:widgets.latest-downloads :latest-downloads="$latestDownloads"/>
        <livewire:widgets.leaderboard :score-board="$scoreBoard"/>
    </x-containers.grid-wide>

    <script>
        // This event is dispatched to reinitialize swiper slider, otherwise it will stop working due to livewire navigation being used in the app.
        window.dispatchEvent(new Event('onHomePage'));
    </script>
@endsection