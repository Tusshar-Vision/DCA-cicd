<?php

namespace App\Filament\Resources\SubSectionResource\Pages;

use App\Filament\Resources\SubSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Guava\Filament\NestedResources\Pages\NestedListRecords;

class ListSubSections extends NestedListRecords
{
    protected static string $resource = SubSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
