<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

readonly class ArticleService
{
    public function __construct(
        private Article $articles
    ) {
    }

    public function getFeatured(int $limit = 12): Collection|array
    {
        return $this->articles
            ->isPublished()
            ->isNotShort()
            ->isFeatured()
            ->latest()
            ->limit($limit)
            ->with('media')
            ->get();
    }

    public function getLatestNews(int $limit = 2): Collection|array
    {
        return $this->articles
            ->whereInitiative(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->isPublished()
            ->isNotShort()
            ->latest()
            ->limit($limit)
            ->with('author')
            ->get();
    }

    public static function getArticleURL($article): string
    {
        // Generate URL from article attributes
        $initiative = $article->initiative->name;
        $date = Carbon::parse($article->publishedInitiative->published_at)->format('Y-m-d');
        $topic = $article->topic->name;
        $slug = $article->slug;

        $url = '/' . $initiative . '/' . $date . '/';

        if ($article->is_short === true) {
            if ($initiative === 'News Today') {
                $url .= 'also-in-news' . '#' . $slug;
            } else if ($initiative === 'Weekly Focus') {
                $url .= $topic . '/' . $slug . '#' . $slug;
            } else if ($initiative === 'Monthly Magazine') {
                $url .= $topic . '/news-in-shorts' . '#' . $slug;
            }
        } else {
            $url .= $topic . '/' . $slug;
        }

        // Convert spaces to dashes and '&' to 'AND' in URL, then return lowercased URL
        return strtolower(str_replace('&', 'AND', str_replace(' ', '-', $url)));
    }


    public static function getArticleUrlFromSlug($slug): string|null
    {
        // Use caching to avoid duplicated queries
        return Cache::remember("article_url_{$slug}", 60, function () use ($slug) {
            try {
                // Eager load relationships to reduce number of queries
                $article = Article::with(['initiative', 'publishedInitiative', 'topic'])
                    ->where('slug', $slug)
                    ->firstOrFail(); // Automatically throw an exception if not found

                return self::getArticleURL($article);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return null; // Example default URL or could throw an exception
            }
        });
    }
}
