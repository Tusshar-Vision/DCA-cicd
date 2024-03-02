@extends('layouts.reading-ecosystem')
@section('title', 'Monthly Magazine | Current Affairs')

@section('header')
    <x-navigation.topics :published-date="$publishedDate" :topics="$topics" />
@endsection

@section('article-content')
    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 mt-[20px] md:mt-0">
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
                <x-common.article-heading :title="$article->title" />
                <div class="flex flex-col md:flex-row justify-between items-center w-full py-2 my-[30px] text-gray-500 border-t-2 border-b-2">
                    <x-widgets.articles-nav :createdAt="$articles->publishedAt" :updatedAt="$article->updatedAt" />
                    <x-header.article readTime="{{ $article->readTime }}" />
                </div>
            </div>

            <x-article-content :article="$article" />

            <div class="mt-12">
                <x-widgets.article-pagination :current-initiative="$articles" :current-article-slug="$article->slug" />
            </div>
            <div class="block lg:hidden">
                <x-widgets.side-bar-download-menu initiative="monthly-magazine" :media="$articles?->media"/>
            </div>
        </div>
    </div>
@endsection
