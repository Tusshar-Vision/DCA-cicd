<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
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
            PreviewAction::make(),
        ];
    }
}
