@extends('layouts.app')
@section('title', 'Monthly Magazine | Current Affairs')

@php
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
@endphp

@section('content')

    

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


    <div class="space-y-12 mt-10">
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 mt-[20px] md:mt-0">

            <div class="flex min-w-full lg:min-w-[340px] lg:w-2/6 flex-col space-y-6 leftsticky stickyMl-0">
                <h2 class="text-[25px] font-bold pb-3 border-b border-color text-[#0358A3]">Monthly <span class="text-[#E22526]">Magazine</span></h2>
                {{-- <a href="javascript:void(0)" class="flex items-center justify-start">
                    <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.597656 4.03516L4.31641 0.316406C4.58984 0.0429688 5 0.0429688 5.24609 0.316406L5.875 0.917969C6.12109 1.19141 6.12109 1.60156 5.875 1.84766L3.22266 4.47266L5.875 7.125C6.12109 7.37109 6.12109 7.78125 5.875 8.05469L5.24609 8.65625C5 8.92969 4.58984 8.92969 4.31641 8.65625L0.597656 4.9375C0.351562 4.69141 0.351562 4.28125 0.597656 4.03516Z" fill="#242424"/>
                    </svg> <span class="ml-2 text-sm font-medium text-[#242424]">Back to Main Website</span></a> --}}
                <livewire:widgets.articles-side-bar :topics="$topics" :articles="$sortedArticlesWithTopics" :table-of-content="$tableOfContent" />
                <div class="hidden lg:block">
                    <x-widgets.side-bar-download-menu />
                </div>
            </div>

            <div class="flex flex-col w-full mt-10">
                <div class="space-y-4">
                    <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
                    <x-common.article-heading :title="$article->title" />
                    <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                        <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
                        <x-header.article readTime="{{ $article->readTime }}" />
                    </div>
                </div>

                
                <x-article-content :article="$article" />
                <div class="mt-12">
                    <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
                </div>
                <div class="block lg:hidden">
                    <x-widgets.side-bar-download-menu />
                </div>
            </div>

        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col w-full">
                <div class="grid grid-cols-1 gap-0 lg:grid-cols-3 lg:gap-3">
                    <x-widgets.related-terms :related-terms="$article->relatedTerms" />
                    <x-widgets.related-articles :related-articles="$article->relatedArticles" />
                    <x-widgets.related-videos :related-videos="$article->relatedVideos" />
                </div>

{{--                <div class="mt-[25px]">--}}
{{--                    <livewire:widgets.comments />--}}
{{--                </div>--}}

                <div class="mt-[25px]">
                    <x-widgets.article-sources :sources="$article->sources" />
                </div>
            </div>
        </div>
        <div>

@endsection
