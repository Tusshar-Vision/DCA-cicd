<?php

namespace App\Jobs;

use App\Events\ExportIsReadyToDownload;
use App\Models\PublishedInitiative;
use App\Models\User;
use App\Services\FileManagerService;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class GenerateArticlePDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Collection $articles,
        public User $user
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(FileManagerService $fileManagerService, PublishedInitiative $publishedInitiative): void
    {
        $this->articles->each(function ($article) use($fileManagerService) {
            try {
                $fileManagerService->generateArticlePdf($article);
            } catch (FileDoesNotExist|FileIsTooBig $e) {
                logger($e);
            }
        });

        Notification::make()
            ->title('Your pdf exports are ready to download')
            ->success()
            ->body('<a href="https://visionias.in">Download</a>')
            ->sendToDatabase($this->user);
    }
}
