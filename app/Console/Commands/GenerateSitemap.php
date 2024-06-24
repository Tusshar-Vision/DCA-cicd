<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Start generating sitemap...');

        $sitemap = Sitemap::create();

        $baseUrl = config('app.url');
        $prefix = config('app.prefix_url');
        $baseUrl .= $prefix;

        // Static pages
        $sitemap->add($baseUrl . route('home', [], false));

        $sitemap->add($baseUrl . route('news-today', [], false));
        $sitemap->add($baseUrl . route('weekly-focus', [], false));
        $sitemap->add($baseUrl . route('monthly-magazine', [], false));
        $sitemap->add($baseUrl . route('pt-365', [], false));
        $sitemap->add($baseUrl . route('mains-365', [], false));

        $sitemap->add($baseUrl . route('downloads', [], false));
        $sitemap->add($baseUrl . route('economic-survey', [], false));
        $sitemap->add($baseUrl . route('budget', [], false));
        $sitemap->add($baseUrl . route('quarterly-revision-document', [], false));
        $sitemap->add($baseUrl . route('year-end-review', [], false));
        $sitemap->add($baseUrl . route('planet-vision', [], false));

        $sitemap->add($baseUrl . route('videos', [], false));
        $sitemap->add($baseUrl . route('daily-news', [], false));
        $sitemap->add($baseUrl . route('in-conversation', [], false));
        $sitemap->add($baseUrl . route('simplified-by-visionias', [], false));
        $sitemap->add($baseUrl . route('personality-in-focus', [], false));
        $sitemap->add($baseUrl . route('scheme-in-focus', [], false));

        Article::isPublished()->each(function (Article $article) use ($sitemap, $baseUrl) {
           $sitemap->add($baseUrl . ArticleService::getArticleURL($article));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated!');
    }
}
