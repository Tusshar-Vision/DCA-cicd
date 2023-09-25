<?php

namespace App\Filament\Resources\MonthlyMagazineResource\Pages;

use App\Filament\Resources\MonthlyMagazineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyMagazine extends EditRecord
{
    protected static string $resource = MonthlyMagazineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
