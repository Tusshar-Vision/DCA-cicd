<?php

namespace App\Services;

use App\Exceptions\ArticleNotFoundException;
use App\Exceptions\PublishedInitiativeNotFoundException;
use App\Models\PublishedInitiative;
use Carbon\Carbon;

readonly class PublishedInitiativeService
{
    public function __construct(
        private PublishedInitiative $publishedInitiatives
    ) {
    }

    /**
     * @throws \Throwable
     */
    public function getLatest($initiativeId, $date = null): PublishedInitiative|null
    {
        $query = $this->publishedInitiatives
            ->whereInitiative($initiativeId)
            ->isPublished()
            ->language()
            ->hasPublishedArticle()
            ->with(['video', 'media'])
            ->latest('published_at');

        if ($date !== null)
            $query = $query->whereDate('published_at', '=', Carbon::parse($date)->format('Y-m-d'));

        $publishedInitiative = $query->with('articles', function ($article) {
            $article
                ->language()
                ->isPublished()
                ->Ordered()
                ->with([
                    'topic',
                    'language',
                    'relatedArticles',
                    'relatedVideos',
                    'relatedTerms'
                ]);
        })->with('shortArticles', function ($article) {
            $article
                ->language()
                ->isPublished()
                ->Ordered()
                ->with([
                    'topic',
                    'language'
                ]);
        })->first();

        throw_if(
            $publishedInitiative === null,
            new PublishedInitiativeNotFoundException('There is no latest PublishedInitiative for ' . $initiativeId)
        );

        throw_if(
            $publishedInitiative->articles->isEmpty(),
            new ArticleNotFoundException('There are no articles for ' . $initiativeId)
        );

        return $publishedInitiative;
    }

    /**
     * @throws \Throwable
     */
    public static function getLastPreviousPublishedInitiative($initiativeId, $today): PublishedInitiative|null
    {
        return (new PublishedInitiative)
            ->whereInitiative($initiativeId)
            ->isPublished()
            ->whereDate('published_at', '<', $today) // Adjust for initiatives published before today
            ->language()
            ->hasPublishedArticle()
            ->latest('published_at')
            ->first();
    }

    /**
     * @throws \Throwable
     */
    public static function getNextPublishedInitiative($initiativeId, $today): PublishedInitiative|null
    {
        return (new PublishedInitiative)
            ->whereInitiative($initiativeId)
            ->isPublished()
            ->whereDate('published_at', '>', $today) // Adjust for initiatives published before today
            ->language()
            ->hasPublishedArticle()
            ->latest('published_at')
            ->first();
    }

    public function checkIfExists($initiative_id, $published_at): bool
    {
        $publishedRecords = $this->publishedInitiatives
            ->where('initiative_id', '=', $initiative_id);

        if ($initiative_id == 1 || $initiative_id == 3) {
            // For News Today and Weekly Focus, check if an initiative exists for the same date
            $publishedRecords = $publishedRecords->whereDate('published_at', '=', Carbon::parse($published_at)->format('Y-m-d'));
        } elseif ($initiative_id == 2) {
            // For Monthly Magazine, check if an initiative exists for the same month
            $publishedRecords = $publishedRecords->whereYear('published_at', '=', Carbon::parse($published_at)->year)
                ->whereMonth('published_at', '=', Carbon::parse($published_at)->month);
        }

        $publishedRecords = $publishedRecords->get();

        return $publishedRecords->isNotEmpty();
    }

    public function checkIfNameExists($initiative_id, $name): bool
    {
        $publishedRecords = $this->publishedInitiatives
            ->where('initiative_id', '=', $initiative_id)
            ->where('name', '=', $name)
            ->get();

        return $publishedRecords->isNotEmpty();
    }
}
