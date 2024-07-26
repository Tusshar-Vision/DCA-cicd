<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ArticleService;
use App\Services\LiveQueryService;
use Illuminate\Console\Command;

class GenerateEmbedding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-embedding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(LiveQueryService $liveQueryService)
    {
        $articles = Article::isPublished()->get();

        $batchSize = 10;
        $articleBatches = $articles->chunk($batchSize);

        $liveQueryService = new LiveQueryService();

        foreach ($articleBatches as $index => $batch) {
            $data = $batch->map(function (Article $article) {
                return [
                    "id" => $article->id,
                    "title" => $article->title,
                    "content" => $article->content->content,
                    "published_date" => $article->publishedInitiative->published_at->toIso8601String(),
                    "url" => ArticleService::getArticleUrlFromSlug($article->slug),
                    "type" => $article->publishedInitiative->initiative->name,
                ];
            })->toArray();

            $response = $liveQueryService->createEmbeddings($data);
            $this->info('Batch ' . $index . 'Embeddings generated successfully!');
        }

        $this->info('Embeddings generated successfully!');
    }
}
