<?php

namespace App\Services;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    private $language;
    public function __construct(
        private readonly Article $articles
    ) {
        $this->language = config("settings.language." . app()->getLocale());
    }

    public function getArticleBySlug($slug)
    {
        return $this->articles->findBySlug($slug);
    }

    public function getArticlesByDate($date)
    {
        return $this->articles->isPublished()->whereDate('created_at', Carbon::parse($date))->orderBy('published_at')->get();
    }

    public function getFeatured(int $limit = 12): Collection|array
    {
        return $this->articles->isPublished()->isFeatured()->where('language', $this->language)->latest()->limit($limit)->get();
    }

    public function getLatestNews(int $limit = 2): Collection|array
    {
        return $this->articles->where('initiative_id', '=', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))->isPublished()
            ->where('language', $this->language)->latest()->limit($limit)->with('author')->get();
    }

    public function search(string $query, int $initiative_id = null, $date = null, int $perPage = 10): Collection|array|LengthAwarePaginator
    {
        $query = $this->articles->search($query)->where('is_published', true)->where('language', $this->language);

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
        return $this->articles->withAnyTags($article->tags)->get();
    }
}
