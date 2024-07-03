<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class RegenerateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:regenerate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate slugs for all the articles in the article table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Article::all()->each(function ($model) {
            $model->generateSlug();
            $model->save();
        });

        $this->info('Slugs regenerated successfully.');
    }
}
