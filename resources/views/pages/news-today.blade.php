@extends('layouts.reading-ecosystem')
@section('title', 'News Today | Current Affairs')

@php
    $inShort = request()->is('news-today/also-in-news*');
@endphp

@section('article-content')
    <div class="mt-6" x-data="{ isVideoOpen: false }">
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8">

            <x-modals.modal-box x-show="isVideoOpen" heading="Watch Today's News">
                <x-cards.video :source="$articles->video"/>
            </x-modals.modal-box>

            <div class="flex w-full lg:w-2/6 flex-col space-y-4 leftsticky stickyMl-0">

                {!! \App\Helpers\SvgIconsHelper::getSvgIcon('news-today-logo') !!}

                <livewire:widgets.news-today-calendar :calendar-data="$newsTodayCalendar" />

                <x-widgets.article-side-bar :table-of-content="$articles->articles" :isAlsoInNews="$isAlsoInNews" />

                <div class="hidden lg:block">
                    <x-widgets.side-bar-download-menu initiative="news-today" :media="$articles?->media"/>
                    <x-widgets.sidebar-video-menu initiative="news-today" :video="$articles?->video" />
                </div>

            </div>

            <div class="flex flex-col w-full mt-6 lg:mt-0">
                <!-- replaced header section -->
                <div class="space-y-4">
                    <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
                    <x-common.article-heading :title="$article->title" />
                </div>
                <!-- replaced header section -->
                <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                    <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
                    <x-header.article readTime="{{ $article->readTime }}" />
                </div>

                @if($inShort)
                    <x-inshort-article :articles="$articles->articles" class="m-0" />
                @else
                    <x-article-content :article="$article" class="m-0" />
                @endif

                <div class="mt-12">
                    <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
                </div>
                <div class="block lg:hidden mt-4">
                    <x-widgets.side-bar-download-menu initiative="news-today" :media="$articles?->media"/>
                    <x-widgets.sidebar-video-menu @click="isVideoOpen = true" initiative="news-today" :video="$articles?->video" />
                </div>
            </div>

        </div>
    </div>
@endsection
