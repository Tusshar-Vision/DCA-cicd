<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Services\PublishedInitiativeService;

class MonthlyMagazineController extends Controller
{
    private int $initiativeId;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService
    )
    {
        $this->initiativeId = InitiativesHelper::getInitiativeID('MONTHLY_MAGAZINE');
    }

    public function index() {

        $latestMonthlyMagazine = $this->publishedInitiativeService->getLatestById($this->initiativeId);

        return View('pages.monthly-magazine', [
            "latestMonthlyMagazine" => $latestMonthlyMagazine,
            "publishedDate" => $latestMonthlyMagazine[0]->published_at,
            "articles" => $articles,
            "topics" => $topics
        ]);
    }

    public function archive() {

        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives"
        ]);
    }
}
