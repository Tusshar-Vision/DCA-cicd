<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
            ->language()
            ->isFeatured()
            ->latest()
            ->limit($limit)
            ->with('media')
            ->get();
    }

    public function getLatestNews(int $limit = 2): Collection|array
    {
        return $this->articles
            ->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->isPublished()
            ->language()
            ->latest()
            ->limit($limit)
            ->with('author')
            ->get();
    }

    public static function getArticleURL($article): string
    {
        $initiative = $article->initiative->name;
        $date = Carbon::parse($article->publishedInitiative->published_at)->format('Y-m-d');
        $topic = $article->topic->name;
        $slug = $article->slug;

        $url = '/' . $initiative . '/' . $date . '/' . $topic . '/' . $slug;

        return strtolower(str_replace('&', 'AND', str_replace(' ', '-', $url))); // To convert name into code.
    }

    public static function getArticleUrlFromSlug($slug): string
    {
        try {
            $article = Article::with(['initiative', 'publishedInitiative', 'topic'])
                ->where('slug', $slug)
                ->firstOrFail(); // Use firstOrFail to automatically throw an exception if not found.

            return self::getArticleURL($article);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Article with slug '{$slug}' not found.");
            // Handle the case where the article is not found. For example:
            // return a default URL, or throw a custom exception, etc.
            return '/article-not-found'; // Example default URL or you could throw an exception
        }
    }

    public function archive($initiative_id, $year, $month): array
    {
        $query = $this->articles::where('initiative_id', $initiative_id)->where('published_at', '!=', null);

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
            ->where('initiative_id', $initiative_id)
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
