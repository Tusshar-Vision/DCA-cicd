<?php

namespace App\Jobs;

use App\Models\PublishedInitiative;
use App\Models\User;
use App\Services\FileManagerService;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateInitiativePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public PublishedInitiative $publishedInitiative,
        public User $user
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(FileManagerService $fileManagerService): void
    {
        $fileManagerService->generatePublishedInitiativePdf($this->publishedInitiative);

        $media = $this->publishedInitiative->getFirstMedia('pdf');
        $downloadLink = route('download', ['media' => $media]);
        $body = `<a href="${$downloadLink}" target="_blank">Download</a>`;

        Notification::make()
            ->title('Your pdf exports are ready to download')
            ->success()
            ->body($body)
            ->sendToDatabase($this->user);
    }
}
