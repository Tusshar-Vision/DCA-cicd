@extends('layouts.base')

@section('header')
    <x-topics-nav :published-date="$publishedDate" :topics="$topics" />
    <x-options-nav />
@endsection
