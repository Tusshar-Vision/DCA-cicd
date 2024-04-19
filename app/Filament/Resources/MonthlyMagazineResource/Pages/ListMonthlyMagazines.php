<?php

namespace App\Filament\Resources\MonthlyMagazineResource\Pages;

use App\Filament\Resources\MonthlyMagazineResource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyMagazines extends ListRecords
{
    protected static string $resource = MonthlyMagazineResource::class;

    use PublishedTab;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
