<?php

namespace App\Filament\Resources\WeeklyFocusResource\Pages;

use App\Filament\Resources\WeeklyFocusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyFoci extends ListRecords
{
    protected static string $resource = WeeklyFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
