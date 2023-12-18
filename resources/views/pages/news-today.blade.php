@extends('layouts.base')
@section('title', 'News Today | Current Affairs')

@php
    use Carbon\Carbon;
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
@endphp

@section('content')

    <div class="space-y-4">
        <x-common.article-heading :title="$article->title"/>
        <x-widgets.articles-nav :createdAt="$article->created_at" :updatedAt="$article->updated_at"/>
    </div>

    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        <x-widgets.side-notes-and-highlights-menu :noteAvailable="$noteAvailable"/>

        <x-modals.modal-box x-show="isHighlightsOpen" :heading="$highlightsHeading">
            <x-widgets.article-highlights/>
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNotesOpen" :heading="$notesHeading">
            <livewire:widgets.edit-note :articleId="$article->id"/>
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNoteOpen" heading="Add Note">
            <livewire:widgets.add-note :article="$article" :note="$note"/>
        </x-modals.modal-box>
    </div>

    <div class="space-y-12">
        <div class="flex space-x-8">
            <div class="flex w-2/6 flex-col space-y-4">
                <h2 class="text-[20px] font-bold pb-[15px] border-b border-color">News Today</h2>
                <div class="calendar-wrapper border-1 border-color-C3CAD9 border rounded">
                    <label>
                        <input id="news-today-calendar" type="date" class="w-full border-0" value="{{ Carbon::parse($article->published_at)->format('Y-m-d') }}">
                    </label>
                </div>
                <x-widgets.article-side-bar :table-of-content="$articles"/>
                <x-widgets.side-bar-download-menu/>
            </div>

            <div class="flex flex-col w-full">
                @if (!empty($articles) && count($articles) !== 0)
                    <x-header.article readTime="{{ $article->read_time }}"/>

                    <x-article-content :article="$article"/>

                    <div class="mt-12">
                        <x-widgets.article-pagination :totalArticles="$totalArticles" :baseUrl="$baseUrl"/>
                    </div>
                @else
                    <h1>No articles</h1>
                @endif
            </div>

        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col w-5/6 space-y-12">
                <div class="grid grid-cols-3 gap-3">
                    <x-widgets.related-terms/>
                    <x-widgets.related-articles :related-articles="$relatedArticles"/>
                    <x-widgets.related-videos/>
                </div>

                <div>
                    <livewire:widgets.comments/>
                </div>

                <div>
                    <x-widgets.article-sources :sources="$article->sources"/>
                </div>
            </div>
        </div>
    <div>
    <script>
        let newsTodayCalendar = document.getElementById('news-today-calendar');

        newsTodayCalendar.addEventListener('change', function (event) {
            let selectedDate = event.target.value;

            // Get the current URL
            const currentURL = new URL(window.location.href);

            // Update the date part of the URL
            currentURL.pathname = `/news-today/${selectedDate}/`;

            // Navigate to the updated URL
            window.location.href = currentURL.href;
        })
    </script>
@endsection
