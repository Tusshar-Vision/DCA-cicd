@extends('layouts.app')
@section('title', 'Monthly Magazine | Current Affairs')

@php
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
@endphp

@section('content')

    <div class="space-y-4">
        <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
        <x-common.article-heading :title="$article->title" />
        <x-widgets.articles-nav :createdAt="$article->createdAt" :updatedAt="$article->updatedAt" />
    </div>

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


    <div class="space-y-12">
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 mt-[20px] md:mt-0">

            <div class="flex min-w-full lg:min-w-[340px] lg:w-2/6 flex-col space-y-6 leftsticky">
                <livewire:widgets.articles-side-bar :topics="$topics" :articles="$sortedArticlesWithTopics" :table-of-content="$tableOfContent" />
                <div class="hidden lg:block">
                    <x-widgets.side-bar-download-menu />
                </div>
            </div>

            <div class="flex flex-col w-full mt-[20px]">
                    <x-header.article readTime="{{ $article->readTime }}" />
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
            <div class="flex flex-col w-full lg:w-5/6 lg:space-y-12">
                <div class="grid grid-cols-1 gap-0 lg:grid-cols-3 lg:gap-3">
                    <x-widgets.related-terms />
                    <x-widgets.related-articles :related-articles="$relatedArticles" />
                    <x-widgets.related-videos :related-videos="$relatedVideos" />
                </div>

                <div class="mt-[25px] lg:mt-0">
                    <livewire:widgets.comments />
                </div>

                <div class="mt-[25px] lg:mt-0">
                    <x-widgets.article-sources :sources="$article->sources" />
                </div>
            </div>
        </div>
        <div>

@endsection
