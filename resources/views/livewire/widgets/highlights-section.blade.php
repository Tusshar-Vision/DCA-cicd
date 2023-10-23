<div class="flex justify-between gap-10 mt-6" wire:poll.120s="getData">
    <x-widgets.highlights-slider :featured-articles="$featuredArticles" />
    <x-widgets.highlights-sidebar />
</div>
