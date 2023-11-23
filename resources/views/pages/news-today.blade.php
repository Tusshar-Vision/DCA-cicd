@extends('layouts.base')
@section('title', 'News Today | Current Affairs')

@php
    $highlightsHeading = "My Highlights";
    $notesHeading = "My Notes";
@endphp

@section('content')

    <div class="space-y-4">
        <h1 class="text-7xl">{{$article->title}}</h1>
        <x-widgets.articles-nav
            :createdAt="$article->created_at"
            :updatedAt="$article->updated_at"
        />
    </div>

    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        <x-widgets.side-notes-and-highlights-menu />

        <x-modals.modal-box x-show="isHighlightsOpen" :heading="$highlightsHeading">
            <x-widgets.article-highlights />
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNotesOpen" :heading="$notesHeading">
            <x-widgets.article-notes />
        </x-modals.modal-box>
    </div>

    <div class="space-y-12">
        <div class="flex space-x-8">

            <div class="flex w-auto flex-col space-y-6">
                <livewire:widgets.articles-side-bar :topics="$topics" :articles="$articles" />
                <x-widgets.side-bar-download-menu />
            </div>

            <div class="flex flex-col w-full">
                @if( !empty($articles) && count($articles) !== 0 )

                    <x-header.article readTime="{{ $article->read_time }}" />
                    <div id="article-content" class="mt-4 printable-area">
                        {!! $article->content !!}
                    </div>
                    <div class="mt-12">
                        <x-widgets.article-pagination :totalArticles="$totalArticles" :baseUrl="$baseUrl" />
                    </div>
                @else
                    <h1>No articles</h1>
                @endif
            </div>

        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col w-5/6 space-y-12">
                <div class="flex space-x-4">
                    <x-widgets.related-terms />
                    <x-widgets.related-articles />
                    <x-widgets.related-videos />
                </div>

                <div>
                    <livewire:widgets.comments />
                </div>

                <div>
                    <x-widgets.article-sources />
                </div>
            </div>
        </div>
        <div>
@endsection
