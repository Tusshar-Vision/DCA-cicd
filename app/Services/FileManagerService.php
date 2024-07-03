<?php

namespace App\Services;

use App\Models\Article;
use App\Models\PublishedInitiative;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class FileManagerService
{
    public function __construct(Media $media)
    {}

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function generateArticlePdf(Article $article): void
    {
        $fileName = $article->slug . '.pdf';
        Pdf::loadHTML($article->content)->save($fileName);
        $article->clearMediaCollection('pdf');
        $article->addMedia($fileName)->toMediaCollection('pdf');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function generatePublishedInitiativePdf(PublishedInitiative $publishedInitiative): void
    {
        $publishedInitiative->articles->each(function($article) {
            $this->generateArticlePdf($article);
        });

        $fileName = str_replace(' ', '_', $publishedInitiative->initiative->name) . '_' . $publishedInitiative->id . '.pdf';
        $publishedInitiativePdf = $this->mergePDF($publishedInitiative->articles);
        $publishedInitiativePdf->setFileName($fileName)->save();

        $publishedInitiative->clearMediaCollection('pdf');
        $publishedInitiative->addMedia($fileName)->toMediaCollection('pdf');
    }

    public function mergePDF(Collection $articles) {

        $oMerger = PDFMerger::init();

        $articles->each(function($article) use($oMerger) {
            $pdf = $article->getFirstMedia('pdf');
            $oMerger->addPDF($pdf->getPath(), 'all');
        });

        $oMerger->merge();

        return $oMerger;
    }
}
