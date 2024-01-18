<?php

namespace App\Services;

use App\Models\Article;
use App\Models\RelatedTerm;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;

readonly class SuggestionService
{

    public function __construct(
        private Article $articles,
        private Video $video,
        private RelatedTerm $relatedTerm
    ) {
    }

    public function getRelatedTerms($article): Collection|array|null
    {
        return $this->articles->where('id', '=', $article->getID())->first()->relatedTerms;
    }

    public function getRelatedArticles($article): Collection|array|null
    {
        $articles = $this->articles
            ->isPublished()
            ->language()
            ->withAnyTags($article->tags)
            ->get();

        return $articles->where('id', '!=', $article->getID());
    }

    public function getRelatedVideos($article): Collection|array|null {
        return $this->video->latest()->withAnyTags($article->tags)
            ->get();
    }
}
