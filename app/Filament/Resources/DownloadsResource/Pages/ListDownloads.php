<?php

namespace App\Filament\Resources\DownloadsResource\Pages;

use App\Filament\Resources\ValueAddedOptionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDownloads extends ListRecords
{
    protected static string $resource = ValueAddedOptionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
