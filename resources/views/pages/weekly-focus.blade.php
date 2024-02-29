@extends('layouts.reading-ecosystem')
@section('title', 'Weekly Focus | Current Affairs')

@section('article-content')
    <div x-data="{ openItem: 0, expanded: false }" class="flex justify-between mt-[20px] md:mt-0" x-data="{ isVideoOpen: false, isTopicAtGlanceOpen: false }">
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 w-full">

            <x-modals.modal-box x-show="isVideoOpen" heading="Watch In Conversation">
                <x-cards.video :source="$articles->video"/>
            </x-modals.modal-box>

            <div class="flex w-full lg:md:w-2/6 flex-col space-y-4 leftsticky stickyMl-0">
                {!! \App\Helpers\SvgIconsHelper::getSvgIcon('weekly-focus-logo') !!}
                {{-- <x-widgets.article-side-bar :table-of-content="$tableOfContent" /> --}}
                <x-widgets.article-side-bar :table-of-content="$articles->articles"/>


                <div class="hidden lg:block">
                    <x-widgets.topic-at-a-glance :infographic="$articles->topicAtGlance"/>
                </div>

                <x-modals.modal-box x-show="isTopicAtGlanceOpen">
                    <livewire:widgets.pdf-viewer :infographic="$articles->topicAtGlance" />
                </x-modals.modal-box>

                <div class="hidden lg:block">
                    <x-widgets.side-bar-download-menu initiative="weekly-focus" :media="$articles?->media" />
                    <x-widgets.sidebar-video-menu initiative="weekly-focus" :video="$articles?->video" />
                </div>
            </div>

            <div class="flex flex-col w-full mt-6 lg:mt-0">
                <div class="space-y-4">
                    <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
                    <x-common.article-heading :title="$article->title" />
                    <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                        <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
                        <x-header.article readTime="{{ $article->readTime }}" />
                    </div>
                </div>

                {{-- <x-article-content :article="$article" class="m-0" /> --}}
                <x-inshort-article :articles="$articles->articles" class="m-0" />

                <div class="mt-12">
                    <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
                </div>

                <div @click="isTopicAtGlanceOpen = !isTopicAtGlanceOpen" class="block lg:hidden mb-4">
                    <x-widgets.topic-at-a-glance :infographic="$articles->topicAtGlance"/>
                </div>

                <div class="block lg:hidden">
                    <x-widgets.side-bar-download-menu initiative="weekly-focus" :media="$articles?->media" />
                    <x-widgets.sidebar-video-menu initiative="weekly-focus" :video="$articles?->video" />
                </div>
            </div>
        </div>
    </div>
@endsection
