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
                        <div class="calender-wrap absolute left-0 top-0 mt-[23px] w-full bar hidden calShow">
                            <div class="vi-daily-news-card">
                                <div class="flex justify-between items-center">
                                    <select class="py-1 h-[28px] text-sm border-[1px] border-[#C3CAD9] text-[#3d3d3d]">
                                        <option>Year</option>
                                        <option>January 2024</option>
                                        <option>February 2024</option>
                                        <option>March 2024</option>
                                    </select>
                                    <ul class="flex text-xl">
                                        <li class="mr-2"><a href="javascript:void(0)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                                <path d="M3.96923 6.96468L10.7147 0.221495C11.0106 -0.0737429 11.4902 -0.0737429 11.7869 0.221495C12.0829 0.516732 12.0829 0.996275 11.7869 1.29151L5.57653 7.49966L11.7862 13.7078C12.0822 14.003 12.0822 14.4826 11.7862 14.7786C11.4902 15.0738 11.0099 15.0738 10.7139 14.7786L3.96849 8.03545C3.67705 7.74326 3.67705 7.25618 3.96923 6.96468Z" fill="#3D3D3D"/>
                                            </svg>
                                        </a>
                                        <li class="ml-2"><a href="javascript:void(0)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                                <path d="M11.0308 6.96468L4.28534 0.221495C3.98935 -0.0737429 3.50981 -0.0737429 3.21308 0.221495C2.91709 0.516732 2.91709 0.996275 3.21308 1.29151L9.42347 7.49966L3.21382 13.7078C2.91784 14.003 2.91784 14.4826 3.21382 14.7786C3.50981 15.0738 3.9901 15.0738 4.28608 14.7786L11.0315 8.03545C11.323 7.74326 11.323 7.25618 11.0308 6.96468Z" fill="#3D3D3D"/>
                                            </svg>
                                        </a>
                                    </ul>
                                </div>
                                <div class="vi-calender-grid-week">
                                    <a href="javascript:void(0)">SUN</a>
                                    <a href="javascript:void(0)">MON</a>
                                    <a href="javascript:void(0)">TUE</a>
                                    <a href="javascript:void(0)">WED</a>
                                    <a href="javascript:void(0)">THU</a>
                                    <a href="javascript:void(0)">FRI</a>
                                    <a href="javascript:void(0)">SAT</a>
                                </div>
                                <div class="vi-calender-grid">
                                    <a href="javascript:void(0)" data-status="lvl-0">1</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">2</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">3</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">4</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">5</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">6</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">7</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">8</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">9</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">10</a>
                                    <a href="javascript:void(0)" data-status="lvl-1">11</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">12</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">13</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">14</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">15</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">16</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">17</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">18</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">19</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">20</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">21</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">22</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">23</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">24</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">25</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">26</a>
                                    <a href="javascript:void(0)" data-status="lvl-0">27</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">28</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">29</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">30</a>
                                    <a href="javascript:void(0)" data-status="lvl-2">31</a>
                                </div>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 27 24" fill="none" class="absolute right-[10px] top-[7px] z-0">
                            <rect x="5.7793" y="6.24023" width="15.8769" height="13.2" rx="2" stroke="#8F93A3" stroke-width="1.1"/>
                            <path d="M5.7793 10.4404H21.6562" stroke="#8F93A3" stroke-linecap="round"/>
                            <path d="M9.74805 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
                            <path d="M17.687 4.7998V7.7998" stroke="#8F93A3" stroke-linecap="round"/>
                        </svg>
                        {{-- <label>
                            <input
                                type="text"
                                name="newsToday"
                                value="{{ Carbon::parse($articles->publishedAt)->format('m/d/Y') }}"
                                class="w-full border-0 text-[#8F93A3] relative z-[1] bg-transparent cursor-pointer"
                            />
                            </label> --}}
                        <input type="text" class="border-0 focus:outline-none focus:border-0 w-full" id="showCal"/>
                        
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
        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
        <script>
            // function renderNewsToday(selectedDate) {
            //     // Get the current URL
            //     const currentURL = new URL(window.location.href);

            //     // Update the date part of the URL
            //     currentURL.pathname = `/news-today/${selectedDate}/`;

            //     // Navigate to the updated URL
            //     window.location.href = currentURL.href;
            // }

            // calendar for news today
            // $(function() {
            //     $('input[name="newsToday"]').daterangepicker({
            //         autoApply: true,
            //         singleDatePicker: true,
            //         opens: 'left',
            //         minYear: 2009,
            //         maxYear: parseInt(moment().format('YYYY'),10)
            //     }, function(start) {
            //         renderNewsToday(start.format('YYYY-MM-DD'));
            //     });
            // });


            var input = document.getElementById('showCal');
            var message = document.getElementsByClassName('calShow')[0];
            input.addEventListener('focus', function() {
                message.style.display = 'block';
            });
            // input.addEventListener('focusout', function() {
            //     message.style.display = 'none';
            // });
        </script>
@endsection
