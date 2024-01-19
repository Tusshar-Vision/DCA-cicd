@extends('layouts.base')
@section('title', 'News Today | Current Affairs')

@php
    use Carbon\Carbon;
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
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8">
                <div class="flex w-full lg:w-2/6 flex-col space-y-4 leftsticky">
                    <h2 class="text-[20px] font-bold mt-[26px] pb-3 border-b border-color">News Today</h2>
                    <div class="calendar-wrapper border-1 border-color-C3CAD9 bg-white border rounded relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 27 24" fill="none" class="absolute right-[10px] top-[7px] z-0">
                            <rect x="5.7793" y="6.24023" width="15.8769" height="13.2" rx="2" stroke="#8F93A3" stroke-width="1.1"/>
                            <path d="M5.7793 10.4404H21.6562" stroke="#8F93A3" stroke-linecap="round"/>
                            <path d="M9.74805 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
                            <path d="M17.687 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
                        </svg>
                        <label>
                            <input
                                type="text"
                                name="newsToday"
                                value="{{ Carbon::parse($articles->publishedAt)->format('m/d/Y') }}"
                                class="w-full border-0 text-[#8F93A3] relative z-[1] bg-transparent cursor-pointer"
                            />
                        </label>
                    </div>
                    <x-widgets.article-side-bar :table-of-content="$articles->articles" />
                    <div class="hidden lg:block">
                        <x-widgets.side-bar-download-menu initiative="news-today"/>
                    </div>
                </div>

                <div class="flex flex-col mt-[30px] w-full">
                    <x-header.article readTime="{{ $article->readTime }}" />

                    <x-article-content :article="$article" class="m-0" />

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
                    <x-widgets.related-terms :related-terms="$relatedTerms" />
                    <x-widgets.related-articles :related-articles="$relatedArticles" />
                    <x-widgets.related-videos :related-videos="$relatedVideos" />
                </div>

                <div>
                    <livewire:widgets.comments />
                </div>

                <div>
                    <x-widgets.article-sources :sources="$article->sources" />
                </div>
            </div>
        </div>
    </div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            function renderNewsToday(selectedDate) {
                // Get the current URL
                const currentURL = new URL(window.location.href);

                // Update the date part of the URL
                currentURL.pathname = `/news-today/${selectedDate}/`;

                // Navigate to the updated URL
                window.location.href = currentURL.href;
            }

            // calendar for news today
            $(function() {
                $('input[name="newsToday"]').daterangepicker({
                    autoApply: true,
                    singleDatePicker: true,
                    opens: 'left',
                    minYear: 2009,
                    maxYear: parseInt(moment().format('YYYY'),10)
                }, function(start) {
                    renderNewsToday(start.format('YYYY-MM-DD'));
                });
            });

        </script>
@endsection
