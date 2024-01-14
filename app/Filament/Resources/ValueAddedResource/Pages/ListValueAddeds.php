<?php

namespace App\Filament\Resources\ValueAddedResource\Pages;

use App\Filament\Resources\ValueAddedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValueAddeds extends ListRecords
{
    protected static string $resource = ValueAddedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
