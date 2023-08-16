@extends('layouts.app')

@section('content')
    <div>
        <ul class="flex">
            @foreach ($initiatives as $initiative)
                <li class="font-semibold pr-8">
                    <a href="{{ $initiative->path }}">{{ $initiative->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection