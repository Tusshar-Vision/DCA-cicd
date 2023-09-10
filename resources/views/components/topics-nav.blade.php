@php
    use Carbon\Carbon;
@endphp

<div class="flex h-10 text-white items-center bg-visionBlue space-x-8">
    <p class="text-sm font-bold pl-2">{{ Carbon::parse($publishedDate)->format('F Y') }}</p>

    <svg class="bg-white" width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 1H15"/>
    </svg>

    @foreach ($topics as $topic)
        <a>{{ $topic->name }}</a>
    @endforeach
</div>