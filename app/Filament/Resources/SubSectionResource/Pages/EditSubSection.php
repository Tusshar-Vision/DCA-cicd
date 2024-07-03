<?php

namespace App\Filament\Resources\SubSectionResource\Pages;

use App\Filament\Resources\SubSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\Filament\NestedResources\Pages\NestedEditRecord;

class EditSubSection extends NestedEditRecord
{
    protected static string $resource = SubSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
