<?php

namespace App\Filament\Resources\MonthlyMagazineResource\Pages;

use App\Filament\Resources\MonthlyMagazineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyMagazines extends ListRecords
{
    protected static string $resource = MonthlyMagazineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
