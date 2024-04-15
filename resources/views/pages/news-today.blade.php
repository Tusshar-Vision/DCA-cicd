@extends('layouts.reading-ecosystem')
@section('title', 'News Today | Current Affairs')

@php
    $inShort = request()->is('news-today/*/also-in-news');
@endphp

@section('article-content')
    <div x-data="{ openItem: 0, expanded: false, isVideoOpen: false }"
         x-init="$watch('isVideoOpen', value => pauseVideo(value))" class="mt-6"
    >
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8">

            <div class="flex w-full lg:w-2/6 flex-col space-y-4 leftsticky stickyMl-0">

                <img src="{{ asset('images/news-today-logo.svg') }}" alt="News Today Logo" />

                <livewire:widgets.news-today-calendar :calendar-data="$newsTodayCalendar" />

                <x-widgets.article-side-bar :table-of-content="$package->articles" :isAlsoInNews="$isAlsoInNews" :short-articles="$package->shortArticles" />

                <div class="hidden lg:block">
                    <x-widgets.side-bar-download-menu initiative="news-today" :media="$package?->media"/>
                    <x-widgets.sidebar-video-menu initiative="news-today" :video="$package?->video" />
                </div>

            </div>

            <div class="flex flex-col w-full mt-6 lg:mt-0">
                <!-- replaced header section -->
                <div class="space-y-4">
                    <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" :isArticleRead="$isArticleRead" :article="$article" />
                    @if($inShort)
                        <x-common.article-heading title="Also in News" />
                    @else
                        <x-common.article-heading :title="$article->title" />
                    @endif
                </div>
                <!-- replaced header section -->
                <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                    <x-widgets.articles-nav :createdAt="$package->publishedAt" :updatedAt="$article->updatedAt" />
                    @if($inShort)
                        @php
                            $readTime = $package->shortArticles->reduce(function ($carry, $article) {
                                return $carry + $article->readTime;
                            }, 0);
                        @endphp
                        <x-header.article readTime="{{ $readTime }}" />
                    @else
                        <x-header.article readTime="{{ $article->readTime }}" />
                    @endif
                </div>

                @if($inShort)
                    <x-reading.short-article :articles="$package->shortArticles" class="m-0" />
                @else
                    <x-reading.article-content :article="$article" class="m-0" />
                @endif

                <div class="mt-12">
                    <x-widgets.article-pagination :current-initiative="$package" :current-article-slug="$article->slug" />
                </div>
                <div class="block lg:hidden mt-4">
                    <x-widgets.side-bar-download-menu initiative="news-today" :media="$package?->media"/>
                    <x-widgets.sidebar-video-menu initiative="news-today" :video="$package?->video" />
                </div>
            </div>
        </div>
        <!-- video modal -->
        <x-modals.modal-box x-show="isVideoOpen" heading="Watch Today's News">
            <x-cards.video :source="$package?->video" />
        </x-modals.modal-box>
    </div>
@endsection
