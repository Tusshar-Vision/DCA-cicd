<?php

namespace App\Filament\Resources\PersonalityInFocusResource\Pages;

use App\Filament\Resources\PersonalityInFocusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonalityInFoci extends ListRecords
{
    protected static string $resource = PersonalityInFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
