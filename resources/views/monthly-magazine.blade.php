@extends('layouts.app')
@section('title', 'Monthly Magazine | Current Affairs')

@section('content')
    <div class="space-y-4">
        <h1 class="text-7xl">{{$articles[0]->title}}</h1>
        <x-articles-nav 
            :createdAt="$articles[0]->created_at"
            :updatedAt="$articles[0]->updated_at"
        />
    </div>
    <div class="flex space-x-8">
        <livewire:articles-side-bar />
        
        <div class="flex flex-col">
            @if( !empty($articles) && count($articles) !== 0 ) 
            
                <x-article-header readTime="{{ $articles[0]->read_time }}" />
                <x-article-author-header :authorId="$articles[0]->author_id" />
                @foreach ($articles as $article)
                    <h1>{{$article->title}}</h1>
                    <p>{{$article->content}}</p>
                @endforeach

            @else
                <h1>No articles</h1>
            @endif
        </div>
    </div>

@endsection