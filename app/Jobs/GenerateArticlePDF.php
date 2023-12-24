<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class GenerateArticlePDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Collection $articles
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->articles->each(function ($article) {
            $fileName = $article->initiative->name . $article->published_at;
            logger($fileName);
            Pdf::loadHTML($article->content)->save($fileName);
            $article->addMedia($fileName)->toMediaCollection($article->initiative->name);
        });
    }
}
