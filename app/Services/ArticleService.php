<?php

namespace App\Services;

use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function __construct(
        private readonly Article $articles
    ) {
    }

    public function getArticleBySlug($slug)
    {
        return $this->articles->findBySlug($slug);
    }

    public function getArticlesByDate($date)
    {
        return $this->articles->whereDate('created_at', Carbon::parse($date))->orderBy('published_at')->get();
    }

    public function getFeatured(int $limit = 12): Collection|array
    {
        return $this->articles->isFeatured()->latest()->limit($limit)->with('author')->get();
    }

    public function getLatestNews(int $limit = 2): Collection|array
    {
        return $this->articles->where('initiative_id', '=', InitiativesHelper::getInitiativeID('NEWS_TODAY'))
            ->latest()->limit($limit)->with('author')->get();
    }

    public function search(string $query, int $perPage = 10): Collection|array|LengthAwarePaginator
    {
        return $this->articles->search($query)->paginate($perPage);
    }

    public static function getArticleURL($article): string
    {
//        dd(Carbon::parse($article->publishedInitiative->published_at));
        $initiative = $article->initiative->name;
        $topic = $article->topic->name;
        $slug = $article->slug;

        $url = '/' . $initiative . '/' . $topic . '/' . $slug;

        return strtolower(str_replace('&', 'AND', str_replace(' ', '-', $url))); // To convert name into code.

    }
}
