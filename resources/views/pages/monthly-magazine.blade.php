@extends('layouts.reading-ecosystem')
@section('title', 'Monthly Magazine | Current Affairs')

@php
    $inShort = request()->is('monthly-magazine/*/news-in-shorts');
    $currentTopic = request()->segment(3);
@endphp

@section('header')
    <x-navigation.topics :published-date="$publishedDate" :topics="$topics" />
@endsection

@section('article-content')
    <div x-data="{ openItem: 0}" class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 mt-[20px] md:mt-0">
        <div class="flex min-w-full lg:min-w-[340px] lg:w-2/6 flex-col space-y-6 leftsticky stickyMl-0">
            {!! \App\Helpers\SvgIconsHelper::getSvgIcon('monthly-magazine-logo') !!}

            <livewire:widgets.articles-side-bar :topics="$topics" :articles="$sortedArticlesWithTopics" :table-of-content="$tableOfContent" />
            <div class="hidden lg:block">
                <x-widgets.side-bar-download-menu initiative="monthly-magazine" :media="$articles?->media"/>
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
                <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
                <x-header.article readTime="{{ $article->readTime }}" />
            </div>

            @if($inShort)
                <x-inshort-article :articles="$articles->shortArticles->where('topic', $currentTopic)" class="m-0" />
            @else
                <x-article-content :article="$article" class="m-0" />
            @endif

            <div class="mt-12">
                <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
            </div>
            <div class="block lg:hidden">
                <x-widgets.side-bar-download-menu initiative="monthly-magazine" :media="$articles?->media"/>
            </div>
        </div>
    </div>
@endsection
