<?php

namespace App\Filament\Resources\MonthlyMagazineUploadResource\Pages;

use App\Filament\Resources\MonthlyMagazineUploadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyMagazineUploads extends ListRecords
{
    protected static string $resource = MonthlyMagazineUploadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
