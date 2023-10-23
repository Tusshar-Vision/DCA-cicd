<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    private Article $articles;
    public function __construct(Article $articles) {
        $this->articles = $articles;
    }

    public function getFeatured() {
        return $this->articles->isFeatured()->orderBy('publication_date')->limit(12)->with('author')->get();
    }

    public function getLatestNews() {

    }
}
