<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class ArticleService
{
    public function __construct(
        private Article $articles
    ) {}

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

    public function search(string $query, int $initiative_id = null, $date = null, int $perPage = 10): Collection|array|LengthAwarePaginator
    {
        $query = $this->articles
                    ->isPublished()
                    ->language()
                    ->search($query);

        if ($initiative_id) {
            $query->where('initiative_id', $initiative_id);
        }

        if ($date) {
            if ($date == 'pas_24_hours') {
                $date = Carbon::now()
                    ->subDay()
                    ->format('Y-m-d');
                $query->where('published_at', '>=', Carbon::parse($date));
            } else if ($date == 'past_week') {
                $weekStartDate = Carbon::now()->subDays(7)->startOfDay();
                $weekEndDate = Carbon::now()->endOfDay();
                $query->whereBetween('published_at', [$weekStartDate, $weekEndDate]);
            } else if ($date == 'past_month') {
                $monthStartDate = Carbon::now()->subMonth()->startOfMonth();
                $monthEndDate = Carbon::now()->endOfMonth();
                $query->whereBetween('published_at', [$monthStartDate, $monthEndDate]);
            } else if ($date == 'past_year') {
                $yearStartDate = Carbon::now()->subYear()->startOfYear();
                $yearEndDate = Carbon::now()->endOfYear();
                $query->whereBetween('published_at', [$yearStartDate, $yearEndDate]);
            }
        }

        return $query->paginate($perPage);
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
        return self::getArticleURL(Article::findBySlug($slug));
    }

    public function getRelatedArticles($article)
    {
        $articles = $this->articles
                ->isPublished()
                ->language()
                ->withAnyTags($article->tags)
                ->get();

        return $articles->where('id', '!=', $article->getID());
    }
}
