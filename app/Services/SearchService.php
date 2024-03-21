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
        $query = Article::search($query)
            ->where('is_short', false);

        if ($initiative_id) {
            $query = $query->where('initiative_id', $initiative_id);
        }

        return $query->get();
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
