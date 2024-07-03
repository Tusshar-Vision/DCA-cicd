<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\Initiatives;
use App\Filament\Resources\ArticleResource;
use App\Filament\Resources\MonthlyMagazineResource;
use App\Filament\Resources\NewsTodayResource;
use App\Filament\Resources\WeeklyFocusResource;
use App\Helpers\InitiativesHelper;
use App\Models\Initiative;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;


class EditArticle extends EditRecord
{
    use HasPreviewModal;

    protected static string $resource = ArticleResource::class;

    protected function getPreviewModalView(): ?string
    {
        return 'preview.article';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'article';
    }

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
            Action::make('Go to package')
            ->icon('heroicon-o-arrow-uturn-left')
            ->url(function ($record) {
                if ($record->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)) {
                    return NewsTodayResource::getUrl('edit', [$record->published_initiative_id]);
                }
                else if ($record->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
                    return WeeklyFocusResource::getUrl('edit', [$record->published_initiative_id]);
                }
                else {
                    return MonthlyMagazineResource::getUrl('edit', [$record->published_initiative_id]);
                }
            }),
            PreviewAction::make()->icon('heroicon-o-eye'),
        ];
    }
}
