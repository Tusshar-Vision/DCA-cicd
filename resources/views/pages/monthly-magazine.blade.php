@extends('layouts.reading-ecosystem')
@section('title', 'Monthly Magazine | Current Affairs')

@php
    $inShort = request()->is('monthly-magazine/*/news-in-shorts');
    $currentTopic = request()->segment(3);
@endphp

@section('header')
    <x-navigation.topics :published-date="$package->publishedAt" :topics="$package->sortedArticlesWithTopic" />
@endsection

@section('article-content')
    <div x-data="{ openItem: 0, expanded: false }" class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 mt-[20px] md:mt-0">
        <div class="flex min-w-full max-w-full lg:min-w-[340px] flex-col space-y-6 leftsticky stickyMl-0">

            <img src="{{ asset('images/monthly-magazine-logo.svg') }}" alt="Monthly Magazine Logo" />

            <livewire:widgets.articles-side-bar :topics="$package->topics" :articles="$package->sortedArticlesWithTopic" :table-of-content="$tableOfContent" />

            <div class="hidden lg:block">
                <x-widgets.side-bar-download-menu initiative="monthly-magazine" :media="$package?->media"/>
            </div>
        </div>

        <div class="flex flex-col w-full mt-10 lg:mt-0">
            <div class="space-y-4">
                <x-widgets.options-nav :articleId="$article->getID()" :isArticleBookmarked="$isArticleBookmarked" />
                @if($inShort)
                    <x-common.article-heading title="News in Shorts" />
                @else
                    <x-common.article-heading :title="$article->title" />
                @endif
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                <x-widgets.articles-nav :createdAt="$package->publishedAt" :updatedAt="$article->updatedAt" />
                @if($inShort)
                    @php
                        $readTime = $package->shortArticles->where('topic', $currentTopic)->reduce(function ($carry, $article) {
                            return $carry + $article->readTime;
                        }, 0);
                    @endphp
                    <x-header.article readTime="{{ $readTime }}" />
                @else
                    <x-header.article readTime="{{ $article->readTime }}" />
                @endif
            </div>

            @if($inShort)
                <x-reading.short-article :articles="$package->shortArticles->where('topic', $currentTopic)" class="m-0" />
            @else
                <x-reading.article-content :article="$article" class="m-0" />
            @endif

            <div class="mt-12">
                <x-widgets.article-pagination :current-initiative="$package" :current-article-slug="$article->slug" />
            </div>
            <div class="block lg:hidden">
                <x-widgets.side-bar-download-menu initiative="monthly-magazine" :media="$package?->media"/>
            </div>
        </div>
    </div>
@endsection
