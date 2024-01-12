<?php

namespace App\Http\Controllers\Pages;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Http\Controllers\Controller;
use App\Services\PublishedInitiativeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Mains365Controller extends Controller
{
    private int $initiativeId;
    public function __construct(
        private readonly PublishedInitiativeService $publishedInitiativeService
    ) {
        $this->initiativeId = InitiativesHelper::getInitiativeID(Initiatives::MAINS_365);
    }

    public function index()
    {

        $downloadableFiles = $this->publishedInitiativeService->getDownloads($this->initiativeId);

        return View('pages.mains-365', [
            'title' => 'Mains 365',
            'downloadableFiles' => $downloadableFiles
        ]);
    }

    public function archive()
    {
        $medias = Media::where('mime_type', 'application/pdf')
            ->where('collection_name', 'mains-365')
            // ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            // ->groupBy(DB::raw('YEAR(created_at)'))
            // ->orderBy('year', 'desc')
            ->get();

        logger("meidias");
        logger($medias);


        return View('pages.archives.mains-365', [
            "title" => "Mains 365 Archive",
        ]);
    }
}
