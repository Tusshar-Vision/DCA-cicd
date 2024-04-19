<?php

namespace App\Filament\Resources\Mains365Resource\Pages;

use App\Filament\Resources\Mains365Resource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMains365s extends ListRecords
{
    protected static string $resource = Mains365Resource::class;

    use PublishedTab;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
