<?php

namespace App\Filament\Resources\WeeklyFocusUploadResource\Pages;

use App\Filament\Resources\WeeklyFocusUploadResource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyFocusUploads extends ListRecords
{
    protected static string $resource = WeeklyFocusUploadResource::class;
    use PublishedTab;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
