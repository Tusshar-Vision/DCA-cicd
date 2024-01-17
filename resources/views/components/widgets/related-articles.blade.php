<div class="space-y-6 mt-[25px] lg:mt-0">
    <div class="text-lg font-bold">
        RELATED ARTICLES
    </div>

    <div class="space-y-5">
        @foreach($relatedArticles as $article)
            <div class="group flex items-center h-full">
                <a href="{{ \App\Services\ArticleService::getArticleUrlFromSlug($article->slug) }}">
                    <div class="flex space-y-1 items-center space-x-2">
                        <img src="{{ $article->getFirstMediaUrl('article-featured-image') ?? 'https://placehold.co/600x400' }}" width="150px" />
                        <div>
                            <div>
                                <p class="group-hover:underline text-black text-sm">
                                    {{ $article->title }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
