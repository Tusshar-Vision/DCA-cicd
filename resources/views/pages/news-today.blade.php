@extends('layouts.base')
@section('title', 'News Today | Current Affairs')

@php
    use Carbon\Carbon;
    $highlightsHeading = 'My Highlights';
    $notesHeading = 'My Notes';
    $inShort = request()->is('news-today/also-in-news*');
@endphp

@section('content')

    {{-- <div class="space-y-4">
        <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
        <x-common.article-heading :title="$article->title" />
        <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
    </div> --}}

    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        {{-- <x-widgets.side-notes-and-highlights-menu :noteAvailable="$noteAvailable" /> --}}

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

    <div class="space-y-12 mt-6" x-data="{ isVideoOpen: false }">
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8">

        <x-modals.modal-box x-show="isVideoOpen" heading="Watch Today's News">
            <livewire:widgets.today-news-video :videoUrl="$videoUrl" />
        </x-modals.modal-box>

                <div class="flex w-full lg:w-2/6 flex-col space-y-4 leftsticky stickyMl-0">
                    {{-- <h2 class="text-[25px] font-bold mt-[26px] pb-3 border-b border-color text-[#0358A3]">News <span class="text-[#E22526]">Today</span></h2> --}}
                    {{-- <img class="w-[120px]" src="{{ asset('images/NewstodayLogo.png') }}" alt="news today Logo" /> --}}
                    
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 200 50" style="enable-background:new 0 0 200 50;" xml:space="preserve">
                        <style type="text/css">
                            .st0{fill-rule:evenodd;clip-rule:evenodd;}
                            .st1{fill-rule:evenodd;clip-rule:evenodd;fill:none;stroke:#EA2F27;stroke-width:0.7081;stroke-miterlimit:10;}
                            .st2{fill:#EA2F27;}
                            .st3{clip-path:url(#SVGID_00000092452892383485499480000010079007113138028161_);}
                            .st4{fill:#FFFFFF;}
                            .st5{fill:#1F2442;}
                            .st6{fill:#202443;}
                            .st7{clip-path:url(#SVGID_00000100384284200805683640000013458852240143854225_);fill:#202443;}
                        </style>
                        <g>
                            <g>
                                <path class="st5" d="M62.22,1.16v21.12h-5.85l-8.03-9.6v9.6H41.4V1.16h5.85l8.03,9.6v-9.6H62.22z"/>
                                <path class="st5" d="M83.22,16.91v5.37H65.66V1.16h17.17v5.37H72.66v2.47h8.93v5.13h-8.93v2.78H83.22z"/>
                                <path class="st5" d="M120.04,1.16l-6.76,21.12h-7.63L102.24,11l-3.59,11.29h-7.63L84.25,1.16h7.33l3.68,12.01l3.89-12.01h6.55
                                    l3.68,12.16l3.89-12.16H120.04z"/>
                                <path class="st5" d="M120.28,20.59l2.29-5.19c1.99,1.18,4.65,1.93,6.97,1.93c2.02,0,2.75-0.42,2.75-1.15
                                    c0-2.66-11.68-0.51-11.68-8.39c0-3.92,3.29-7.12,9.84-7.12c2.84,0,5.76,0.6,7.97,1.84l-2.14,5.16c-2.08-1.06-4.04-1.57-5.88-1.57
                                    c-2.08,0-2.75,0.6-2.75,1.33c0,2.54,11.68,0.42,11.68,8.21c0,3.86-3.29,7.12-9.84,7.12C125.95,22.77,122.39,21.89,120.28,20.59z"
                                    />
                            </g>
                            <g>
                                <path class="st5" d="M47.72,32.96H41.4v-5.64h19.91v5.64h-6.32V48.9h-7.28V32.96z"/>
                                <path class="st5" d="M89.03,27.32h10.63c7.21,0,12.18,4.1,12.18,10.79S106.87,48.9,99.66,48.9H89.03V27.32z M99.35,43.23
                                    c3.05,0,5.15-1.82,5.15-5.12c0-3.3-2.1-5.12-5.15-5.12H96.3v10.23H99.35z"/>
                                <path class="st5" d="M128.88,45.14h-8.2l-1.45,3.76h-7.4l9.43-21.58h7.15l9.43,21.58h-7.52L128.88,45.14z M126.88,39.9l-2.1-5.42
                                    l-2.1,5.42H126.88z"/>
                                <path class="st5" d="M150.46,41.07v7.83h-7.28v-7.92l-8.14-13.66h7.68l4.41,7.46l4.44-7.46h7.03L150.46,41.07z"/>
                                <g>
                                    <path class="st5" d="M62.02,38.11c0-6.53,5.15-11.28,12.18-11.28c7.03,0,12.18,4.75,12.18,11.28c0,6.54-5.15,11.28-12.18,11.28
                                        C67.17,49.39,62.02,44.65,62.02,38.11z M81.22,38.11c0-4.87-3.13-7.82-7.02-7.82c-3.89,0-7.02,2.95-7.02,7.82
                                        c0,4.87,3.13,7.82,7.02,7.82C78.09,45.93,81.22,42.98,81.22,38.11z"/>
                                    <g>
                                        <path class="st5" d="M71.78,38.1C71.78,38.1,71.78,38.1,71.78,38.1c0,0.49,0,0.98,0,1.47c0,0.59,0,1.18,0,1.77
                                            c0,0.4,0.32,0.59,0.68,0.42c0.03-0.02,0.07-0.03,0.1-0.05c1.19-0.72,2.37-1.44,3.56-2.17c0.54-0.33,1.07-0.67,1.6-1.01
                                            c0.33-0.21,0.34-0.63,0-0.84c-0.63-0.39-1.26-0.78-1.89-1.16c-0.56-0.35-1.13-0.69-1.69-1.03c-0.57-0.35-1.15-0.7-1.73-1.05
                                            c-0.06-0.04-0.15-0.04-0.22-0.02c-0.36,0.09-0.4,0.14-0.4,0.52C71.78,35.99,71.78,37.04,71.78,38.1z M72.66,35.64
                                            c1.34,0.83,2.64,1.64,3.99,2.47c-1.34,0.83-2.65,1.64-3.99,2.47C72.66,38.93,72.66,37.32,72.66,35.64z"/>
                                    </g>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <g>
                                        <path class="st5" d="M147.2,4.87c0.02,0,0.04,0,0.07,0c2.33,0,4.66,0,6.99,0c0.1,0,0.2,0.01,0.3,0c0.08-0.01,0.08,0.03,0.08,0.1
                                            c0,0.21,0,0.41,0,0.62c0,1.69,0.01,3.39-0.01,5.08c-0.02,1.48-0.64,2.63-1.8,3.42c-0.71,0.48-1.49,0.65-2.31,0.55
                                            c-1.06-0.13-1.91-0.66-2.55-1.58c-0.39-0.55-0.63-1.17-0.71-1.86c-0.04-0.42-0.05-0.85-0.05-1.28c-0.01-1.48,0-2.96,0-4.45
                                            C147.2,5.28,147.2,5.08,147.2,4.87z"/>
                                        <path class="st5" d="M150.68,0.61c0.15,0,0.28,0,0.44,0c0,0.03,0,0.07,0,0.1c0,1.19,0,2.37,0,3.56c0,0.09-0.02,0.13-0.11,0.12
                                            c-0.09-0.01-0.18,0-0.27,0c-0.05,0-0.07-0.02-0.06-0.07c0-0.12,0-0.23,0-0.35c0-1.08,0-2.17,0-3.25
                                            C150.68,0.68,150.68,0.65,150.68,0.61z"/>
                                        <path class="st5" d="M152.09,4.39c0-0.06,0-0.09,0-0.12c0-1.11,0-2.22,0-3.33c0-0.12,0.02-0.13,0.12-0.09
                                            c0.03,0.02,0.07,0.03,0.1,0.05c0.21,0.1,0.21,0.1,0.21,0.36c0,1,0,2,0,3c0,0.13,0,0.13-0.12,0.13
                                            C152.3,4.39,152.2,4.39,152.09,4.39z"/>
                                        <path class="st5" d="M149.29,4.39c0-0.05,0-0.09,0-0.12c0-1.06,0-2.13,0-3.19c0-0.07,0.02-0.1,0.08-0.12
                                            c0.11-0.04,0.22-0.09,0.35-0.15c0,0.09,0,0.18,0,0.26c0,1.07,0,2.13,0,3.2c0,0.09-0.02,0.13-0.11,0.12
                                            C149.51,4.38,149.41,4.39,149.29,4.39z"/>
                                        <path class="st5" d="M148.32,1.78c0,0.16,0,0.33,0,0.49c0,0.67,0,1.34,0,2.01c0,0.09-0.02,0.12-0.11,0.12
                                            c-0.11-0.01-0.21,0-0.33,0c0-0.04-0.01-0.07-0.01-0.1c0-0.63,0-1.26,0-1.89c0-0.05,0-0.11,0.03-0.14
                                            c0.12-0.17,0.25-0.33,0.38-0.5C148.3,1.77,148.31,1.77,148.32,1.78z"/>
                                        <path class="st5" d="M153.52,1.76c0.09,0.12,0.18,0.26,0.28,0.37c0.11,0.13,0.12,0.27,0.12,0.43c0,0.56,0,1.13,0,1.69
                                            c0,0.13,0,0.13-0.12,0.13c-0.08,0-0.15,0.01-0.23,0c-0.02,0-0.06-0.04-0.06-0.07c-0.01-0.08,0-0.16,0-0.24c0-0.74,0-1.48,0-2.22
                                            c0-0.03,0-0.06,0-0.1C153.5,1.76,153.51,1.76,153.52,1.76z"/>
                                    </g>
                                    <path class="st5" d="M147.13,22.48c-0.1,0-0.2,0-0.31-0.02c-0.3-0.05-0.52-0.3-0.5-0.58c0.02-0.29,0.27-0.53,0.57-0.54
                                        c0.15-0.01,0.29-0.01,0.44-0.01l3,0c0,0,0-2.43,0-3.21c-0.17-0.02-0.35-0.04-0.52-0.07c-0.94-0.15-1.82-0.49-2.61-1.01
                                        c-0.54-0.36-0.98-0.74-1.34-1.16c-0.41-0.48-0.74-0.95-0.99-1.44c-0.27-0.54-0.48-1.14-0.61-1.78c-0.11-0.55-0.11-1.1-0.11-1.62
                                        l0-0.18c0-0.41,0-0.83-0.01-1.24l0-0.49c-0.02,0-0.04,0-0.06,0c-0.1,0-0.19,0-0.29-0.01c-0.29-0.01-0.43-0.16-0.49-0.29
                                        c-0.09-0.18-0.1-0.37-0.02-0.53c0.05-0.09,0.17-0.25,0.44-0.3c0.05-0.01,0.1-0.01,0.15-0.01l1.32,0c0.4,0,0.81,0,1.21,0
                                        c0.16,0,0.28,0.05,0.37,0.14c0.09,0.1,0.12,0.22,0.11,0.37c-0.01,0.06,0,0.11,0,0.17c0.01,0.18-0.06,0.28-0.11,0.34
                                        c-0.08,0.08-0.19,0.13-0.32,0.13c-0.39,0-0.78,0-1.16,0v0.73c0,0.64,0,1.3,0.02,1.95c0.02,0.59,0.16,1.2,0.44,1.81
                                        c0.14,0.32,0.26,0.55,0.38,0.75c0.2,0.33,0.46,0.66,0.76,0.96c0.53,0.54,1.12,0.95,1.76,1.23c0.42,0.19,0.89,0.32,1.38,0.39
                                        c0.1,0.02,0.21,0.03,0.32,0.04c0-0.34,0-0.67,0-1.01c0-0.14,0.04-0.25,0.12-0.33c0.08-0.08,0.19-0.13,0.32-0.13l0.14,0l0.56,0
                                        v1.47c0.02,0,0.04,0,0.06-0.01c0.72-0.08,1.39-0.29,1.99-0.61c0.77-0.41,1.43-0.98,1.94-1.69c0.33-0.46,0.6-0.98,0.79-1.54
                                        c0.18-0.54,0.27-1.08,0.27-1.61c0-0.8,0-1.61,0-2.41c-0.38,0-0.76,0-1.14,0c-0.14,0-0.25-0.04-0.33-0.13
                                        c-0.05-0.06-0.12-0.16-0.11-0.33c0.01-0.08,0-0.15,0-0.23c-0.01-0.16,0.05-0.26,0.11-0.33c0.05-0.06,0.15-0.13,0.32-0.14l2.53,0
                                        l0.04,0.35V7.96c0.03,0,0.07,0,0.1,0c0.31,0.02,0.55,0.25,0.55,0.54c0,0.33-0.24,0.58-0.57,0.6c-0.11,0.01-0.23,0.01-0.34,0.01
                                        l-0.02,0l0,0.63c0,0.43,0,0.86,0,1.29c-0.01,0.59-0.02,1.22-0.17,1.84c-0.16,0.66-0.35,1.18-0.59,1.63
                                        c-0.61,1.13-1.44,2.02-2.48,2.66c-0.35,0.21-0.72,0.4-1.11,0.55c-0.59,0.23-1.21,0.37-1.84,0.43v0.56c0,0.89,0,1.77,0,2.66
                                        c0.56,0,1.12,0,1.67,0l1.49,0c0.14,0,0.27,0.01,0.38,0.03c0.27,0.04,0.45,0.25,0.46,0.53c0.01,0.26-0.14,0.47-0.38,0.55
                                        c-0.07,0.02-0.14,0.04-0.21,0.04c-0.16,0-0.31,0.01-0.47,0.01l-5.99,0H147.13z"/>
                                </g>
                                <g>
                                    <g>
                                        <g>
                                            <path class="st5" d="M155.35,6.81c0.06,0,0.11-0.1,0.11-0.22V2.19c0-0.12-0.05-0.22-0.11-0.22s-0.11,0.1-0.11,0.22v4.39
                                                C155.24,6.71,155.29,6.81,155.35,6.81z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M155.92,7.25c0.06,0,0.11-0.1,0.11-0.22V1.75c0-0.12-0.05-0.22-0.11-0.22c-0.06,0-0.11,0.1-0.11,0.22v5.27
                                                C155.81,7.15,155.86,7.25,155.92,7.25z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M156.5,2.48c-0.06,0-0.11,0.1-0.11,0.22v3.37c0,0.12,0.05,0.22,0.11,0.22c0.06,0,0.11-0.1,0.11-0.22V2.71
                                                C156.61,2.58,156.56,2.48,156.5,2.48z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M157.07,2.08c-0.06,0-0.11,0.1-0.11,0.22v4.18c0,0.12,0.05,0.22,0.11,0.22c0.06,0,0.11-0.1,0.11-0.22V2.3
                                                C157.18,2.18,157.13,2.08,157.07,2.08z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M157.64,2.6c-0.06,0-0.11,0.1-0.11,0.22v3.14c0,0.12,0.05,0.22,0.11,0.22s0.11-0.1,0.11-0.22V2.82
                                                C157.75,2.7,157.7,2.6,157.64,2.6z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M158.21,3.15c-0.06,0-0.11,0.1-0.11,0.22v2.04c0,0.12,0.05,0.22,0.11,0.22s0.11-0.1,0.11-0.22V3.37
                                                C158.33,3.25,158.27,3.15,158.21,3.15z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path class="st5" d="M146.46,6.81c-0.06,0-0.11-0.1-0.11-0.22V2.19c0-0.12,0.05-0.22,0.11-0.22s0.11,0.1,0.11,0.22v4.39
                                                C146.57,6.71,146.52,6.81,146.46,6.81z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M145.89,7.25c-0.06,0-0.11-0.1-0.11-0.22V1.75c0-0.12,0.05-0.22,0.11-0.22c0.06,0,0.11,0.1,0.11,0.22v5.27
                                                C146,7.15,145.95,7.25,145.89,7.25z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M145.32,2.48c0.06,0,0.11,0.1,0.11,0.22v3.37c0,0.12-0.05,0.22-0.11,0.22s-0.11-0.1-0.11-0.22V2.71
                                                C145.2,2.58,145.25,2.48,145.32,2.48z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M144.74,2.08c0.06,0,0.11,0.1,0.11,0.22v4.18c0,0.12-0.05,0.22-0.11,0.22c-0.06,0-0.11-0.1-0.11-0.22V2.3
                                                C144.63,2.18,144.68,2.08,144.74,2.08z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M144.17,2.6c0.06,0,0.11,0.1,0.11,0.22v3.14c0,0.12-0.05,0.22-0.11,0.22c-0.06,0-0.11-0.1-0.11-0.22V2.82
                                                C144.06,2.7,144.11,2.6,144.17,2.6z"/>
                                        </g>
                                        <g>
                                            <path class="st5" d="M143.6,3.15c0.06,0,0.11,0.1,0.11,0.22v2.04c0,0.12-0.05,0.22-0.11,0.22c-0.06,0-0.11-0.1-0.11-0.22V3.37
                                                C143.49,3.25,143.54,3.15,143.6,3.15z"/>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
         

                    <livewire:widgets.news-today-calendar :calendar-data="$newsTodayCalendar" />
                    <x-widgets.article-side-bar :table-of-content="$articles->articles" :isAlsoInNews="$isAlsoInNews" />
                    <div class="hidden lg:block">
                        <x-widgets.side-bar-download-menu initiative="news-today" :media="$media"/>
                    </div>
                </div>

                <div class="flex flex-col w-full mt-6 lg:mt-0">
                    <!-- replaced header section -->
                    <div class="space-y-4">
                        <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
                        <x-common.article-heading :title="$article->title" />
                    </div>
                    <!-- replaced header section -->
                    <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                        <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
                        <x-header.article readTime="{{ $article->readTime }}" />
                    </div>

                    @if($inShort)
                    <x-inshort-article :articles="$articles->articles" class="m-0" />
                    @else
                    <x-article-content :article="$article" class="m-0" />
                    @endif

                    <div class="mt-12">
                        <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
                    </div>
                    <div class="block lg:hidden mt-4">
                        <x-widgets.side-bar-download-menu initiative="news-today" :media="$media"/>
                    </div>
                </div>
        </div>

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
@endsection
