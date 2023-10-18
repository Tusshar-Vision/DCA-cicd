@extends('layouts.base')
@section('title', 'Search Results')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        @foreach ($searchResults as $result)
            <x-cards.article :article="$result"/>
        @endforeach
    </div>
@endsection
