<div class="space-y-6 mt-[25px] lg:mt-0">
    <div class="text-lg font-bold">
        RELATED ARTICLES
    </div>

    <div class="space-y-5">
        @foreach($relatedArticles as $article)
            <div class="group flex items-center">
                @php
                    $featuredImage = $article->relatedArticle->getFirstMediaUrl('article-featured-image');
                @endphp
                <a href="{{ \App\Services\ArticleService::getArticleUrlFromSlug($article->relatedArticle->slug) }}">
                    <div class="flex space-y-1 space-x-2">
                        <img src="{{ $featuredImage === '' ? 'https://placehold.co/600x400' : $featuredImage }}" width="150px" />
                        <div>
                            <div>
                                <p class="group-hover:underline text-black text-sm">
                                    {{ $article->relatedArticle->title }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
