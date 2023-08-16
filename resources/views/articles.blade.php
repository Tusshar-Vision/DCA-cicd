@extends('layouts.app')

@section('content')
    @if( !empty($articles) && count($articles) !== 0 ) 
    
        @foreach ($articles as $article)
        
            <h1>{{$article->title}}</h1>
            <p>{{$article->content}}</p>

        @endforeach

    @else
        <h1>No articles</h1>
    @endif
@endsection