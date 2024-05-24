<?php

namespace App\Filament\Resources\WeeklyFocusUploadResource\Pages;

use App\Filament\Resources\WeeklyFocusUploadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyFocusUploads extends ListRecords
{
    protected static string $resource = WeeklyFocusUploadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
