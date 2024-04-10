@extends('layouts.base')

@php
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
@endphp

@section('styles')
    @vite('resources/css/ck-content.css')
@endsection

@section('content')
    <div class="space-y-12">
    {{--Highlights and notes side menu buttons and modal box, this is common on all pages of the reading ecosystem--}}
        <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
            <x-widgets.side-notes-and-highlights-menu :noteAvailable="$noteAvailable" />

{{--            <x-modals.modal-box x-show="isHighlightsOpen" :heading="$highlightsHeading">--}}
{{--                <x-widgets.article-highlights />--}}
{{--            </x-modals.modal-box>--}}

{{--            <x-modals.modal-box x-show="isNotesOpen" :heading="$notesHeading">--}}
{{--                <livewire:widgets.edit-note :articleId="$article->getID()" />--}}
{{--            </x-modals.modal-box>--}}

{{--            <x-modals.modal-box x-show="isNoteOpen" heading="Add Note">--}}
{{--                <livewire:widgets.add-note :article="$article" :note="$note" />--}}
{{--            </x-modals.modal-box>--}}
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
            </div>
        </div>
        <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top" class="fixed bottom-[100px] right-0 bg-[#005faf] px-[18px] py-4 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 9 12" fill="none" class="rotate-[-90deg]">
                <path d="M7.91994 6.27427L0.854171 10.9848C0.700998 11.0869 0.494038 11.0455 0.391918 10.8923C0.355418 10.8376 0.335938 10.7733 0.335938 10.7075V1.28646C0.335938 1.10237 0.485177 0.953125 0.669271 0.953125C0.735077 0.953125 0.799418 0.972605 0.854171 1.00911L7.91994 5.71961C8.07307 5.82174 8.11447 6.02867 8.01234 6.18187C7.98794 6.21847 7.95654 6.24987 7.91994 6.27427Z" fill="white"/>
            </svg>
        </button>
    </div>

{{--        Scripts required for notes and highlights feature--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-core.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-classapplier.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-highlighter.js') }}"></script>--}}
{{--        <script type="text/javascript" src="{{ URL::asset('js/rangy/highlighter.js') }}"></script>--}}
{{--        <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>--}}
    <script>
        function pauseVideo(isVideoOpenValue) {
            if (!isVideoOpenValue) {
                let videoPlayer = document.querySelector('.video');

                if (videoPlayer !== null) {
                    videoPlayer.pause();
                } else {
                    videoPlayer = document.querySelector('.videoEmbed');
                    if (videoPlayer !== null) videoPlayer.src = videoPlayer.src;
                }
            }
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide scroll to top button based on scroll position
        window.onscroll = function() {
            let scrollToTopBtn = document.getElementById('scrollToTopBtn');
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        };
    </script>
@endsection
