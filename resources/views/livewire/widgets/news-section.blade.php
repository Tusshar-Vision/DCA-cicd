<div class="flex gap-10 mt-6" wire:poll.240s="getData">
    @foreach($latestNewsArticles as $article)
        @if($loop->index < 2)
            <x-cards.article :article="$article" type="large" />
        @else
{{--            <x-cards.article :article="$article" type="small" />--}}
        @endif
    @endforeach
</div>
