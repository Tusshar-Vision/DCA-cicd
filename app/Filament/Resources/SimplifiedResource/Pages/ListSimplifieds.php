<?php

namespace App\Filament\Resources\SimplifiedResource\Pages;

use App\Filament\Resources\SimplifiedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSimplifieds extends ListRecords
{
    protected static string $resource = SimplifiedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
