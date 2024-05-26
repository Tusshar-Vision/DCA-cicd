<?php

namespace App\Filament\Resources\NewsTodayUploadResource\Pages;

use App\Filament\Resources\NewsTodayUploadResource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsTodayUploads extends ListRecords
{
    protected static string $resource = NewsTodayUploadResource::class;
    use PublishedTab;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
