<?php

namespace App\Filament\Resources\SchemeInFocusResource\Pages;

use App\Filament\Resources\SchemeInFocusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchemeInFoci extends ListRecords
{
    protected static string $resource = SchemeInFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
