<?php

namespace App\Filament\Resources\ValueAddedResource\Pages;

use App\Filament\Resources\ValueAddedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValueAdded extends EditRecord
{
    protected static string $resource = ValueAddedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
