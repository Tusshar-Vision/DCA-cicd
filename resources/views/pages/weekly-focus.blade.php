@extends('layouts.base')
@section('title', 'Weekly Focus | Current Affairs')

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
        <div class="flex justify-between mt-[20px] md:mt-0">
            <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 ">
                <div class="flex w-full lg:md:w-2/6 flex-col space-y-6 leftsticky">
                    <x-widgets.article-side-bar :table-of-content="$tableOfContent" />
                    <div class="hidden lg:block">
                        <x-widgets.topic-at-a-glance />
                    </div>
                    <div class="hidden lg:block">
                        <x-widgets.side-bar-download-menu initiative="weekly-focus" />
                    </div>
                </div>

                <div class="flex flex-col w-full mt-[40px]">
                    <x-header.article readTime="{{ $article->readTime }}" />

                    <x-article-content :article="$article" class="m-0" />

                    <div class="mt-12">
                        <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
                    </div>
                    <div class="block lg:hidden mb-4">
                        <x-widgets.topic-at-a-glance />
                    </div>
                    <div class="block lg:hidden">
                        <x-widgets.side-bar-download-menu initiative="weekly-focus" />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col w-full xl:w-5/6 space-y-12">
                <div class="flex flex-col xl:grid-cols-3 gap-3">
                    <x-widgets.related-terms />
                    <x-widgets.related-articles :related-articles="$relatedArticles" />
                    <x-widgets.related-videos />
                </div>

                <div>
                    <livewire:widgets.comments />
                </div>

                <div>
                    <x-widgets.article-sources :sources="$article->sources" />
                </div>
            </div>
        </div>
        <div>
        @endsection
