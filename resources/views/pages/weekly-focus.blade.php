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
        <div x-data="{ isTopicAtGlanceOpen: false }" class="flex justify-between mt-[20px] md:mt-0">
            <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 ">
                <div class="flex w-full lg:md:w-2/6 flex-col space-y-6 leftsticky">
                    <x-widgets.article-side-bar :table-of-content="$tableOfContent" />

                    @if($articles->topicAtGlance !== null)
                        <div @click="isTopicAtGlanceOpen = !isTopicAtGlanceOpen" class="hidden lg:block">
                            <x-widgets.topic-at-a-glance :infographic="$articles->topicAtGlance"/>
                        </div>
                    @endif
                    <x-modals.modal-box x-show="isTopicAtGlanceOpen">
                        <livewire:widgets.pdf-viewer :pdf="$articles->topicAtGlance" />
                    </x-modals.modal-box>
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
                    @if($articles->topicAtGlance !== null)
                        <div @click="isTopicAtGlanceOpen = !isTopicAtGlanceOpen" class="block lg:hidden mb-4">
                            <x-widgets.topic-at-a-glance :infographic="$articles->topicAtGlance"/>
                        </div>
                    @endif
                    <div class="block lg:hidden">
                        <x-widgets.side-bar-download-menu initiative="weekly-focus" />
                    </div>
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
