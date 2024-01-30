@use('App\Services\ArticleService')

<div class="flex justify-between items-center">
    @if($previousArticleIndex !== null)
        <div class="flex flex-col items-center cursor-pointer w-3/6 md:w-2/6">
            <a wire:navigate
               id="prev-article-btn"
               href="{{ ArticleService::getArticleUrlFromSlug($currentInitiative->articles[$previousArticleIndex]->slug) }}"
               class="items-center"
            >
            <div class="flex-col text-left md:flex">
                <span class="flex mb-2">
                    <svg width="24" height="24" class="mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 20C16.42 20 20 16.42 20 12C20 7.58 16.42 4 12 4C7.58 4 4 7.58 4 12C4 16.42 7.58 20 12 20ZM12 11H16V13H12V16L8 12L12 8V11Z" fill="black" />
                    </svg>
                </span>
                <span class="font-semibold">Previous Article</span>
            </div>
                <span class="block text-wrap text-xs md:text-sm mt-2 pr-4 md:pr-0">{{ $currentInitiative->articles[$previousArticleIndex]->title }}</span>
            </a>
        </div>
    @endif

    @if($nextArticleIndex !== null)
        <div class="flex flex-col items-center cursor-pointer w-3/6 md:w-2/6">
            <a wire:navigate id="nxt-article-btn" href="{{ ArticleService::getArticleUrlFromSlug($currentInitiative->articles[$nextArticleIndex]->slug) }}">
                <div class="flex-col text-right md:flex justify-end"> 
                    <span class="flex justify-end mb-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11H8V13H12V16L16 12L12 8V11Z" fill="black" />
                        </svg>
                    </span>
                    <span class="font-semibold">Next Article</span>
                </div>
                <span class="block text-wrap text-right text-xs md:text-sm mt-2 pl-4 md:pl-0">{{ $currentInitiative->articles[$nextArticleIndex]->title }}</span>
            </a>
        </div>
    @endif
</div>
