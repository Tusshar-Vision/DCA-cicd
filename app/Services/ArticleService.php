<?php

namespace App\Services;

use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function __construct(
        private readonly Article $articles
    )
    {}

    public function getArticleBySlug($slug) {
        return $this->articles->findBySlug($slug);
    }

    public function getFeatured(int $limit = 12): Collection|array {
        return $this->articles->isFeatured()->latest()->limit($limit)->with('author')->get();
    }

    public function getLatestNews(int $limit = 2): Collection|array
    {
        return $this->articles->getByInitiativeId(InitiativesHelper::getInitiativeID('NEWS_TODAY'))
            ->latest()->limit($limit)->with('author')->get();
    }

    public function search(string $query, int $perPage = 10): Collection|array|LengthAwarePaginator {
        return $this->articles->search($query)->paginate($perPage);
    }

    public static function getArticleURL($article): string
    {
        $initiative = $article->initiative;
        $topic = $article->topic->name;
        $slug = $article->slug;

        $url = '/' . $initiative . '/' . $topic . '/' . $slug;

        return strtolower(str_replace('&', 'AND', str_replace(' ', '-', $url))); // To convert name into code.

    }
}
