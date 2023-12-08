<div class="space-y-6">
    <div class="text-lg font-bold">
        RELATED ARTICLES
    </div>

    <div class="space-y-5">
        @foreach($relatedArticles as $article)
            <div class="group flex justify-center items-center h-full">
                <a href="{{ \App\Services\ArticleService::getArticleUrlFromSlug($article->slug) }}">
                    <div class="flex space-y-1 items-center space-x-2">
                        <div class="w-2/5">
                            <img src="{{ ($article->featured_image === null) ? 'https://placehold.co/600x400' : route('image.display', ['filename' => $article->featured_image]) }}" />
                        </div>
                        <div>
                            <div>
                                <p class="group-hover:underline text-black text-sm">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
