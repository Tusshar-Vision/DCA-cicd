<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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

        $url = '/' . $initiative . '/' . $date . '/' . $topic . '/' . $slug;

        // Convert spaces to dashes and '&' to 'AND' in URL, then return lowercased URL
        return strtolower(str_replace('&', 'AND', str_replace(' ', '-', $url)));
    }


    public static function getArticleUrlFromSlug($slug): string
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
                Log::error("Article with slug '{$slug}' not found.");
                // Handle not found article by returning a default URL
                return '/article-not-found'; // Example default URL or could throw an exception
            }
        });
    }

    public function archive($initiative_id, $year, $month): array
    {
        $query = $this->articles
            ->whereInitiative($initiative_id)
            ->isPublished();

        $years = $query->select(DB::raw('YEAR(published_at) as year'))
            ->groupBy(DB::raw('YEAR(published_at)'))
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($year) $query->whereYear('published_at', $year);
        if ($month) $query->whereMonth('published_at', $month);

        $archive = $query->select(DB::raw('YEAR(published_at) as year, MONTH(published_at) as month'))
            ->groupBy(DB::raw('YEAR(published_at), MONTH(published_at)'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $groupedArchive = [];
        foreach ($archive as $item) {
            $groupedArchive[$item->year][] = $item->month;
        }

        return [$years, $groupedArchive];
    }

    public function getByYearAndMonth($initiative_id, $year, $month)
    {
        return $this->articles
            ->whereInitiative($initiative_id)
            ->isNotShort()
            ->isPublished()
            ->whereYear('published_at', $year)
            ->whereMonth('published_at', $month)
            ->with('topic') // Eager load the 'topic' relationship
            ->get()
            ->map(function ($article) {
                // Perform date formatting here
                $article->formatted_published_at = Carbon::parse($article->published_at)->format('Y-m-d');

                // Check if the topic relationship exists
                if ($article->topic) {
                    $article->topic_name = strtolower($article->topic->name);
                    // Add other properties if needed
                } else {
                    $article->topic_name = null;
                }

                $article->url = $this->getArticleURL($article);

                // Select only the desired columns
                return $article->only(['formatted_published_at', 'title', 'slug', 'topic_name', 'url']);
            });
    }
}
