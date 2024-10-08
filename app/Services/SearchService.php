<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{

    public function search(string $query, int $limit = 10, int $initiative_id = null, $date = null): Collection|array|LengthAwarePaginator
    {
        $dbQuery = Article::search($query)->take($limit);

        if ($initiative_id) {
            $dbQuery = $dbQuery->where('initiative_id', $initiative_id);
        }

        return $dbQuery->get();
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
