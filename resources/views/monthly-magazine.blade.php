@extends('layouts.app')
@section('title', 'Monthly Magazine | Current Affairs')

@php
    $highlightsHeading = "My Highlights";
    $notesHeading = "My Notes";
@endphp

@section('content')

    <div class="space-y-4">
        <h1 class="text-7xl">{{$articles[0]->title}}</h1>
        <x-articles-nav 
            :createdAt="$articles[0]->created_at"
            :updatedAt="$articles[0]->updated_at"
        />
    </div>

    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        <x-side-notes-and-highlights-menu />
        
        <x-modal-box x-show="isHighlightsOpen" :heading="$highlightsHeading">
            <x-article-highlights />
        </x-modal-box>
        <x-modal-box x-show="isNotesOpen" :heading="$notesHeading">
            <x-article-notes />
        </x-modal-box>
    </div>

    <div class="space-y-12">
        <div class="flex space-x-8">

            <div class="flex w-auto flex-col space-y-6">
                <livewire:articles-side-bar :topics="$topics" :articles="$articles" />
                <x-side-bar-download-menu />
            </div>
            
            <div class="flex flex-col w-full">
                @if( !empty($articles) && count($articles) !== 0 ) 
                
                    <x-article-header readTime="{{ $articles[0]->read_time }}" />
                    <x-article-author-header :authorId="$articles[0]->author_id" />
                        <div class="printable-area">
                            <!-- <x-custom-context-menu> -->
                                {!! $articles[0]->content !!}
                            <!-- </x-custom-context-menu> -->
                        </div>
                    <div class="mt-12">
                        <x-article-pagination />
                    </div>
                @else
                    <h1>No articles</h1>
                @endif
            </div>

        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col w-5/6 space-y-12">
                <div class="flex space-x-4">
                    <x-related-terms />
                    <x-related-articles />
                    <x-related-videos />
                </div>

                <div>
                    <livewire:comments />
                </div>

                <div>
                    <x-article-sources />
                </div>
            </div>
        </div>
    <div>

@endsection