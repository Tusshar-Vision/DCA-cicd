@extends('layouts.base')

@php
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
@endphp

@section('content')
    <div class="space-y-12">
    {{--Highlights and notes side menu buttons and modal box, this is common on all pages of the reading ecosystem--}}
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

        @yield('article-content')

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

    @push('scripts')
{{--        Scripts required for notes and highlights feature--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-core.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-classapplier.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-highlighter.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/highlighter.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>--}}
{{--        <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>--}}
    @endpush
@endsection
