<?php

namespace App\Traits;

use App\Filament\Resources\ArticleResource;
use App\Services\ArticleService;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

trait HasNotifications
{
    public function sendNotificationOfArticlePublished(Model $article): void
    {
        $articleUrl = ArticleService::getArticleUrlFromSlug($article->slug);
        $title = 'Your article just got published!';
        $message = "<a href=\" $articleUrl \" target='_blank'>Click here to check it out</a>";

        $this->sendNotification($article, $title, $message);
    }

    public function sendNotificationOfArticleCreation(Model $article): void
    {
        $title = 'You got assigned to a new article!';
        $articleUrl = '/admin/articles/' . $article->slug . '/edit';
        $message = "<a href=\" $articleUrl \" target='_blank'>Click here to check it out</a>";

        $this->sendNotification($article, $title, $message);
    }

    private function sendNotification(Model $article, string $title, string $message): void
    {
        $recipients = [
            $article->author
        ];

        if ($article->reviewer !== null) {
            $recipients[] = $article->reviewer;
        }

        Notification::make()
            ->title($title)
            ->body($message)
            ->success()
            ->sendToDatabase($recipients);
    }
}
