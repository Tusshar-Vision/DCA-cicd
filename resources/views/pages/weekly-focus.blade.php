@extends('layouts.reading-ecosystem')
@section('title', 'Weekly Focus | Current Affairs')

<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css" integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('article-content')
    <div
        x-data="{ openItem: 0, expanded: false, isVideoOpen: false, isTopicAtGlanceOpen: false }"
        x-init="$watch('isVideoOpen', value => pauseVideo(value))"
        class="flex justify-between mt-[20px] md:mt-0"
    >
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 w-full">

            <x-modals.modal-box x-show="isVideoOpen" heading="Watch In Conversation">
                <x-cards.video :source="$package->video"/>
            </x-modals.modal-box>

            <div class="flex w-full lg:md:w-2/6 flex-col space-y-4 leftsticky stickyMl-0">
                {!! \App\Helpers\SvgIconsHelper::getSvgIcon('weekly-focus-logo') !!}
                <x-widgets.article-side-bar :table-of-content="$package->articles"/>

                <div class="hidden lg:block">
                    <x-widgets.topic-at-a-glance :infographic="$package->topicAtGlance"/>
                </div>

                <x-modals.wide-modal :file="$package->topicAtGlance" heading="Topic at a Glance" x-show="isTopicAtGlanceOpen">
                    <x-widgets.image-viewer :image="$package->topicAtGlance" />
                </x-modals.wide-modal>

                <div class="hidden lg:block">
                    <x-widgets.side-bar-download-menu initiative="weekly-focus" :media="$package?->media" />
                    <x-widgets.sidebar-video-menu initiative="weekly-focus" :video="$package?->video" />
                </div>
            </div>

            <div class="flex flex-col w-full mt-6 lg:mt-0">
                <div class="space-y-4">
                    <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
                    <x-common.article-heading :title="$package->name" />
                    <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                        <x-widgets.articles-nav :createdAt="$package->publishedAt" :updatedAt="$article->updatedAt" />
                        @php
                            $readTime = $package->shortArticles->reduce(function ($carry, $article) {
                                return $carry + $article->readTime;
                            }, 0);
                        @endphp
                        <x-header.article readTime="{{ $readTime }}" />
                    </div>
                </div>

                <x-inshort-article :articles="$package->articles" class="mt-6" />

                <div class="mt-12">
                    <x-widgets.article-pagination :current-initiative="$package" :current-article-slug="$article->slug" />
                </div>

                <div class="block lg:hidden mb-4">
                    <x-widgets.topic-at-a-glance :infographic="$package->topicAtGlance"/>
                </div>

                <div class="block lg:hidden">
                    <x-widgets.side-bar-download-menu initiative="weekly-focus" :media="$package?->media" />
                    <x-widgets.sidebar-video-menu initiative="weekly-focus" :video="$package?->video" />
                </div>
            </div>
        </div>
    </div>
@endsection
