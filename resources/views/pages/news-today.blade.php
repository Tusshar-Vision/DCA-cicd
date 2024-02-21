@extends('layouts.base')
@section('title', 'News Today | Current Affairs')

@php
    use Carbon\Carbon;
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
    $inShort = request()->is('news-today/also-in-news*');

    logger("articless", [$articles]);
@endphp

@section('content')

    {{-- <div class="space-y-4">
        <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
        <x-common.article-heading :title="$article->title" />
        <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
    </div> --}}

    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        <x-widgets.side-notes-and-highlights-menu :noteAvailable="$noteAvailable" />

        <x-modals.modal-box x-show="isHighlightsOpen" :heading="$highlightsHeading">
            <x-widgets.article-highlights />
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNotesOpen" :heading="$notesHeading">
            <livewire:widgets.edit-note :articleId="$article->getID()" />
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNoteOpen" heading="Add Note">
            <livewire:widgets.add-note :article="$article" :note="$note" />
        </x-modals.modal-box>
    </div>

    <div class="space-y-12" x-data="{ isVideoOpen: false }">
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8">

        <x-modals.modal-box x-show="isVideoOpen" heading="Watch Today's News">
            <livewire:widgets.today-news-video :videoUrl="$videoUrl" />
        </x-modals.modal-box>

                <div class="flex w-full lg:w-2/6 flex-col space-y-4 leftsticky stickyMl-0">
                    <h2 class="text-[25px] font-bold mt-[26px] pb-3 border-b border-color text-[#0358A3]">News <span class="text-[#E22526]">Today</span></h2>
                    <livewire:widgets.news-today-calendar :calendar-data="$newsTodayCalendar" />
                    <x-widgets.article-side-bar :table-of-content="$articles->articles" />
                    <div class="hidden lg:block">
                        <x-widgets.side-bar-download-menu initiative="news-today"/>
                    </div>
                </div>

                <div class="flex flex-col mt-[30px] w-full">
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
                        <x-widgets.side-bar-download-menu initiative="news-today"/>
                    </div>
                </div>
        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col space-y-12 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-3">
                    <x-widgets.related-terms :related-terms="$article->relatedTerms" />
                    <x-widgets.related-articles :related-articles="$article->relatedArticles" />
                    <x-widgets.related-videos :related-videos="$article->relatedVideos" />
                </div>

{{--                <div>--}}
{{--                    <livewire:widgets.comments />--}}
{{--                </div>--}}

                <div>
                    <x-widgets.article-sources :sources="$article->sources" />
                </div>
            </div>
        </div>
    </div>
@endsection
