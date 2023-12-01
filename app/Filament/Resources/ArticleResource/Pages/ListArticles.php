<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Guava\FilamentDrafts\Admin\Resources\Pages\List\Draftable;

class ListArticles extends ListRecords
{
//    use Draftable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
