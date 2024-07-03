<div class="flex gap-10 mt-6" wire:poll.240s="getData">
    @foreach($latestNewsArticles as $article)
        <x-cards.article :article="$article" type="large" />
    @endforeach
</div>
