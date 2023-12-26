@extends('layouts.base')

@section('header')
    <x-navigation.topics :published-date="$publishedDate" :topics="$topics" />
    {{-- <x-widgets.options-nav /> --}}
@endsection
