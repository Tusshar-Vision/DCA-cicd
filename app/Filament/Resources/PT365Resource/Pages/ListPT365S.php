<?php

namespace App\Filament\Resources\PT365Resource\Pages;

use App\Filament\Resources\PT365Resource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPT365S extends ListRecords
{
    protected static string $resource = PT365Resource::class;

    use PublishedTab;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
