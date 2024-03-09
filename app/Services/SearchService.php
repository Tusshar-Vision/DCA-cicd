<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{

    public function search(string $query, int $initiative_id = null, $date = null): Collection|array|LengthAwarePaginator
    {
        return Article::search($query)->get();
    }

    public function searchArticles() {

    }

    public function searchInfographics() {

    }

    public function searchVideos() {

    }

    public function searchTerms() {

    }
}
