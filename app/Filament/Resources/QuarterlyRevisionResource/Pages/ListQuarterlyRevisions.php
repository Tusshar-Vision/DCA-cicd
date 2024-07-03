<?php

namespace App\Filament\Resources\QuarterlyRevisionResource\Pages;

use App\Filament\Resources\QuarterlyRevisionResource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuarterlyRevisions extends ListRecords
{
    protected static string $resource = QuarterlyRevisionResource::class;

    use PublishedTab;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
